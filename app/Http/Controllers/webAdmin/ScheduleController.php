<?php

namespace App\Http\Controllers\webadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\webAdmin\Schedule;
use App\Models\webAdmin\Doctor;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin.view-schedules', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::where('status', 1)->get();
        return view('admin.add-schedule', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'schedule_by' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule = new Schedule;
        $schedule->doctor_id = $request->doctor_id;
        $schedule->schedule_by = $request->schedule_by;
        $schedule->day = $request->day;
        $schedule->date = $request->date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = 1;
        $schedule->save();
        return redirect()->route('webadminschedule.index')->with('schedule_added', 'Schedule added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $schedule = Schedule::find($id);
        $doctors = Doctor::get();
        return view('admin.edit-schedule', compact('schedule', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required',
            'schedule_by' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule = Schedule::find($id);
        $schedule->doctor_id = $request->doctor_id;
        $schedule->schedule_by = $request->schedule_by;
        $schedule->day = $request->day;
        $schedule->date = $request->date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->status = 1;
        $schedule->save();
        return redirect()->route('webadminschedule.index')->with('schedule_updated', 'Schedule Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect()->route('webadminschedule.index')->with('schedule_deleted', 'Schedule deleted successfully.');
    }
    // Ajax Enable/Disable Status 
    public function changeStatus($id) {

        $schedule = schedule::find($id);
        $class = '';
        
        if($schedule->status == 0) {
            $schedule->status = 1;
            $text = 'Enabled';
            $removeClass = 'bg-danger';
            $class = 'bg-success';
        } else {
            $schedule->status = 0;
            $text = 'Disabled';
            $removeClass = 'bg-success';
            $class = 'bg-danger';
        }

        if($schedule->save()) {
            $st = 1;
            $msg = 'Status Updated Successfully';
        } else {
            $st = 0;
            $msg = 'Unable to disable Text';
        }
        return response()->json([
            'status' => $st,
            'text' => $text,
            'msg' => $msg,
            'class' => $class,
            'removeClass' => $removeClass
        ]);
    }
}
