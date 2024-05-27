<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PatientController extends Controller
{
     public function index()
    {

        $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')->select('patients.id as patient_id' ,'patients.*', 'users.*')->get();

        //dd($patients);

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

        // FAZER VALIDAÇÃO DE CPF

        try {
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make(substr($request->cpf, 0, 4))
        ]);

        Patient::create([
            'user_id' => $user->id,
            'post_code' => $request->post_code,
            'street' => $request->street,
            'building_number' => $request->building_number,
            'secondary_address' => $request->secondary_address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'birth_date' => $request->birth_date,
            'health_insurance' => $request->health_insurance,
            'biological_sex' => $request->biological_sex,
        ]);
        } catch(Exception $e){
            //FALTA MOSTRAR O ERRO NA TELA
            return redirect()->back();
        }

        return redirect()->route('patient.index');
    }

    public function edit($id){

        $patient = Patient::findOrFail($id);

        return Inertia::render('Patient/Edit', ['patient' => $patient]);
    }

    public function update(Request $request, $id){
        $patient = Patient::findOrFail($id);

        Patient::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'post_code' => $request->post_code,
            'street' => $request->street,
            'building_number' => $request->building_number,
            'secondary_address' => $request->secondary_address,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'birth_date' => $request->birth_date,
            'health_insurance' => $request->health_insurance,
            'biological_sex' => $request->biological_sex,
        ]);

        return Inertia::render('Patient/Edit', ['patient' => $patient]);
    }
}
