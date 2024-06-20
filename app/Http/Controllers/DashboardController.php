<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Schedule;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Periksa peran pengguna
        if ($user->hasRole('admin')) {
            // Jika peran pengguna adalah admin, langsung kembalikan tampilan dashboard admin
            return view('pages.app.dashboard-sirapat',[
            'schedules' => Schedule::with(['presence'])->latest()->paginate(10),
        ]);
        }

        // Ambil data siswa yang terkait dengan pengguna yang login
        $student = $user->student;

        // if (!$student) {
        //     abort(404, 'Student not found');
        // }

        // Ambil data presensi untuk siswa yang sedang login
        $presences = $student->presences()->with(['schedule', 'student', 'attendance'])->paginate(10);

        return view('pages.app.dashboard-sirapat', [
            'type_menu' => '',
            'presences' => $presences
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presence $presence)
    {
        
        // Validasi input
        $validasiData = $request->validate([
            'attendance_id' => 'required|integer',
        ]);

        try {
            // Update presence dengan status baru
            $validasiData['attendance_id'] = $request->attendance_id;
            // dd($validasiData['attendance_id']);
            // Save the presence instance to the database
            Presence::findOrFail($presence->id)->update([
                'attendance_id' => $validasiData['attendance_id']
            ]);
            // Redirect kembali dengan pesan sukses
            return redirect()->route('home')->with('success', 'Status kehadiran berhasil diupdate.');
        } catch (\Exception $e) {
            // Jika ada kesalahan, tangani dengan menampilkan pesan error
            return redirect()->route('home')->with('error', 'Gagal mengupdate status kehadiran: ' . $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
