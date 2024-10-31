<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Exam;
use App\Models\ExamType;
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
        return Inertia::render('Exam/Index');
    }

    public function create()
    {
        $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')
            ->select('patients.id', 'users.id as user_id', 'users.name as patient_name', 'users.cpf')
            ->get();

        $doctors = Doctor::all();

        $exam_types = ExamType::all();

        return Inertia::render('Exam/Create', ['patients' => $patients, 'doctors' => $doctors, 'examTypes' => $exam_types]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'cpf' => 'required|cpf|formato_cpf',
            'crm' => 'required',
            'exam_type_name' => 'required',
            'lab' => 'required',
            'health_insurance' => 'required|not_in:0',
            'exam_date' => 'required',
            'description' => 'required',
        ]);
        try {
            $patient = Patient::join('users', 'patients.user_id', '=', 'users.id')
            ->select('patients.id', 'users.id as user_id', 'users.name', 'users.cpf')
            ->where('users.cpf', $request->cpf)
            ->firstOrFail();

            $doctor = Doctor::select('doctors.id', 'doctors.crm')
            ->where('doctors.crm', $request->crm)
            ->firstOrFail();

            $exam_type = ExamType::select('exam_types.id', 'exam_types.name')
            ->where('exam_types.name', $request->exam_type_name)
            ->firstOrFail();

            $patient->exams()->create([
                'doctor_id' => $doctor->id,
                'exam_type_id' => $exam_type->id,
                'health_insurance' => $request->health_insurance,
                'exam_date' => $request->exam_date,
                'lab' => $request->lab,
                'description' => $request->description,
            ]);
            return redirect()->route('exam.index')->with("message", "Pedido cadastrado com sucesso.");
        } catch (Exception $e) {
            $patients = Patient::all();
            $doctors = Doctor::all();
            $exam_types = ExamType::all();

            return Inertia::render('Exam/Create', ["error" => "Não foi possível realizar o cadastro do pedido.", 'patients' => $patients, 'doctors' => $doctors, 'examTypes' => $exam_types]);
        }
    }

    public function search(Request $request)
    {

        $auth = Auth::user();

        $result = [];

        $query = Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
            ->join('exam_types', 'exams.exam_type_id', 'exam_types.id')
            ->select('exams.*', 'exam_types.name as exam_type_name', 'users.cpf', 'users.name as patient_name', 'doctors.name as doctor_name');

        if (!$auth->hasRole(['admin', 'recepcionist', 'biomedic'])) {
            $result = $query
                ->where('users.cpf', $auth->cpf)->orderBy('exams.exam_date', 'desc')->get();
        } else {
            if ($request->search == '') {
                $result = $query->orderBy('id', 'desc')->get();
            } else {
                $patient = Patient::join('users', 'patients.user_id', '=', 'users.id')
                    ->select('users.cpf')->where('users.cpf', $request->search)->get();

                if (count($patient) == 0) {
                    return [
                        "result" => $result,
                        "status" => "patient not found"
                    ];
                }

                $result = $query
                    ->where('users.cpf', $request->search)->orderBy('exams.exam_date', 'desc')->get();
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

        $exam = Exam::find($id);

        return Inertia::render('Exam/Edit', ['exam' => $exam]);
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

            Exam::find($id)->update([
                'health_insurance' => $request->health_insurance,
                'exam_date' => $request->exam_date,
                'lab' => $request->lab,
                'description' => $request->description,
            ]);

            return redirect()->route('exam.index')->with("message", "Dados do pedido atualizados com sucesso.");
        } catch (Exception $e) {
            $exam = Exam::find($id);

            return Inertia::render('Exam/Edit', ["error" => "Não foi possível realizar a atualização dos dados.", 'exam' => $exam]);
        }
    }
}
