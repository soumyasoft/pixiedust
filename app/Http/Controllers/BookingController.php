<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\IntutiveReadingBooking;
use \App\MassageTherapyBooking;
use DB;

class BookingController extends Controller {

    public function chkIntutiveReadingTime(Request $request) {
        if ($request->date != "") {
            $getIntutiveBookings = IntutiveReadingBooking::where('booking_date', $request->date)->get();
            $timeArr = [];
            foreach ($getIntutiveBookings as $getIntutiveBooking) {
                $timeArr[] = $getIntutiveBooking->booking_time;
            }
            $timeArrImpl = implode(",", $timeArr);
            $timeArrExpl = explode(',', $timeArrImpl);
            if ($getIntutiveBookings) {
                return response()->json(['status' => 'success', 'bookedData' => $timeArrExpl]);
            }
        }
    }

    public function availableTimeCheck(Request $request) {        
        $timeArrImpl = implode("|", $request->timeArray);        
        //dd($timeArrImpl);
        
        $checkAvailableTime = IntutiveReadingBooking::where('booking_date', $request->bookDate)->whereRaw('concat(",", booking_time ,",") REGEXP ?', ['[[:<:]]'.$timeArrImpl.'[[:>:]]'])->count();
        dd($checkAvailableTime);
    }

}
