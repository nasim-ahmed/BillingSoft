<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Record;
use App\Collection;
use App\User;
use Session;

class RecordsController extends Controller
{

    /** this is for test purpose**/

    public function success()
    {
        return view('users.success');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.record');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

         $this->validate($request,[
             'user_name'=>'required',
             'package' =>'required'
            ]);


        $usernameTxt=$request['user_name'];
        $userIdTxt=$request['customer_id'];
        $addressTxt=$request['address'];
        $phoneTxt=$request['phone_no'];
        $packageTxt=$request['package'];
        
        $initial_payTxt=$request['ini_payment'];
        $join_date=$request['join_date'];
        $infoTxt=$request['info'];
        $admin = Auth::user();
        


        $username= Record::where('user_name', $usernameTxt)->first();
        

        if(!$username)
        {
            $newEntry=new Record();

            $newEntry->user_name=$usernameTxt;
            $newEntry->user_id=$userIdTxt;
            $newEntry->address=$addressTxt;
            $newEntry->phone_no=$phoneTxt;
            $newEntry->package=$packageTxt;
            $newEntry->ini_payment=$initial_payTxt;
            $newEntry->join_date=$join_date;
            $newEntry->info=$infoTxt;
            $newEntry->user_id=$admin;

            $newEntry->save();

            // $admin->records()->save($newEntry);
        }
        

       return redirect()->intended('/home/record')->with([
         'success' => 'Data saved successfully!'

         ]);


    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Record::find($id);
        return view('users.edit')->withPost($post);
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


        $this->validate($request,[
             'user_name'=>'required',
             'package' =>'required'
            ]);
            $post=Record::find($id);
            $post->user_name=$request->input('user_name');
            $post->user_id=$request->input('user_id');
            $post->address=$request->input('address');
            $post->phone_no=$request->input('phone_no');
            $post->package=$request->input('package');
            $post->ini_payment=$request->input('ini_payment'); 
            $post->join_date=$request->input('join_date');        
            $post->info=$request->input('info');
            $post->save();


        
            Session::flash('success', 'This post was successfully saved.');
            // return redirect()->route('dashboard');
             return redirect()->intended('/home')->with([
         'success' => 'Data saved successfully!'

         ]);
            

    }

    

    public function delete($id)
    {
     $delete=Record::find($id);

     if (!is_null($delete)) {
      $delete->delete();
     }
     
     return redirect()->intended('/home')->with([
         'success' => 'Record has been Deleted successfully!'

         ]);
     

    }

   

   
}