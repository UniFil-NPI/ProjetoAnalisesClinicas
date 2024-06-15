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

        try {
            DB::beginTransaction();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'password' => Hash::make(substr($request->cpf, 0, 4))
            ])->assignRole($request->role);

            DB::commit();

            return to_route('user.index');
        } catch(Exception $e) {
            DB::rollBack();
            return to_route('user.create');
        }

        


    }

    public function edit($id)
    {

        $user = User::with('roles')->findOrFail($id);

        return Inertia::render('User/Edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
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


        return redirect()->route('user.index');
    }

    public function search(Request $request)
    {
        if ($request->search == '') {
            return User::with('roles')->orderBy('id', 'desc')->get()->filter(fn ($user) => $user->hasRole(['admin', 'recepcionist', 'technician']));
        }
        return User::with('roles')->where("cpf", $request->search)->get();
    }
}
