<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;

class BonusResource extends Controller
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
        $Bonus = Bonus::all();
        if($request->ajax()) {
            return $Bonus;
        } else {
            return view('coinadmin.bonus.index', compact('Bonus'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coinadmin.bonus.create');
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
            'percentage' => 'required',
            'from' => 'required', 
            'to' => 'required', 
        ]);

        try {

            $Bonus = $request->all();

            $Bonus = Bonus::create($Bonus);

            return back()->with('flash_success','Bonus Saved Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Bonus Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bonus  $Bonus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Bonus::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Bonus Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bonus  $Bonus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $Bonus = Bonus::findOrFail($id);
            
            return view('coinadmin.bonus.edit',compact('Bonus'));
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Bonus Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bonus  $Bonus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'percentage' => 'required',
            'from' => 'required', 
            'to' => 'required', 

        ]);

        try {

            $Bonus = Bonus::findOrFail($id);

            $Bonus->percentage = $request->percentage;
            $Bonus->from = $request->from;
            $Bonus->to = $request->to;

            $Bonus->save();

            return redirect()->route('coinadmin.bonus.index')->with('flash_success', 'Bonus Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Bonus Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bonus  $Bonus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            Bonus::find($id)->delete();
            return back()->with('message', 'Bonus deleted successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Bonus Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Bonus Not Found');
        }
    }


}
