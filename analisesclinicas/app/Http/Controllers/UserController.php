<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {

        $users = User::with('roles')->orderBy('id', 'desc')->get();

        return Inertia::render('User/Index', ['users' => $users]);
    }

    public function create()
    {
        return Inertia::render('User/Create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'cpf' => 'required|cpf|unique:users,cpf',
            'role' => 'required|not_in:0'
        ]);

        $cpfForPassword = $this->formatcpf($request->cpf);
        try {
            DB::beginTransaction();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'password' => Hash::make(substr($cpfForPassword, 0, 4))
            ])->assignRole($request->role);

            DB::commit();

            return redirect()->route('user.index')->with("message", "Funcionário cadastrado com sucesso.");
        } catch (Exception $e) {
            DB::rollBack();
            return Inertia::render('User/Create', ["error" => "Não foi possível realizar o cadastro do funcionário."]);
        }
    }

    private function formatcpf($cpfRequest)
    {
        $formatedCpf = str_replace('.', '', $cpfRequest);
        $formatedCpf = str_replace('-', '', $formatedCpf);
        return $formatedCpf;
    }

    public function edit($id)
    {

        $user = User::with('roles')->findOrFail($id);

        return Inertia::render('User/Edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'cpf' => 'required|cpf',
                'role' => 'required'
            ]);

            $user = User::findOrFail($id);
            $user->syncRoles($request->role);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'status' => $request->status,
            ]);


            return redirect()->route('user.index')->with("message", "Dados do funcionário atualizados com sucesso.");
        } catch (Exception $e) {
            $user = User::with('roles')->findOrFail($id);

            return Inertia::render('User/Edit', ['user' => $user, "error" => "Não foi possível realizar a atualização dos dados."]);
        }
    }

    public function search(Request $request)
    {
        $result = [];

        if ($request->search == '') {
            $result = User::with('roles')->orderBy('id', 'desc')->get()->filter(fn($user) => $user->hasRole(['admin', 'recepcionist', 'technician']));
        } else {
            $result = User::with('roles')->where("cpf", $request->search)->get()->filter(fn($user) => $user->hasRole(['admin', 'recepcionist', 'technician']));

            if (count($result) == 0) {
                return [
                    "result" => $result,
                    "status" => "employee not found",
                ];
            }
        }
        return [
            "result" => $result,
            "status" => "ok",
        ];
    }
}
