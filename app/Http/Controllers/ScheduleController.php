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
            ->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'agenda' => $item->agenda,
                'start' => $item->start_date,
                'end' => date('Y-m-d', strtotime($item->end_date . '+1 days')),
                'category' => $item->category,
                'locate' => $item->locate, // Adding locate to the response
                'className' => ['bg-' . $item->category]
            ]);
        return response()->json($schedules);
    }

    public function create(Schedule $schedule)
    {
        return view('pages.schedules.schedule-form', ['data' => $schedule, 'action' => route('schedule.store')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchedulRequest $request, Schedule $schedule)
    {
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->title = $request->title;
        $schedule->agenda = $request->agenda;
        $schedule->category = $request->category;
        $schedule->locate = $request->locate; // Adding locate to store method

        $schedule->save();

        return back()
            ->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        return view('pages.schedules.schedule-form', [
            'data' => $schedule,
            'action' => route('schedule.update', $schedule->id)
        ]);
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
    public function update(StoreSchedulRequest $request, Schedule $schedule)
    {
        if ($request->has('delete')) {
            return $this->destroy($schedule);
        }
        // Update the schedule item with the provided data
        $schedule->start_date = $request->start_date;
        $schedule->end_date = $request->end_date;
        $schedule->title = $request->title;
        $schedule->agenda = $request->agenda;
        $schedule->category = $request->category;
        $schedule->locate = $request->locate; // Adding locate to update method
        $schedule->save();

        return back()
            ->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back()
            ->with('success', 'Schedule deleted successfully.');
    }
}
