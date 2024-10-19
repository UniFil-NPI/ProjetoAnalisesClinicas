<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\PaternityTest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $auth = Auth::user();

        $exams = null;

        if ($auth->hasRole(['patient'])) {
            $blood = Exam::join('patients', 'patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
            ->select(
                'exams.id',
                'exams.type',
                'users.name as patient_name',
                'doctors.name as doctor_name',
                'exams.exam_date',
                'exams.description',
                'exams.pdf',
                'exams.updated_at'
            )
            ->where('users.cpf', $auth->cpf)
            ->orderBy('exams.updated_at', 'desc')->take(5);

            $paternity = PaternityTest::join('patients', 'patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->select(
                'paternity_tests.id',
                'paternity_tests.type',
                'users.name as patient_name',
                DB::raw('NULL as doctor_name'),
                'paternity_tests.exam_date',
                'paternity_tests.description',
                'paternity_tests.pdf',
                'paternity_tests.updated_at'
            )
            ->where('users.cpf', $auth->cpf)
            ->orderBy('paternity_tests.updated_at', 'desc')->take(5);
            
            $exams = $blood->union($paternity)->orderBy('updated_at', 'desc')
                ->take(10)
                ->get();
        }

        if ($auth->hasRole(['recepcionist', 'biomedic'])) {
            $exams = Exam::join('patients', 'patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
            ->select(
                'exams.id',
                'exams.type',
                'users.name as patient_name',
                'doctors.name as doctor_name',
                'exams.exam_date',
                'exams.description',
                'exams.pdf',
                'exams.updated_at'
            )->orderBy('exams.updated_at', 'desc')->take(5)->get();
        }

        if ($auth->hasRole(['admin'])) {
            $blood = Exam::join('patients', 'patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->join('doctors', 'exams.doctor_id', '=', 'doctors.id')
            ->select(
                'exams.id',
                'exams.type',
                'users.name as patient_name',
                'doctors.name as doctor_name',
                'exams.exam_date',
                'exams.description',
                'exams.pdf',
                'exams.updated_at'
            )->orderBy('exams.updated_at', 'desc')->take(5);

            $paternity = PaternityTest::join('patients', 'patient_id', '=', 'patients.id')
            ->join('users', 'patients.user_id', '=', 'users.id')
            ->select(
                'paternity_tests.id',
                'paternity_tests.type',
                'users.name as patient_name',
                DB::raw('NULL as doctor_name'),
                'paternity_tests.exam_date',
                'paternity_tests.description',
                'paternity_tests.pdf',
                'paternity_tests.updated_at'
            )->orderBy('paternity_tests.updated_at', 'desc')->take(5);
            
            $exams = $blood->union($paternity)->orderBy('updated_at', 'desc')
                ->take(10)
                ->get();
        }

        return Inertia::render('Dashboard', ['exams' => $exams]);
    }
}
