<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Record;
use DB;


class DashBoardsController extends Controller
{

	public function index()
	{
        // $customers=zipdatabase::table('records')->get();
        // $customers = Record::with('records')->get();
		// return view('users.dashboard',compact('customers'));
		// return view('users.dashboard');
		
		$year2 = date('Y');
		$month2 = date('m');

		
		$todayMonth=date('n');

		$users = DB::table('records')->get();
		foreach ($users as $user) {
			$d=strtotime($user->join_date); // $user->join_date
			
			$year1 = date('Y', $d);
			$month1 = date('m', $d);
			$diff = (($year2 - $year1) * 12) + ($month2 - $month1)+1;
			
			
			$results=DB::table('payments')
                     	->where('record_id', $user->id)
                     	->get();
                     	
			$resSize=sizeof($results);
	    		
	    		if($resSize!=$diff){
	    			$user->status='Due';
	    		}else $user->status='Clear';
	    		
	    		//if($user->id=='2') return $paymentMonths;

    		}

        	return view('users.dashboard', ['users' => $users]);
	}
}