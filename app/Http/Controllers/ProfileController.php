<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Mendapatkan pengguna yang saat ini login
        $user = Auth::user();
        // dd($user);

        // Mengambil data mahasiswa terkait dengan pengguna
        // $student = Student::find($user->id);
        // dd($student);
        // return view('pages.profiles.index', compact('student'));
        $student = Student::where('user_id', $user->id)->first();
        
        return view('pages.profiles.index', compact('student'));
        
    }

    public function showProfile()
    {
        // Mengambil pengguna yang sedang login
        $user = auth()->user();

        // Memeriksa apakah pengguna memiliki profil siswa terkait
        if ($user->student) {
            // Jika iya, Anda dapat mengakses foto_profil
            $foto_profil = $user->student->foto_profil;
            // Lakukan apa pun yang perlu Anda lakukan dengan $foto_profil
        } else {
            // Jika tidak, Anda dapat menangani kasus di mana pengguna tidak memiliki profil siswa
        }

        // Kembalikan tampilan dengan data yang diperlukan
        return view('profile', compact('foto_profil'));
    }
}
