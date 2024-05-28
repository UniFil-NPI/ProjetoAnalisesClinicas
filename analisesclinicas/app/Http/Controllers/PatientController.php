<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PatientController extends Controller
{
     public function index()
    {

        $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')->select('patients.id as patient_id' ,'patients.*', 'users.*')->get();

        return Inertia::render('Patient/Index', ['patients' => $patients]);
    }

    public function getCep($cep){
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
        $data = $response->json();

        return response()->json($data);
    }

    public function create(){
        return Inertia::render('Patient/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cpf' => 'required|cpf|formato_cpf',
            'post_code' => 'required|formato_cep',
            'street' => 'required',
            'phone_number' => 'required|celular_com_ddd',
            'building_number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'birth_date' => 'required',
            'health_insurance' => 'required',
            'biological_sex' => 'required',
        ]);

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make(substr($request->cpf, 0, 4))
        ])->assignRole('patient');

        Patient::create([
            'user_id' => $user->id,
            'post_code' => $request->post_code,
            'street' => $request->street,
            'phone_number' => $request->phone_number,
            'building_number' => $request->building_number,
            'secondary_address' => $request->secondary_address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'birth_date' => $request->birth_date,
            'health_insurance' => $request->health_insurance,
            'biological_sex' => $request->biological_sex,
        ]);


        return redirect()->route('patient.index');
    }

    public function edit($id){

        $patient = Patient::join('users', 'patients.user_id', '=', 'users.id')
        ->where('patients.id', $id)
        ->select('patients.id as patient_id' ,'patients.*', 'users.*')->first();

        return Inertia::render('Patient/Edit', ['patient' => $patient]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cpf' => 'required|cpf|formato_cpf',
            'post_code' => 'required|formato_cep',
            'street' => 'required',
            'phone_number' => 'required|celular_com_ddd',
            'building_number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'birth_date' => 'required',
            'health_insurance' => 'required',
            'biological_sex' => 'required',
        ]);
        
        $patient = Patient::findOrFail($id);

        $user = User::where('id', $patient->user_id)->firstOrFail();

        $user->updateOrFail([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make(substr($request->cpf, 0, 4)),
        ]);

        $user_id = User::find($patient->user_id)->id;

        Patient::where('id', $id)->update([
            'user_id' => $user_id,
            'post_code' => $request->post_code,
            'street' => $request->street,
            'phone_number' => $request->phone_number,
            'building_number' => $request->building_number,
            'secondary_address' => $request->secondary_address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'birth_date' => $request->birth_date,
            'health_insurance' => $request->health_insurance,
            'biological_sex' => $request->biological_sex,
        ]);

        return redirect()->route('patient.index');
    }
}
