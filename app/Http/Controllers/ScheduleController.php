<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchedulRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::paginate(10)->withQueryString();
        return view('pages.schedules.index', ['schedules' => $schedules]);
    }

    public function listSchedule(Request $request){
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        $schedules = Schedule::where('start_date', '>=', $start)
        ->where('end_date', '<=', $end)->get()
        ->map( fn ($item) => [
            'id' => $item->id,
            'title' => $item->title,
            'start' => $item->start_date,
            'end' => $item->end_date,
            'category' => $item->category
        ]);
        return response()->json($schedules);
    }

    public function create()
    {
        return view('pages.schedules.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchedulRequest $request)
    {
        Schedule::create([
            'subject_id' => $request['subject_id'],
            'hari' => $request['hari'],
            'jam_mulai' => $request['jam_mulai'],
            'jam_selesai' => $request['jam_selesai'],
            'ruangan' => $request['ruangan'],
            'kode_absensi' => $request['kode_absensi'],
            'tahun_akademik' => $request['tahun_akademik'],
            'semester' => $request['semester'],
            'created_by' => $request['created_by'],
            'updated_by' => $request['updated_by'],
            'deleted_by' => $request['deleted_by'],
        ]);

        return redirect(route('schedule.index'))->with('success', 'data berhasil disimpan');
    }

    public function edit(Schedule $schedule)
    {
        return view('pages.schedules.edit')->with('schedule', $schedule);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $validate = $request->validated();
        $schedule->update($validate);
        return redirect()->route('schedule.index')->with('success', 'Edit Schedule Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedule.index')->with('success', 'Delete Schedule Successfully');
    }
}
