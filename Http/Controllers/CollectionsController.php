<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use App\Payment;
use App\Record;
use App\Collection;
use Carbon\Carbon;
use DB;

class CollectionsController extends Controller
{
    public function index()
    {
      return view('users.collection');
    }

    //retrieves all username from records table to populate

    public function retrieve()
  {

    $records = Record::all(['id', 'user_name']);
    return View::make('users.collection', compact('records',$records));

  }

  //stores the form data in the table 

  public function store(Request $request)
  {
        $inputs=$request->all();
        $customers=$inputs['record_id'];
        //var_dump($inputs);
        
        $record=new Record();
        

        foreach ($customers as $customer ) {
          
           $user =  DB::table('records')-> select('package')->where('id', '=', $customer)->get();
           // var_dump($user);
           
            $data = [
                'collector_id' => $inputs['collector_id'],
                'month'        => $inputs['month'],
                'record_id'    => $customer,              
                'year'         => $inputs['year'],
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
                'package'      => $user[0]->package
            ];
            
             $record->collections()->insert($data);

            
            
        }
        
       return redirect()->intended('/home/collection')->with([
         'success' => 'THANKS.INFORMATION HAS BEEN RECORDED!'

         ]);

    }

    public function collector_second()
    {
      
      
      $total = Collection::where('collector_id', '=', 2)->sum('package');

      $collectors = DB::table('collections')
           ->join('records','records.id','=','collections.record_id')
           ->where('collector_id', '=', 2)
           ->select('collections.id as col_id','records.*','collections.month','collections.year','collections.collector_id')
           ->get();

           

      return View::make('users.collector2', compact('collectors',$collectors))->with('total',$total);

    }



    public function collector_fourth()
    {
      $total = Collection::where('collector_id', '=', 4)->sum('package');

      $collectors = DB::table('collections')
           ->join('records','records.id','=','collections.record_id')
           ->where('collector_id', '=', 4)
           ->select('collections.id as col_id','records.*','collections.month','collections.year','collections.collector_id')
           ->get();

      return View::make('users.collector4', compact('collectors',$collectors))->with('total',$total);

    }



    public function collector_first()
    
    {
      $total = Collection::where('collector_id', '=', 1)->sum('package');

      $collectors = DB::table('collections')
           
           ->join('records','records.id','=','collections.record_id')
           ->where('collector_id', '=', 1)
           ->select('collections.id as col_id','records.*','collections.month','collections.year','collections.collector_id')
           ->get();

   
      return View::make('users.collector1', compact('collectors',$collectors))->with('total',$total);

    }



     public function collector_third()
    {
      $total = Collection::where('collector_id', '=', 3)->sum('package');

      $collectors = DB::table('collections')
           ->join('records','records.id','=','collections.record_id')
           ->where('collector_id', '=', 3)
           ->select('collections.id as col_id','records.*','collections.month','collections.year','collections.collector_id')
           ->get();

      return View::make('users.collector3', compact('collectors',$collectors))->with('total',$total);

    }

    public function delete($id)
    {
     $delete=Collection::find($id);

     if (!is_null($delete)) {
      $delete->forceDelete();
     }
     
     return redirect()->intended('/home')->with([
         'success' => 'Record has been Deleted successfully!'

         ]);

    }
    


    public function check()
    {
        // $total=DB::table('records')->sum('package');
        // echo $total;

        $total = Collection::where('collector_id', '=', 3)->sum('package');
         $test  =compact('total', $total); 

         // return $test;  

        var_dump($test);


    }

    public function totalBillc3()
    {
      $total = Collection::where('collector_id', '=', 3)->sum('package');
      
      return View::make('users.collector3', compact('total',$total));

            
   
    }


}
