<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promocode;

class PromocodeResource extends Controller
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
        $Promocode = Promocode::all();
        if($request->ajax()) {
            return $Promocode;
        } else {
            return view('coinadmin.promocode.index', compact('Promocode'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coinadmin.promocode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'promo_code' => 'required|unique:promocodes',
            'percentage' => 'required',
            'expiration' => 'required',
        ]);

        try {

            $Promocode = $request->all();

            $Promocode = Promocode::create($Promocode);

            return back()->with('flash_success','Promocode Saved Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Promocode Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promocode  $Promocode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Promocode::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Promocode Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promocode  $Promocode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $Promocode = Promocode::findOrFail($id);
            
            return view('coinadmin.promocode.edit',compact('Promocode'));
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Promocode Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promocode  $Promocode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'promo_code' => 'required|unique:promocodes,promo_code,'.$id,
            'percentage' => 'required', 
            'expiration' => 'required', 

        ]);

        try {

            $Promocode = Promocode::findOrFail($id);

            $Promocode->promo_code = $request->promo_code;
            $Promocode->percentage = $request->percentage;
            $Promocode->expiration = $request->expiration;

            $Promocode->save();

            return redirect()->route('coinadmin.promocode.index')->with('flash_success', 'Promocode Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Promocode Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promocode  $Promocode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            Promocode::find($id)->delete();
            return back()->with('message', 'Promocode deleted successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Promocode Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Promocode Not Found');
        }
    }


}
