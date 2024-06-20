<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validasiData = $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama_lengkap' => 'required',
            'nim' => 'required',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'angkatan_mahasiswa' => 'nullable|numeric',

        ]);
        try {
            // Validasi data
            $validasiData = $request->validated();

            // Periksa apakah ada file foto baru yang diunggah
            if ($request->hasFile('foto_profil')) {
                // Simpan foto baru dan atur path di kolom foto_profil
                $validasiData['foto_profil'] = $request-> foto_profil ->getClientOriginalName();
                $validasiData['foto_profil'] = $request-> foto_profil ->storeAs('mhs-img/'.$validasiData['nim'],$validasiData['foto_profil']);
                
                // Hapus foto lama jika ada
                if ($student->foto_profil) {
                    $validasiData['foto_profil'] = Storage::deleteDirectory('mhs-img/'.$validasiData['nim']);
                    $validasiData['foto_profil'] = null;
                }
                
            } else {
                // Jika tidak ada file baru, gunakan foto lama
                $validasiData['foto_profil'] = $student->foto_profil;
            }
            
            $validasiData['hobby'] = $request->input('hobby') ? implode(',', $request->input('hobby')) : $student->hobby;

            // Update data
            $student = Student::findOrFail($request->user()->student->id);
            $student->update($validasiData);

            return redirect()->route('profile.index')->with('success', 'Edit Student Successfully');
        } catch (QueryException $e) {
            // Menangani kesalahan duplikat pada nim
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Nomor Induk Mahasiswa sudah terdaftar.');
            }

            // Jika terjadi kesalahan lain, Anda dapat menangani sesuai kebutuhan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Menyimpan perubahan foto profil pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfilePicture(UpdateStudentRequest $request, Student $student)
    {
    try {
        $validasiData = $request->validated();
        // Ambil NIM mahasiswa yang sedang login
        $nim = $request->user()->student->nim;
        
        // Periksa apakah ada file foto baru yang diunggah
        if ($request->hasFile('foto_profil')) {
            // Simpan foto baru dan atur path di kolom foto_profil
                $validasiData['foto_profil'] = $request-> foto_profil ->getClientOriginalName();
                $validasiData['foto_profil'] = $request-> foto_profil ->storeAs('mhs-img/'.$nim,$validasiData['foto_profil']);
                
                // Hapus foto lama jika ada
                if ($student->foto_profil) {
                    $validasiData['foto_profil'] = Storage::deleteDirectory('mhs-img/'.$nim);
                    $validasiData['foto_profil'] = null;
                }
            } else {
                // Jika tidak ada file baru, gunakan foto lama
                $validasiData['foto_profil'] = $student->foto_profil;
            }

        $student = Student::findOrFail($request->user()->student->id);
            $student->update($validasiData);

            return redirect()->route('profile.index')->with('success', 'Ubah Foto Profil Berhasil');
        } catch (QueryException $e) {
            // Jika terjadi kesalahan lain, Anda dapat menangani sesuai kebutuhan
            return redirect()->back()->with('error', 'Gagal, Silahkan Coba Lagi.');
        }
    }
}
