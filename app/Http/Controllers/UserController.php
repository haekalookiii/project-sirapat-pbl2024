<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pengguna = User::paginate(10);
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
    public function store(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');

            // Validate the CSV file
            $validator = Validator::make($request->all(), [
                'csv_file' => 'required|mimes:csv,txt|max:2048'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Process the CSV file
            $this->processCsv($file);

            return redirect()->route('user.index')->with('success', 'Users created successfully from CSV.');
    } else {

        // Validate individual form fields only when CSV is not present
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:students,nim',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:2',
            'roles' => 'required|string|in:admin,user',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //$username = Str::slug($request->name, '_');

        // Create a new user
        $user = User::create([
            'name' => $request['name'],
            'username' => $request['nim'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        // Create a new student
        Student::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request['name'],
            'nim' => $request['nim'],
        ]);

        if ($request->roles === 'admin') {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');
        }

            return redirect(route('user.index'))->with('success', 'Data berhasil disimpan');
        }
    }

    private function processCsv($file)
    {
        // Baca file CSV
        $fileHandle = fopen($file, 'r');
        while (($row = fgetcsv($fileHandle, 1000, ',')) !== FALSE) {
            $name = $row[0];
            $nim = $row[1];
            $email = $row[2];
            $password = $row[3];
            $roles = $row[4];

            // Validasi setiap baris
            $validator = Validator::make(
                compact('name', 'nim', 'email', 'password', 'roles'),
                [
                    'name' => 'required|string|max:255',
                    'nim' => 'required|string|max:255|unique:students,nim',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'password' => 'required|string|min:2',
                    'roles' => 'required|string|in:admin,user',
                ]
            );

            if ($validator->fails()) {
                continue; // Skip baris yang tidak valid
            }

            // Buat user baru
            $user = User::create([
                'name' => $name,
                'username' => $nim,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            // Simpan NIM ke tabel students
            Student::create([
                'user_id' => $user->id,
                'nama_lengkap' => $name,
                'nim' => $nim,
            ]);

            if ($roles === 'admin') {
                $user->assignRole('admin');
            } else {
                $user->assignRole('user');
            }
        }

        fclose($fileHandle);
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


