<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DtrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtr = auth()->user()->dtrs()->get();
        return view('dtr.index', compact('dtr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dtr.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $days = implode('-', $request->days);
        $time_in = implode('-', $request->time_in);
        $time_out = implode('-', $request->time_out);
        $ot = implode('-', $request->ot);
        $dtr = auth()->user()->dtrs()->create([
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'days'=>$days,
            'time_in'=>$time_in,
            'time_out'=>$time_out,
            'ot'=>$ot
        ]);
        return redirect(route('dtr.show', $dtr))->withSuccess('Done!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
    
        return view('dtr.show', ['dtr'=>auth()->user()->dtrs()->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dtr.edit', ['dtr'=>auth()->user()->dtrs()->findOrFail($id)]);
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
        // dd($request->all());
        $days = implode('-', $request->days);
        $time_in = implode('-', $request->time_in);
        $time_out = implode('-', $request->time_out);
        $ot = implode('-', $request->ot);
        $dtr = auth()->user()->dtrs()->findOrFail($id)->update([
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'days'=>$days,
            'time_in'=>$time_in,
            'time_out'=>$time_out,
            'ot'=>$ot
        ]);
        return redirect(route('dtr.show', auth()->user()->dtrs()->findOrFail($id)))->withSuccess('Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user()->dtrs()->findOrFail($id)->delete();
        return back()->withSuccess('Done!');
    }
}
