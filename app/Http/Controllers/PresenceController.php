<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Schedule;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index(Request $request)
{
    $query = Presence::with(['schedule', 'student', 'attendance'])->latest();

    if ($request->has('name')) {
        $name = $request->input('name');
        $query->whereHas('student', function ($query) use ($name) {
            $query->where('nama_lengkap', 'like', '%' . $name . '%'); // Adjust based on the correct column name
        });
    }

    $presences = $query->paginate(10)->withQueryString();

    // Fetch the schedule (assuming you have a way to determine which schedule to display)
    

    return view('pages.presences.index', [
        'presences' => $presences,
    ]);
}


    public function show(Request $request, Schedule $schedule)
{
    $query = $schedule->presence()->with(['schedule', 'student', 'attendance'])->latest();

    // Filter berdasarkan tanggal jika ada input tanggal dari form
    if ($request->has('tanggal')) {
        $tanggal = $request->input('tanggal');
        $query->whereDate('created_at', '=', $tanggal);
    }

    // Filter berdasarkan name jika ada input name dari form
    if ($request->has('name')) {
        $name = $request->input('name');
        $query->whereHas('student', function ($query) use ($name) {
            $query->where('nama_lengkap', 'like', '%' . $name . '%'); // Sesuaikan dengan kolom nama yang benar
        });
    }

    $presences = $query->paginate(10)->withQueryString();

    return view('pages.presences.show', [
        'id_jadwal' => $schedule->id,
        'presences' => $presences,
        'schedule' => $schedule, // Sertakan juga variabel $schedule untuk form filter
    ]);
}




    public function create()
    {
        $schedules = Schedule::all();
        return view('pages.presences.create', compact('schedules'));
    }

    public function store(Request $request)
    {
        try {
            $schedule_id = $request->input('schedule_id');
            $schedule = Schedule::findOrFail($schedule_id);
            $students = Student::all();
            $defaultAttendanceStatus = 1;

            $openedAt = Carbon::now();
            $closedAt = $openedAt->copy()->addMinutes(30);

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
        } catch (\Exception $e) {
            return back()->with('error', 'Presensi gagal dibuat.');
        }
    }


    public function edit(Presence $presence)
    {
        return view('pages.presences.presence-edit-form',['data' => $presence, 'action' => route('presence.store')]);
    }

    public function update(Request $request, Presence $presence)
    {
        // Validasi input
        $request->validate([
            'attendance_id' => 'required|integer',
        ]);

        try {
            // Update presence dengan status baru
            $presence->attendance_id = $request->input('attendance_id');

            // Jika attendance_id adalah 1, set closed_at menjadi opened_at
            if ($request->input('attendance_id') == 1) {
                $presence->closed_at = $presence->opened_at;
            }
            
            // Save the presence instance to the database
            $presence->save();

            // Redirect kembali dengan pesan sukses
            return back()->with('success', 'Status kehadiran berhasil diupdate.');
        } catch (\Exception $e) {
            // Jika ada kesalahan, tangani dengan menampilkan pesan error
            return back()->with('error', 'Gagal mengupdate status kehadiran.');
        }
    }

    public function destroy(Presence $presence)
    {
        try {
            // Hapus presence dari database
            $presence->delete();

            // Redirect kembali dengan pesan sukses
            return back()->with('success', 'Data presensi berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika ada kesalahan, tangani dengan menampilkan pesan error
            return back()->with('error', 'Gagal menghapus data presensi.');
        }
    }
}