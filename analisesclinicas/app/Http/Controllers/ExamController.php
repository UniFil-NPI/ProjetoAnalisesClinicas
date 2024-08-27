<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Patient;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class ExamController extends Controller
{
    public function index()
    {
        $auth = Auth::user()->hasRole(['admin', 'recepcionist']);

        return Inertia::render('Exam/Index', ['isAdminOrRecepcionist' => $auth]);
    }

    public function create(Request $request = null)
    {
        return Inertia::render('Exam/Create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'cpf' => 'required|cpf|formato_cpf',
            'doctor_name' => 'required',
            'lab' => 'required',
            'health_insurance' => 'required|not_in:0',
            'exam_date' => 'required',
            'description' => 'required',
        ]);
        
            try {
                $patient = Patient::join('users', 'patients.user_id', '=', 'users.id')->select('patients.id','users.id as user_id', 'users.name', 'users.cpf')->where('users.cpf', $request->cpf)->firstOrFail();

                $patient->exams()->create([
                    'health_insurance' => $request->health_insurance,
                    'exam_date' => $request->exam_date,
                    'lab' => $request->lab,
                    'doctor_name' => $request->doctor_name,
                    'description' => $request->description,
                ]);

                return redirect()->route('exam.index');
                
            } catch(Exception $e) {
                return Inertia::render('Exam/Create', ["error" => "Paciente não encontrado"]);
            }
            
        return redirect()->route('exam.create')->with('error', 'Paciente não encontrado');
    }

    public function search(Request $request)
    {

        $auth = Auth::user();

        if(!$auth->hasRole(['admin', 'recepcionist'])){
            return Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
                    ->join('users', 'patients.user_id', '=', 'users.id')
                    ->select('exams.*', 'users.cpf', 'users.name as name')
                    ->where('users.cpf', $auth->cpf)->get();
        }

        $result = Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
                ->join('users', 'patients.user_id', '=', 'users.id')
                ->select('exams.*', 'users.cpf', 'users.name as name')
                ->where('users.cpf', $request->search)->get();

        return $result;
    }

    public function edit($id)
    {

        $exam = Exam::find($id);

        return Inertia::render('Exam/Edit', ['exam' => $exam]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_name' => 'required',
            'lab' => 'required',
            'health_insurance' => 'required|not_in:0',
            'exam_date' => 'required',
            'description' => 'required',
        ]);

        Exam::find($id)->update([
            'health_insurance' => $request->health_insurance,
            'exam_date' => $request->exam_date,
            'lab' => $request->lab,
            'doctor_name' => $request->doctor_name,
            'description' => $request->description,
        ]);

        return redirect()->route('exam.index');
    }
}
