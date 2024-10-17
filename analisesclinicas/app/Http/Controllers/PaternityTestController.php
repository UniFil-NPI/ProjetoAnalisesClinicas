<?php

namespace App\Http\Controllers;

use App\Models\PaternityTest;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Inertia\Inertia;
use LaravelLegends\PtBrValidator\Rules\Cpf;

class PaternityTestController extends Controller
{
    public function index()
    {
        $auth = Auth::user()->hasRole(['admin']);

        $isPatient = Auth::user()->hasRole(['patient']);

        return Inertia::render('PaternityTest/Index', ['isAdmin' => $auth, 'isPatient' => $isPatient]);
    }

    public function create()
    {
        $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')
            ->select('patients.id', 'users.id as user_id', 'users.name as patient_name', 'users.cpf')
            ->get();

        return Inertia::render('PaternityTest/Create', ['patients' => $patients]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'cpf' => 'required|cpf|formato_cpf',
            'lab' => 'required',
            'health_insurance' => 'required|not_in:0',
            'exam_date' => 'required',
            'description' => 'required',
        ]);
        try {
            $patient = Patient::join('users', 'patients.user_id', '=', 'users.id')->select('patients.id', 'users.id as user_id', 'users.name', 'users.cpf')->where('users.cpf', $request->cpf)->firstOrFail();

            
            $formated_participants_list = [];
            
            foreach ($request->participants as $participant) {
                array_push($formated_participants_list, $participant['cpf']['value']);
            }
            
            $participants_json = json_encode($formated_participants_list);

            $patient->paternityTests()->create([
                'participants' => $participants_json,
                'health_insurance' => $request->health_insurance,
                'exam_date' => $request->exam_date,
                'lab' => $request->lab,
                'description' => $request->description,
            ]);

            return redirect()->route('paternity.index');
        } catch (Exception $e) {
            $patients = Patient::all();
            return Inertia::render('PaternityTest/Create', ["error" => "Paciente não encontrado", 'patients' => $patients]);
        }
    }

    public function search(Request $request)
    {

        $auth = Auth::user();

        if ($auth->hasRole(['patient'])) {
            return PaternityTest::join('patients', 'paternity_tests.patient_id', '=', 'patients.id')
                ->join('users', 'patients.user_id', '=', 'users.id')
                ->select('paternity_tests.*', 'users.cpf', 'users.name as patient_name')
                ->where('users.cpf', $auth->cpf)->orderBy('paternity_tests.exam_date', 'desc')->get();
            }
            
            $result = PaternityTest::join('patients', 'paternity_tests.patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->select('paternity_tests.*', 'users.cpf', 'users.name as patient_name')
            ->where('users.cpf', $request->search)->orderBy('paternity_tests.exam_date', 'desc')->get();
            
        return $result;
    }

    public function edit($id)
    {

        $paternityTest = PaternityTest::find($id);

        return Inertia::render('PaternityTest/Edit', ['paternityTest' => $paternityTest]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lab' => 'required',
            'health_insurance' => 'required|not_in:0',
            'exam_date' => 'required',
            'description' => 'required',
        ]);

        PaternityTest::find($id)->update([
            'health_insurance' => $request->health_insurance,
            'exam_date' => $request->exam_date,
            'lab' => $request->lab,
            'description' => $request->description,
        ]);

        return redirect()->route('paternity.index');
    }
}
