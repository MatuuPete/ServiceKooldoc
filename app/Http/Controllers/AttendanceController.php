<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Technician;
use Validator;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $technician = $user->technician;
        $technician_id = $technician->id;

        $attendance = new Attendance;

        $attendance->technician_id = $technician_id;
        $attendance->attendance_date = Carbon::now('Asia/Manila')->format('Y-m-d');
        $attendance->time_in = Carbon::now('Asia/Manila')->format('h:i:s A');

        $attendance->remarks = $request->remarks;

        $attendance->save();

        $attendance_time_in = Carbon::createFromFormat('h:i:s A', $attendance->time_in, 'Asia/Manila');

        $workday_start = Carbon::now('Asia/Manila')->startOfDay()->addHours(6);

        if ($attendance_time_in->diffInMinutes($workday_start) < 30) 
        {
            $attendance->attendance_status = 'present';
        } 
        elseif ($attendance_time_in->diffInMinutes($workday_start) >= 30 && $attendance_time_in->diffInMinutes($workday_start) < 60) 
        {
            $attendance->attendance_status = 'late';
        } 
        else 
        {
            $attendance->attendance_status = 'absent';
        }

        $attendance->save();

        return response()->json([
            'message' => 'Attendance added successfully!',
            'attendance' => $attendance,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Attendance::where('id', $id)->with('technician')->first(), 200);
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
        $attendance = Attendance::find($id);

        if (is_null($attendance->time_out)) 
        {
            $attendance->time_out = Carbon::now('Asia/Manila')->format('h:i:s A');
        }

        $in_value = Carbon::parse($attendance->time_in);
        $out_value = Carbon::parse($attendance->time_out);

        $total_minutes = $out_value->diffInMinutes($in_value);
        $total_hours = floor($total_minutes / 60);
        $total_minutes = $total_minutes % 60;

        $attendance->total_time = $total_hours . ' hour/s & ' . $total_minutes . ' minute/s';
        
        $attendance->update($request->only(['attendance_status', 'remarks']));

        return response()->json([
            'message' => 'Attendance updated successfully!',
            'attendance' => $attendance,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();
        return response()->json(['message' => 'Attendance deleted successfully']);
    }
}
