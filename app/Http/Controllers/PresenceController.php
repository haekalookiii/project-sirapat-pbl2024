<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresenceRequest;
use App\Models\Attendance;
use App\Models\Presence;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index(Request $request)
    {
        $presence = Schedule::latest()
            ->paginate(10); // Pagination with 10 items per page

        return view('pages.presences.index', ['presences' => $presence]);
    }

    public function create()
    {
        $schedules = Schedule::all();
        return view('pages.presences.create', compact('schedules'));
    }

    public function store(Request $request)
    {
    // Validasi input untuk schedule_id
    $request->validate([
        'schedule_id' => 'required|exists:schedules,id',
    ]);

    // Ambil schedule_id dari request
    $schedule_id = $request->input('schedule_id');

    // Ambil semua siswa
    $students = Student::all();

    // Status kehadiran default (misal: Alpa dengan id 1)
    $defaultAttendanceStatus = 1;

    // Buat presensi untuk setiap siswa dengan status kehadiran default
    foreach ($students as $student) {
        Presence::create([
            'schedule_id' => $schedule_id,
            'student_id' => $student->id,
            'attendance_id' => $defaultAttendanceStatus,
        ]);
    }

    // Redirect kembali dengan pesan sukses
    return redirect()->route('presence.index')->with('success', 'Presensi berhasil dibuat.');
    }

    public function edit(string $id)
    {
        //
    }

    public function show(Presence $presence)
    {
        $presence = $presence->with(['schedule', 'student', 'attendance'])
            ->paginate(10); // Pagination with 10 items per page

        return view('pages.presences.show', ['presences' => $presence]);
    }
}
