<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DoctorController extends Controller
{
    public function index()
    {
        return Inertia::render('Doctor/Index');
    }

    public function create()
    {
        return Inertia::render('Doctor/Create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'doctor_name' => 'required',
            'CRM' => 'required|unique:doctors,CRM',
        ]);
        
            try {
                Doctor::create([
                    'doctor_name' => strtoupper($request->doctor_name),
                    'CRM' => $request->CRM,
                ]);

                return redirect()->route('doctor.index');
                
            } catch(Exception $e) {
                return Inertia::render('Doctor/Create');
            }            
    }

    public function search(Request $request)
    {
        if($request->search == '') {
           return Doctor::select('doctors.*')->orderBy('id', 'desc')->get();
        }

        $search = strtoupper($request->search);

        $result = Doctor::select('doctors.*')
                ->where('doctors.doctor_name', $search)->get();

        return $result;
    }

    public function edit($id)
    {

        $doctor = Doctor::find($id);

        return Inertia::render('Doctor/Edit', ['doctor' => $doctor]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_name' => 'required',
            'CRM' => 'required',
        ]);
        try{
            Doctor::find($id)->update([
                'doctor_name' => $request->doctor_name,
                'CRM' => $request->CRM,
            ]);
            return redirect()->route('doctor.index');
        } catch (Exception $e) {
            $doctor = Doctor::find($id);
            return Inertia::render('Doctor/Edit', ['doctor' => $doctor, "error" => "CRM já está cadastrado no banco"]);
        }

    }
}
