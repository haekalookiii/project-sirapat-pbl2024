<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $users = DB::table('users')
        //     ->when($request->input('name'), function ($query, $name) {
        //         return $query->where('name', 'like', '%' . $name . '%');
        //     })
        //     ->select('id', 'name', 'email', DB::raw('DATE_FORMAT(created_at, "%d %M %Y")
        //     as created_at'))
        //     ->orderBy('id', 'desc')
        //     ->paginate(15);
        // return view('pages.users.index', compact('users'));

        $pengguna = User::paginate(3);
        return view('pages.users.index',[
            'users' => $pengguna,
        ]);
        
    }

    public function create()
    {
        return view('pages.users.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        // dd($user);
        Student::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request['name'],
        ]);
        if ($request->roles === 'admin') {
            $user->assignRole('admin');
        }else {
            $user->assignRole('user');
        }
        return redirect(route('user.index'))->with('success', 'data berhasil disimpan');
    }

    public function edit(User $user)
    {
        return view('pages.users.edit')->with('user', $user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validate = $request->validated();
        $user->update($validate);
        return redirect()->route('user.index')->with('success', 'Edit User Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Delete User Successfully');
    }
}


