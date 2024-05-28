<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index(Request $request)
    {
        $presence = Presence::with(['schedule', 'student'])
            ->paginate(10); // Pagination with 10 items per page

        return view('pages.presences.index', ['presences' => $presence]);
    }

    public function create()
    {
        $schedules = Schedule::all();
        $students = Student::all();
        
        foreach ($students as $student) {
            foreach ($schedules as $schedule) {
                Presence::create([
                    'schedule_id' => $schedule->id,
                    'student_id' => $student->id,
                    'nim' => $student->nim,
                    'nama_lengkap' => $student->nama_lengkap,
                    'status_kehadiran' => 'Alpa' // atau sesuai dengan logika aplikasi Anda
                ]);
            }
        }

        return redirect()->back()->with('success', 'Presensi berhasil dibuat.');
    }
}
