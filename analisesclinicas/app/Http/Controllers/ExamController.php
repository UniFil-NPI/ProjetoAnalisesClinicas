<?php

namespace App\Http\Controllers;

use App\Imports\PatientExamResultImport;
use App\Models\Doctor;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\Patient;
use App\Models\PatientExamResult;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;


class ExamController extends Controller
{
    public function index()
    {
        $auth = Auth::user();

        $exams = Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
            ->join('exam_types', 'exams.exam_type_id', 'exam_types.id')
            ->select('exams.*', 'exam_types.name as exam_type_name', 'users.cpf', 'users.name as patient_name', 'doctors.name as doctor_name')
            ->orderBy('exams.exam_date', 'desc')->paginate(5);
        return Inertia::render('Exam/Index', ['exams' => $exams]);
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

        $query = Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
            ->join('exam_types', 'exams.exam_type_id', 'exam_types.id')
            ->select('exams.*', 'exam_types.name as exam_type_name', 'users.cpf', 'users.name as patient_name', 'doctors.name as doctor_name');

        if (!$auth->hasRole(['admin', 'recepcionist', 'biomedic'])) {
            $exams = Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
                ->join('users', 'patients.user_id', '=', 'users.id')
                ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
                ->join('exam_types', 'exams.exam_type_id', 'exam_types.id')
                ->select('exams.*', 'exam_types.name as exam_type_name', 'users.cpf', 'users.name as patient_name', 'doctors.name as doctor_name')
                ->where('users.cpf', $auth->cpf)->orderBy('exams.exam_date', 'desc')->get();
        } else {
            if ($request->search == '') {
                $exams = Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
                    ->join('users', 'patients.user_id', '=', 'users.id')
                    ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
                    ->join('exam_types', 'exams.exam_type_id', 'exam_types.id')
                    ->select('exams.*', 'exam_types.name as exam_type_name', 'users.cpf', 'users.name as patient_name', 'doctors.name as doctor_name')
                    ->orderBy('exams.exam_date', 'desc')->paginate(5);
            } else {
                $exams = Exam::join('patients', 'exams.patient_id', '=', 'patients.id')
                    ->join('users', 'patients.user_id', '=', 'users.id')
                    ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
                    ->join('exam_types', 'exams.exam_type_id', 'exam_types.id')
                    ->select('exams.*', 'exam_types.name as exam_type_name', 'users.cpf', 'users.name as patient_name', 'doctors.name as doctor_name')->where('users.cpf', $request->search)->orderBy('exams.exam_date', 'desc')->paginate(5);
            }
        }
        return Inertia::render('Exam/Index', ['exams' => $exams]);
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

        try {
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

    public function manage_report($id)
    {
        $exam = Exam::find($id);

        return Inertia::render("Exam/ReportManage", ['exam' => $exam]);
    }

    public function import_result($id)
    {
        $exam = Exam::find($id);

        if ($exam->pdf != null) {
            return Inertia::render('Exam/ReportManage', ['exam' => $exam, 'error' => 'Esse pedido já tem um laudo, por favor remova o laudo para poder gerar outro.']);
        }

        return Inertia::render('Exam/Import', ['exam' => $exam]);
    }

    public function store_import(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimetypes:csv,text/plain,text/csv'
        ]);

        $exam = Exam::find($id);
        try {
            $components = Exam::join('exam_types', "exams.exam_type_id", '=', 'exam_types.id')
                ->select('exam_types.components_info')
                ->where('exams.exam_type_id', $exam->exam_type_id)
                ->first();
            $components = json_decode($components->components_info, true);

            Excel::import(new PatientExamResultImport, $request->file);
            $infos = Exam::join('patient_exam_results', 'patient_exam_results.requisition_id', '=', 'exams.id')
                ->join('exam_types', 'exams.exam_type_id', '=', 'exam_types.id')
                ->join('doctors', 'doctors.id', '=', 'exams.doctor_id')
                ->join('patients', 'patients.id', '=', 'exams.patient_id')
                ->join('users', 'users.id', '=', 'patients.user_id')
                ->select(
                    'patient_exam_results.requisition_id as requisition_id',
                    'users.name as patient_name',
                    'patients.birth_date as birth_date',
                    'exams.health_insurance as health_insurance',
                    'exams.lab as lab',
                    'doctors.name as doctor_name',
                    'exams.exam_date as exam_date',
                    'patients.biological_sex as sex',
                    'patient_exam_results.exam_type_name as exam_name',
                    'patient_exam_results.exam_value as value',
                )
                ->where('patient_exam_results.requisition_id', $exam->id)
                ->get();

            PatientExamResult::truncate();
            if (count($infos) == 0) {
                throw new Exception("Erro na leitura do laudo");
            }
            return Inertia::render('Exam/PreviewPdf', ['exam' => $exam, 'infos' => $infos, 'components' => $components]);
        } catch (Exception $e) {
            return Inertia::render('Exam/ReportManage', ['exam' => $exam, 'error' => 'Erro ao gerar o laudo']);
        }
    }

    public function store_report(Request $request, $id)
    {
        $exam = Exam::find($id);
        try {

            $pdf = Pdf::loadview('pdf.exam_report', ['infos' => $request->infos, 'components' => $request->components, 'conclusion' => $request->conclusion]);
            $current_date = Carbon::now()->format('d-m-Y');
            $file_name = $id . '-' . $request->infos[0]['patient_name'] . '-laudo-' . $current_date . '.pdf';
            $file_path = 'laudos/sangue/' . $file_name;

            Storage::put($file_path, $pdf->output());
            $exam->update([
                'pdf' => $file_path,
                'state' => 'Finalizado',
            ]);

            return redirect()->route('exam.report.manage', $id)->with("message", "Laudo gerado com sucesso.");
        } catch (Exception $e) {
            return Inertia::render('Exam/Import', ["error" => "Não foi possível gerar o laudo.", 'exam' => $exam, 'infos' => $request->infos, 'components' => $request->components]);
        }
    }

    public function download_report($id)
    {
        $exam = Exam::find($id);
        try {
            return Storage::download($exam->pdf);
        } catch (Error | Exception $e) {
            return Inertia::render('Exam/ReportManage', ['exam' => $exam, 'error' => 'Não foi possível fazer o download, não existe nenhum laudo nesse pedido']);
        }
    }

    public function remove_report($id)
    {
        $exam = Exam::find($id);
        try {
            Storage::delete($exam->pdf);
            Exam::find($id)
                ->updateOrFail([
                    'pdf' => null,
                    'state' => 'analisando'
                ]);
            return redirect()->route('exam.report.manage', $id)->with("message", "Sucesso ao remover o Pdf.");
        } catch (Exception | Error $e) {
            return Inertia::render('Exam/ReportManage', ['exam' => $exam, 'error' => 'Não foi possível remover o laudo, não existe nenhum laudo nesse pedido.']);
        }
    }
}
