<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Exception;
use Illuminate\Http\Request;
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
        return Inertia::render('Exam/Create');
    }

    public function store(Request $request)
    {
        //TO DO
        $request->validate([
            'cpf' => 'required|cpf|formato_cpf|unique:users,cpf',
            'name' => 'required',
            'health_insurance' => 'required|not_in:0',
        ]);

        try {
            DB::beginTransaction();

            Exam::create([
                'health_insurance' => $request->health_insurance,
            ]);
            DB::commit();
            return redirect()->route('exam.index');
        } catch(Exception $e) {
            DB::rollBack();
            return redirect()->route('exam.create');
        }
    }
}
