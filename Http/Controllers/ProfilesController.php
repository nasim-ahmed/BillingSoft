<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;
use App\Payment;
use App\Record;
use DB;

class ProfilesController extends Controller
{

  public function index()
  {
       
   
  }

  public function create()
  {

  }

  public function view($id)
  {
  

  // $customers = Record::with('payments')->find($id)->payments;
  //   return View::make('users.profile')->with('customers', $customers);
  
  }


  public function update()
  {

  }
  public function delete()
  {

  }
  public function show($id)
  {
  	$post=Record::find($id);
    $customers = Record::with('payments')->find($id)->payments;
    return View::make('users.profile')->with('customers', $customers)->with('post',$post);

  }
  public function getName($id)
  {
  	// $post=Record::find($id);
   // return view('users.profile')->withPost($post);

  }

}