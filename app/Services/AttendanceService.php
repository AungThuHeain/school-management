<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceService
{
    public function getUsers()
    {
         return User::withoutRole('Owner')->get();
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
