<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        $users = User::withoutRole('patient')->with('roles')->orderBy('id', 'desc')->paginate(5);

        return Inertia::render('User/Index', ['users' => $users, 'showInactive' => false]);
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
                'is_active' => $request->is_active,
            ]);


            return redirect()->route('user.index')->with("message", "Dados do funcionário atualizados com sucesso.");
        } catch (Exception $e) {
            $user = User::with('roles')->findOrFail($id);

            return Inertia::render('User/Edit', ['user' => $user, "error" => "Não foi possível realizar a atualização dos dados."]);
        }
    }

    public function search($show_inactive, $search_value=null)
    {
        if ($show_inactive == 'false') {
            if ($search_value == null) {
                $users = User::withoutRole('patient')->with('roles')->where('is_active', true)->orderBy('id', 'desc')->paginate(5);
            } else {
                $users = User::withoutRole('patient')->with('roles')->where('cpf', $search_value)->where('is_active', true)->orderBy('id', 'desc')->paginate(5);
            }
        } else {
            if ($search_value == null) {
                $users = User::withoutRole('patient')->with('roles')->where('is_active', false)->orderBy('id', 'desc')->paginate(5);
            } else {
                $users = User::withoutRole('patient')->with('roles')->where('cpf', $search_value)->where('is_active', false)->orderBy('id', 'desc')->paginate(5);
            }
        }
        return Inertia::render('User/Index', ['users' => $users, 'showInactive' => filter_var($show_inactive, FILTER_VALIDATE_BOOLEAN)]);
    }
}
