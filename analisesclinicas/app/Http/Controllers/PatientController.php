<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {

        $patients = Patient::join('users', 'patients.user_id', '=', 'users.id')->select('patients.id as patient_id', 'patients.*', 'users.*')->get();

        return Inertia::render('Patient/Index', ['patients' => $patients]);
    }

    public function getCep($cep)
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
        $data = $response->json();

        return response()->json($data);
    }

    public function create()
    {
        return Inertia::render('Patient/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|cpf|formato_cpf|unique:users,cpf',
            'post_code' => 'required|formato_cep',
            'street' => 'required',
            'phone_number' => 'required',
            'building_number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required|uf',
            'birth_date' => 'required',
            'health_insurance' => 'required',
            'biological_sex' => 'required',
        ]);

        try {
            DB::beginTransaction();

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
            DB::commit();
            return redirect()->route('patient.index');
        } catch(Exception $e) {
            DB::rollBack();
            return redirect()->route('patient.create');
        }

    }

    public function edit($id)
    {

        $patient = Patient::join('users', 'patients.user_id', '=', 'users.id')
            ->where('patients.id', $id)
            ->select('patients.id as patient_id', 'patients.*', 'users.*')->first();

        return Inertia::render('Patient/Edit', ['patient' => $patient]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cpf' => 'required|cpf|formato_cpf',
            'post_code' => 'required|formato_cep',
            'street' => 'required',
            'phone_number' => 'required',
            'building_number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required|uf',
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
            'status' => $request->status,
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

    public function search(Request $request)
    {
        // dd($patients);

        if ($request->search == '') {
            return Patient::join('users', 'patients.user_id', '=', 'users.id')
                    ->select('patients.id as patient_id', 'patients.*', 'users.*')
                    ->orderBy('patient_id', 'desc')
                    ->get();
        }

        return Patient::join('users', 'patients.user_id', '=', 'users.id')
                ->select('patients.id as patient_id', 'patients.*', 'users.*')
                ->where('users.cpf', $request->search)
                ->orderBy('patient_id', 'desc')
                ->get();
        
    }
}
