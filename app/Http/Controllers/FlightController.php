<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flights;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show data
        $flights = Flights::all();
        return view('flights.index', ['flights' =>$flights]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create new data
        return view('flights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        //create new data
        $flights = new Flights;
        $flights->title = $request->title;
        $flights->description = $request->description;
        $flights->save();

        return redirect()->route('flights.index')->with('alert-success', 'Data has been stored');
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
        //

        $flights = Flights::findOrFail($id);
        //return to the edit views

        return view('flights.edit', compact('flights'));
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
        //validation
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $flights = Flights::findOrFail($id);
        $flights->title = $request->title;
        $flights->description = $request->description;
        $flights->save();

        return redirect()->route('flights.index')->with('alert-success', 'Data Has been Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete data
        $flights = Flights::findOrFail($id);
        $flights->delete();

        return redirect()->route('flights.index')->with('alert-success', 'Data Has been Deleted!');
    }
}
