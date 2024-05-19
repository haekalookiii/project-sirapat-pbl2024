<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Catch_;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ->withQueryString()
        $student = Student::paginate(1);
        return view('pages.students.index', ['students' => $student]);
    }
    public function create()
    {
        return view('pages.students.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $validasiData = $request->validate([
            'nama_lengkap' => 'required',
            'nim' => 'required',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'angkatan_mahasiswa' => 'nullable|numeric',
            'hobby' => 'nullable|array',    
        ]);
        //dd($validasiData['foto_profil']);
        try {
            // Tidak perlu validasi tambahan untuk foto di sini
            
            
            // $fotoPath = null;
            /*dd(
                $request-> foto_profil ->getClientOriginalName()
            );*/
            // Simpan foto profil jika diunggah
            if ($request->hasFile('foto_profil')) {
            $validasiData['foto_profil'] = $request-> foto_profil ->getClientOriginalName();
            $validasiData['foto_profil'] = $request-> foto_profil ->storeAs('mhs-img/'.$validasiData['nim'],$validasiData['foto_profil']);
            //dd ($validasiData['foto_profil']);
        }

            // Konversi array 'hobby' menjadi string dipisahkan oleh koma
            $validasiData['hobby'] = $request->input('hobby') ? implode(',', $request->input('hobby')) : null;

            // Simpan data ke dalam basis data
            Student::create(
                $validasiData
            );

            return redirect(route('student.index'))->with('success', 'Data Berhasil Disimpan');
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function edit(Student $student)
    {
        return view('pages.students.edit')->with('student', $student);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validasiData = $request->validate([
            'nama_lengkap' => 'required',
            'nim' => 'required',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'angkatan_mahasiswa' => 'nullable|numeric',
            'hobby' => 'nullable|array',    
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
            $student->update($validasiData);

            return redirect()->route('student.index')->with('success', 'Edit Student Successfully');
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
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //dd($student->nim);
        Student::destroy($student->id);
        Storage::deleteDirectory('mhs-img/'.$student->nim);
        return redirect()->route('student.index')->with('success', 'Delete Student Successfully');
    }

}
