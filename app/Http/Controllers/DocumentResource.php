<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Helpers\Helper;

class DocumentResource extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::orderBy('created_at' , 'desc')->get();
        return view('coinadmin.document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coinadmin.document.create');
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
            'name' => 'required|max:255',
            'order' => 'required',
            // 'image' => 'required',
            // 'doc' => 'required',
            'usa_accredited' => 'required',
            'download' => 'required',
        ]);

        try{

            $document = $request->all();

            if($request->hasFile('image')) {
                $document['image'] = $request->image->store('documents');

            }

            if($request->hasFile('doc')) {
                $document['doc'] = $request->doc->store('documents');

            }

            Document::create($document);
            return redirect()->route('coinadmin.document.index')->with('flash_success','Document Saved Successfully');

        }

        catch (Exception $e) {
            return back()->with('flash_error', 'Document Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $providerDocument
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Document::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $providerDocument
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $document = Document::findOrFail($id);
            return view('coinadmin.document.edit',compact('document'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $providerDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|max:255',
            'order' => 'required',
            // 'image' => 'required',
            // 'doc' => 'required',
            'usa_accredited' => 'required',
            'download' => 'required',
        ]);

        try {
            $Doc= Document::where('id',$id)->first();

            $Doc->name = $request->name;

            if($request->hasFile('image')) {
                //$Doc->image = Helper::upload_picture($request->image);//$request->image->store('documents');
                $Doc->image = $request->image->store('documents');
            }

            if($request->hasFile('doc')) {
                $Doc->doc = $request->doc->store('documents');
                //$Doc->doc = Helper::upload_picture($request->doc);//$request->doc->store('documents');
            }

            $Doc->order = $request->order;
            $Doc->usa_accredited = $request->usa_accredited;
            $Doc->download = $request->download;
            $Doc->save();
            return redirect()->route('coinadmin.document.index')->with('flash_success', 'Document Updated Successfully');
        }

        catch (Exception $e) {
            return back()->with('flash_error', 'Document Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $providerDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Document::find($id)->delete();
            return back()->with('message', 'Document deleted successfully');
        }
        catch (Exception $e) {
            return back()->with('flash_error', 'Document Not Found');
        }
    }
}
