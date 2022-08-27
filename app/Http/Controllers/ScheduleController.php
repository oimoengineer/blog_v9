<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('fullcalendar');
    }
    
    public function show(Request $request)
    {
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer'
        ]);
        
        //カレンダー表示期間
        $start_date = date('Y-m-d', $request->input('start_date')/1000);
        $end_date = date('Y-m-d', $request->input('end_date')/1000);
        
        return Schedule::query()
            ->select(
                    'start_date as start',
                    'end_date as end',
                    'event_name as title',
                )
                ->where('end_date', '>', $start_date)
                ->where('start_date', '<', $end_date)
                ->get();
    }
    
    public function create()
    {
        return view('fullcalendar/create');
    }
    
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'event_name' => 'required|max:32',
        ]);
        
        //register
        $schedule = new Schedule;
        $schedule->start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $schedule->end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $schedule->event_name = $request->input('event_name');
        $schedule->save();
        
        return;
    }
}
