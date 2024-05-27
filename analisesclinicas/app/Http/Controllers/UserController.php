<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();

        return Inertia::render('User/Index', ['users' => $users]);
    }

    public function create(){
        return Inertia::render('User/Create');
    }

    public function store(Request $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password)
        ]);

        return to_route('user.index');
    }

    public function edit($id){

        $user = User::findOrFail($id);

        return Inertia::render('User/Edit', ['user' => $user]);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
        ]);
        return Inertia::render('User/Edit', ['user' => $user]);
    }
}
