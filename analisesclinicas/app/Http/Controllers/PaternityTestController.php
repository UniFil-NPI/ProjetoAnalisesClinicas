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

use function PHPUnit\Framework\throwException;

class PaternityTestController extends Controller
{
    public function index()
    {
        return Inertia::render('PaternityTest/Index');
    }

    public function select()
    {
        return Inertia::render('PaternityTest/Select');
    }

    public function create_duo()
    {
        $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')
            ->select('patients.id', 'users.id as user_id', 'users.name as patient_name', 'users.cpf')
            ->get();

        return Inertia::render('PaternityTest/CreateDuo', ['patients' => $patients]);
    }

    public function create_trio()
    {
        $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')
            ->select('patients.id', 'users.id as user_id', 'users.name as patient_name', 'users.cpf')
            ->get();

        return Inertia::render('PaternityTest/CreateTrio', ['patients' => $patients]);
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
            if (count($formated_participants_list) == 0) {
                throw new Exception('Não foi adicionado nenhum participante');
            }
            $participants_json = json_encode($formated_participants_list);

            $patient->paternityTests()->create([
                'participants' => $participants_json,
                'health_insurance' => $request->health_insurance,
                'exam_date' => $request->exam_date,
                'lab' => $request->lab,
                'description' => $request->description,
            ]);

            return redirect()->route('paternity.index')->with("message", "Pedido cadastrado com sucesso.");
        } catch (Exception $e) {

            $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')
                ->select('patients.id', 'users.id as user_id', 'users.name as patient_name', 'users.cpf')
                ->get();

            return Inertia::render('PaternityTest/Create', [
                'error' => $e->getMessage() == "Não foi adicionado nenhum participante" ? $e->getMessage() : 'Não foi possível salvar o novo pedido: ',
                'patients' => $patients,
            ]);
        }
    }

    public function search(Request $request)
    {

        $auth = Auth::user();
        $result = [];
        $query = PaternityTest::join('patients', 'paternity_tests.patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->select('paternity_tests.*', 'users.cpf', 'users.name as patient_name');

        if ($auth->hasRole(['patient'])) {
            $result = $query
                ->where('users.cpf', $auth->cpf)->orderBy('paternity_tests.updated_at', 'desc')->get();
        } else {
            if ($request->search == "") {
                $result = $query->orderBy('paternity_tests.updated_at', 'desc')->get();
            } else {
                $patient = Patient::join('users', 'patients.user_id', '=', 'users.id')
                    ->select('users.cpf')->where('users.cpf', $request->search)->get();

                $result = $query
                    ->where('users.cpf', $request->search)->orderBy('paternity_tests.updated_at', 'desc')->get();

                if (count($patient) == 0) {
                    return [
                        "result" => $result,
                        "status" => "patient not found"
                    ];
                }
            }
        }

        if (count($result) == 0) {
            return [
                "result" => $result,
                "status" => "exams is empty",
            ];
        }

        return [
            "result" => $result,
            "status" => "ok",
        ];
    }

    public function edit($id)
    {

        $paternityTest = PaternityTest::find($id);

        return Inertia::render('PaternityTest/Edit', ['paternityTest' => $paternityTest]);
    }

    public function update(Request $request, $id)
    {
        try {
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

            return redirect()->route('paternity.index')->with("message", "Dados do pedido atualizados com sucesso.");
        } catch (Exception $e) {
            $paternityTest = PaternityTest::find($id);

            return Inertia::render('PaternityTest/Edit', ["error" => "Não foi possível realizar a atualização dos dados.", 'paternityTest' => $paternityTest]);
        }
    }
}
