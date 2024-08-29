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
            'name' => 'required',
            'crm' => 'required|unique:doctors,crm',
        ]);
        
            try {
                Doctor::create([
                    'name' => $request->name,
                    'crm' => $request->crm,
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

        $search = strtolower($request->search);

        $result = Doctor::select('doctors.*')
                ->whereRaw('LOWER(doctors.name) LIKE ?', '%'.$search.'%')->orderBy('id', 'desc')->get();

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
            'name' => 'required',
            'crm' => 'required',
        ]);
        try{
            Doctor::find($id)->update([
                'name' => $request->name,
                'crm' => $request->crm,
            ]);
            return redirect()->route('doctor.index');
        } catch (Exception $e) {
            $doctor = Doctor::find($id);
            return Inertia::render('Doctor/Edit', ['doctor' => $doctor, "error" => "CRM já está cadastrado no banco"]);
        }

    }
}
