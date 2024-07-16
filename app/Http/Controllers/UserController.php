<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('name');
        
        $users = User::query()
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('pages.users.index', compact('users'));
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

            return redirect()->route('user.index')->with('success', 'Pengguna berhasil dibuat.');
        } else {

            // Validate individual form fields only when CSV is not present
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'nim' => 'required|string|max:255|unique:students,nim',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
                'roles' => 'required|string|in:admin,user',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //$username = Str::slug($request->name, '_');

            // Create a new user
            $user = User::create([
                'name' => ucwords(strtolower($request['name'])),
                'username' => ucwords(strtolower($request['nim'])),
                'email' => strtolower($request['email']),
                'password' => Hash::make($request['password']),
            ]);

            // Create a new student
            Student::create([
                'user_id' => $user->id,
                'nama_lengkap' => ucwords(strtolower($request['name'])),
                'nim' => ucwords(strtolower($request['nim'])),
            ]);

            if ($request->roles === 'admin') {
                $user->assignRole('admin');
            } else {
                $user->assignRole('user');
            }

            return redirect(route('user.index'))->with('success', 'Pengguna berhasil dibuat.');
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
                    'password' => 'required|string|min:8',
                    'roles' => 'required|string|in:admin,user',
                ]
            );

            if ($validator->fails()) {
                continue; // Skip baris yang tidak valid
            }

            // Buat user baru
            $user = User::create([
                'name' => ucwords(strtolower($name)),  // Merubah menjadi kapital huruf depan
                'username' => ucwords(strtolower($nim)),
                'email' => strtolower($email),
                'password' => Hash::make($password),
            ]);

            // Simpan NIM ke tabel students
            Student::create([
                'user_id' => $user->id,
                'nama_lengkap' => ucwords(strtolower($name)),  // Merubah menjadi kapital huruf depan
                'nim' => ucwords(strtolower($nim)),
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
    public function show(User $user)
{
    // Retrieve the student record based on the user_id
    $student = Student::where('user_id', $user->id)->firstOrFail();

    // Retrieve the presences related to the student and paginate them
    $presences = Presence::where('student_id', $student->id)
        ->latest()
        ->paginate(10)
        ->withQueryString();

    // Count the occurrences of each attendance_id
    $attendanceCounts = Presence::where('student_id', $student->id)
        ->selectRaw('attendance_id, COUNT(*) as count')
        ->groupBy('attendance_id')
        ->get()
        ->keyBy('attendance_id')
        ->map(function ($item) {
            return $item->count;
        });

    // Get counts for each specific attendance_id
    $attendanceStatuses = [
        'alpa' => $attendanceCounts->get(1, 0), // Default to 0 if not found
        'hadir' => $attendanceCounts->get(2, 0),
        'izin' => $attendanceCounts->get(3, 0),
        'sakit' => $attendanceCounts->get(4, 0),
    ];

    // Pass the data to the view
    return view('pages.users.show', [
        'student' => $student,
        'presences' => $presences,
        'attendanceStatuses' => $attendanceStatuses,
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'nim' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id), // ignore current user's nim
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id), // ignore current user's email
            ],
            'password' => 'nullable|string|min:2', // password is optional for update
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Update user data
            $user->name = ucwords(strtolower($request->name));
            $user->username = ucwords(strtolower($request->nim));
            $user->email = strtolower($request->email);
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Update student data (assuming user_id is stored in students table)
            $student = Student::where('user_id', $user->id)->first();
            if ($student) {
                $student->nama_lengkap = ucwords(strtolower($request->name));
                $student->nim = ucwords(strtolower($request->nim));
                $student->save();
            }

            return redirect(route('user.index'))->with('success', 'Data pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data pengguna gagal diperbarui');
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pengguna gagal dihapus');
        }
    }
}


