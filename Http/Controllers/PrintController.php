<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use App\Payment;
use App\Record;
use App\Collection;
use DB;

class PrintController extends Controller
{
    public function index()
    {
    	
    }
    public function printPreview($id)
    {
     $post=Record::find($id);
   $customers = Record::with('payments')->find($id)->payments;
    return View::make('users.printPreview')->with('customers', $customers)->with('post',$post);
    }


    public function PrintPreviewC1()
    {
       $total = Collection::where('collector_id', '=', 1)->sum('package');

        $collectors = DB::table('collections')
           ->join('records','records.id','=','collections.record_id')
           ->where('collector_id', '=', 1)
           ->select('collections.id as col_id','records.*','collections.month','collections.year','collections.collector_id')
           ->get();

           

      return View::make('users.printpreviewc1', compact('collectors',$collectors))->with('total',$total);

    }
     public function PrintPreviewC2()
    {
        $total = Collection::where('collector_id', '=', 2)->sum('package');
        $collectors = DB::table('collections')
           ->join('records','records.id','=','collections.record_id')
           ->where('collector_id', '=', 2)
           ->select('collections.id as col_id','records.*','collections.month','collections.year','collections.collector_id')
           ->get();

           

      return View::make('users.printpreviewc2', compact('collectors',$collectors))->with('total',$total);

    }
     public function PrintPreviewC3()
    {
       $total = Collection::where('collector_id', '=', 3)->sum('package');

        $collectors = DB::table('collections')
           ->join('records','records.id','=','collections.record_id')
           ->where('collector_id', '=', 3)
           ->select('collections.id as col_id','records.*','collections.month','collections.year','collections.collector_id')
           ->get();

           

      return View::make('users.printpreviewc3', compact('collectors',$collectors))->with('total',$total);

    }
    
     public function PrintPreviewC4()

    {

      $total = Collection::where('collector_id', '=', 4)->sum('package');

        $collectors = DB::table('collections')
           ->join('records','records.id','=','collections.record_id')
           ->where('collector_id', '=', 4)
           ->select('collections.id as col_id','records.*','collections.month','collections.year','collections.collector_id')
           ->get();

           

      return View::make('users.printpreviewc4', compact('collectors',$collectors))->with('total',$total);

    }
}
