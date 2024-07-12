<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Ambil pengguna yang sedang login
    $user = Auth::user();
    
    // Ambil parameter pencarian dan filter bulan
    $query = $request->input('query');
    $month = $request->input('month');

    // Periksa peran pengguna
    if ($user->hasRole('admin')) {
        // Query untuk mendapatkan jadwal dengan pencarian dan filter bulan
        $schedules = Schedule::with(['presence'])
            ->when($query, function($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
            ->when($month, function($queryBuilder) use ($month) {
                $queryBuilder->whereMonth('start_date', $month);
            })
            ->latest()
            ->paginate(5);

        return view('pages.app.dashboard-sirapat', [
            'schedules' => $schedules,
        ]);
    }

    // Ambil data siswa yang terkait dengan pengguna yang login
    $student = $user->student;

    // Ambil data presensi untuk siswa yang sedang login dan urutkan berdasarkan created_at dari yang terbaru ke yang terlama
    $presences = $student->presences()
        ->with(['schedule', 'student', 'attendance'])
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    return view('pages.app.dashboard-sirapat', [
        'type_menu' => '',
        'presences' => $presences,
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
        'status' => 'required|string|in:Hadir,Izin,Sakit',
    ]);

    try {
        // Map the status to attendance_id
        $attendanceIdMap = [
            'Hadir' => 2,
            'Izin' => 3,
            'Sakit' => 4,
        ];

        $attendanceId = $attendanceIdMap[$validasiData['status']];

        // Update presence dengan status baru
        $presence->update([
            'attendance_id' => $attendanceId
        ]);

        // Return a JSON response with a success message
        return response()->json(['success' => 'Status kehadiran berhasil diupdate.'], 200);
    } catch (\Exception $e) {
        // Return a JSON response with an error message
        return response()->json(['error' => 'Gagal mengupdate status kehadiran: ' . $e->getMessage()], 500);
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
