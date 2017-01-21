<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use App\Payment;
use App\Record;
use App\Collection;
use DB;





class PaymentsController extends Controller
{

	public function index()
	{
       
        
      
      $records = Record::all(['id', 'user_name']);
      return view('users.payment', compact('records',$records));

	}

	public function create()
	{
		

     

	}
	public function add()
	{
		

	}

   
    public function getRecord(Request $request)

   {
    $record_id = $request->get('record_id');          
    $customers=Record::where('id','=',$record_id)->get();
    return response()->json(['response' => $customers]);
   }






	public function delete()
	{


	}

    public function store (Request $request)
    {
        $inputs=$request->all();

        







        $months=$inputs['month'];
        $record=new Record();
        $payment=new Payment();

        


        $data = []; 
        foreach ($months as $month) {
            $data[] = [
                'paid_at' => $inputs['paid_at'],
                'year'    => $inputs['year'],
                'month'   => $month,              
                'package' => $inputs['package'],
                'amount'  => $inputs['amount'],
                'due'     => $inputs['due'],
                'record_id' => $inputs['record_id']
            ];
        }

        // DB::table('payments')->insert($data);

        
        


      $record->payments()->insert($data);
      


       return redirect()->intended('/home/payment')->with([
         'success' => 'THANKS.INFORMATION HAS BEEN RECORDED!'

         ]);
    }
	
	
	public function payment_status(){
		$todayMonth=date('n');
		$paymentMonths=array_fill(1, $todayMonth, false);
		
		$results=DB::table('payments')
                     ->where('record_id', '1')
                     ->get();
		foreach ($results as $result) {
			$paymentMonths[$result->month]=true;
    		}
    		
    		return $paymentMonths;

	}
	
}
