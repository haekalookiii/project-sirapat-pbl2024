<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresenceRequest;
use App\Models\Attendance;
use App\Models\Presence;
use App\Models\Schedule;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index()
    {
        return view('pages.presences.index', [
            'schedules' => Schedule::with(['presence'])->latest()->paginate(10),
        ]);
    }

    public function show(Schedule $schedule)
    {
        // dd($schedule->presence());
        return view('pages.presences.show', [
            'id_jadwal' => $schedule->id,
            'presences' => $schedule->presence()->with(['schedule', 'student', 'attendance'])->latest()->paginate(10)->withQueryString()
        ]);
    }


    public function create()
    {
        $schedules = Schedule::all();
        return view('pages.presences.create', compact('schedules'));
    }

    public function store(Request $request)
    {
        $schedule_id = $request->input('schedule_id');
        $schedule = Schedule::findOrFail($schedule_id);
        $students = Student::all();
        $defaultAttendanceStatus = 1;

        $openedAt = Carbon::now();
        $closedAt = $openedAt->copy()->addMinutes(1);

        foreach ($students as $student) {
            Presence::create([
                'schedule_id' => $schedule_id,
                'student_id' => $student->id,
                'attendance_id' => $defaultAttendanceStatus,
                'opened_at' => $openedAt,
                'closed_at' => $closedAt,
            ]);
        }

        return back()->with('success', 'Presensi berhasil dibuat.');
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Presence $presence)
    {
        
        // Validasi input
        $request->validate([
            'attendance_status' => 'required|integer',
        ]);

        try {
            // Update presence dengan status baru
            $presence->attendance_id = $request->input('attendance_status');
            $presence->schedule_id;
        //  dd($presence);
            // Save the presence instance to the database
            $presence->save();

            // Redirect kembali dengan pesan sukses
            return back()
            ->with('success', 'Status kehadiran berhasil diupdate.');
        } catch (\Exception $e) {
            // Jika ada kesalahan, tangani dengan menampilkan pesan error
            return back()
            ->with('error', 'Gagal mengupdate status kehadiran: ' . $e->getMessage());
        }

    }
}