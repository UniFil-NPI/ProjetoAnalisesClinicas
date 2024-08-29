<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
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

    public function create()
    {
        $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')
                            ->select('patients.id','users.id as user_id', 'users.name as patient_name', 'users.cpf')
                            ->get();

        $doctors = Doctor::all();

        return Inertia::render('Exam/Create', ['patients' => $patients, 'doctors' => $doctors]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'cpf' => 'required|cpf|formato_cpf',
            'crm' => 'required',
            'lab' => 'required',
            'health_insurance' => 'required|not_in:0',
            'exam_date' => 'required',
            'description' => 'required',
        ]);
            try {
                $patient = Patient::join('users', 'patients.user_id', '=', 'users.id')->select('patients.id','users.id as user_id', 'users.name', 'users.cpf')->where('users.cpf', $request->cpf)->firstOrFail();
                $doctor = Doctor::select('doctors.id','doctors.crm')->where('doctors.crm', $request->crm)->firstOrFail();

                $patient->exams()->create([
                    'doctor_id' => $doctor->id,
                    'health_insurance' => $request->health_insurance,
                    'exam_date' => $request->exam_date,
                    'lab' => $request->lab,
                    'description' => $request->description,
                ]);

                return redirect()->route('exam.index');
                
            } catch(Exception $e) {
                $patients = Patient::all();
                $doctors = Doctor::all();
                return Inertia::render('Exam/Create', ["error" => "Paciente não encontrado",'patients' => $patients, 'doctors' => $doctors]);
            }            
    }

    public function search(Request $request)
    {

        $auth = Auth::user();

        if(!$auth->hasRole(['admin', 'recepcionist'])){
            return Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
                    ->join('users', 'patients.user_id', '=', 'users.id')
                    ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
                    ->select('exams.*', 'users.cpf', 'users.name as patient_name', 'doctors.name as doctor_name')
                    ->where('users.cpf', $auth->cpf)->orderBy('exams.exam_date', 'desc')->get();
        }

        $result = Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
                ->join('users', 'patients.user_id', '=', 'users.id')
                ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
                ->select('exams.*', 'users.cpf', 'users.name as patient_name', 'doctors.name as doctor_name')
                ->where('users.cpf', $request->search)->orderBy('exams.exam_date', 'desc')->get();

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
            'lab' => 'required',
            'health_insurance' => 'required|not_in:0',
            'exam_date' => 'required',
            'description' => 'required',
        ]);

        Exam::find($id)->update([
            'health_insurance' => $request->health_insurance,
            'exam_date' => $request->exam_date,
            'lab' => $request->lab,
            'description' => $request->description,
        ]);

        return redirect()->route('exam.index');
    }
}
