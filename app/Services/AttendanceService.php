<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceService
{
    public function getUsers()
    {
        if(request('class_filter') == 'all')
        {
            return User::withoutRole('Owner')->filter(request()->only('s'))->get();
        }

        if(request()->has('class_filter') ){
            return User::where('class_id',request('class_filter'))->withoutRole('Owner')->filter(request()->only('s'))->get();
        }

         return User::withoutRole('Owner')->filter(request()->only('s'))->get();
    }

    public function getClasses()
    {
        return ClassRoom::all();
    }

    public function store(Request $request)
    {
       $attendance = Attendance::where('user_id',$request->user_id)->where('attendance_date',$request->attendance_date)->where('type',$request->type)->first();

       $checkOlCheckInOutdata = Attendance::where('user_id',$request->user_id)->where('attendance_date',$request->attendance_date)->whereIn('type',[1,2])->get();
       $checkLeavedata = Attendance::where('user_id',$request->user_id)->where('attendance_date',$request->attendance_date)->where('type',3)->first();

       if($request->type == 3 && $checkOlCheckInOutdata){

            //delete all check in check out data
            foreach($checkOlCheckInOutdata as $checkOlCheckInOut){
                $checkOlCheckInOut->delete();
            }

            //create new leave data
           if($attendance){
                $attendance->delete();
           }else{
                Attendance::create([
                    'user_id'=>$request->user_id,
                    'attendance_date'=>$request->attendance_date,
                    'type'=>$request->type,
                    'attendance_time'=> date('H:i:s')
                ]);
           }

       }else{
            //delete old leave date
            $checkLeavedata?->delete();

            //create new check in check out data
            if($attendance){
                $attendance->delete();
            }else{
                Attendance::create([
                    'user_id'=>$request->user_id,
                    'attendance_date'=>$request->attendance_date,
                    'type'=>$request->type,
                    'attendance_time'=> date('H:i:s')
                ]);
            }

       }


    }
}
