<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Storage;
use App\KycDocument;

class UserResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $User = User::all();

        if($request->ajax()) {

            return $User;

        } else {
            
            return view('coinadmin.user.index', compact('User'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('coinadmin.User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->validate($request, [
        //     'name' => 'required|max:255',
        //     'address' => 'required|max:255', 
        // ]);

        // try {

        //     $Coin = $request->all();

        //     if($request->hasFile('qr_code')) {

        //         //$Coin['qr_code'] = $request->qr_code->store('qrcode');
        //         $Coin['qr_code'] = asset('storage/'.$request->qr_code->store('qrcode'));
            
        //     }

        //     $Coin = User::create($Coin);

        //     return back()->with('flash_success','Coin Type Saved Successfully');
        // } catch (Exception $e) {
        //     dd("Exception", $e);
        //     return back()->with('flash_error', 'Coin Type Not Found');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // try {
        //     return User::findOrFail($id);
        // } catch (ModelNotFoundException $e) {
        //     return back()->with('flash_error', 'Coin Type Not Found');
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // try {
        //     $Coin = User::findOrFail($id);
            
        //     return view('coinadmin.User.edit',compact('Coin'));
        // } catch (ModelNotFoundException $e) {
        //     return back()->with('flash_error', 'Coin Type Not Found');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // $this->validate($request, [
        //     'name' => 'required|max:255',
        //     'address' => 'required|max:255',

        // ]);

        // try {

        //     $Coin = User::findOrFail($id);

        //     if($request->hasFile('qr_code')) {

        //         //$Coin['qr_code'] = $request->qr_code->store('qrcode');
        //         $Coin->qr_code = asset('storage/'.$request->qr_code->store('qrcode'));
            
        //     }

        //     $Coin->name = $request->name;
        //     $Coin->address = $request->address;

        //     $Coin->save();

        //     return redirect()->route('coinadmin.User.index')->with('flash_success', 'Coin Type Updated Successfully');    
        // } 

        // catch (ModelNotFoundException $e) {
        //     return back()->with('flash_error', 'Coin Type Not Found');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        // try {
        //     User::find($id)->delete();
        //     return back()->with('message', 'Coin Type deleted successfully');
        // } catch (ModelNotFoundException $e) {
        //     return back()->with('flash_error', 'Coin Type Not Found');
        // } catch (Exception $e) {
        //     return back()->with('flash_error', 'Coin Type Not Found');
        // }
    }


    public function history($id)
    {
        
        try {
            $User = User::with('transaction')->findOrFail($id);
            return view('coinadmin.user.history', compact('User'));
        } catch (Exception $e) {
            return back()->with('flash_error', 'User Not Found');
        }
    }

     public function kycdoc($id)
    {
        
        try {

            $Doc = KycDocument::where('user_id',$id)->get();
            
            return view('coinadmin.user.document', compact('Doc'));
        } catch (Exception $e) {

            return back()->with('flash_error', 'User Not Found');
        }
    }

     public function approve($id)
    {
        try {

            $Kyc = KycDocument::where('user_id',$id)->where('status',"DISAPPROVED")->count();

            if($Kyc > 0)
            {
                return back()->with('flash_error', "Kyc Documents are still not verified !");
            } 

            $user = User::findOrFail($id);


        
                $user->update(['status' => 1]);
                return back()->with('flash_success', "User Approved");
            
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', "Something went wrong! Please try again later.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function disapprove($id)
    {
        
        User::where('id',$id)->update(['status' => 0]);
        return back()->with('flash_error', "User Disapproved");
    }

    public function Add($id)
    {
        $User = User::find($id);
        return view('coinadmin.user.addcoin', compact('User'));
    }

    public function addCoin(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|numeric',
        ]);

        $User = User::find($request->id);
        $User->ico_balance = $request->token;
        $User->save();

        return back()->with('flash_success', "Coin Updated");
    }



}
