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

    public function create(Schedule $schedule)
    {
        return view('pages.schedules.schedule-form',['data' => $schedule, 'action' => route('schedule.store')]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchedulRequest $request, Schedule $schedule)
    {
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->title = $request->title;
        $schedule->category = $request->category;

        $schedule->save();

        return back()
        ->with('success', 'Schedule created successfully.');
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
