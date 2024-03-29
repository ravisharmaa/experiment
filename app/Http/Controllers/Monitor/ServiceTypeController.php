<?php

namespace App\Http\Controllers\Monitor;

use App\AttributeServer;
use App\ServiceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceTypes = ServiceType::all();

        return view('servicetypes.index', compact('serviceTypes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servicetypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'server_name' => 'required'
        ]);

        ServiceType::create($request->all());

        return redirect()->route('servicetypes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceType $servicetype)
    {
        return view('servicetypes.edit', compact('servicetype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceType $servicetype)
    {
        $request->validate([
            'server_name' => 'required'
        ]);

        $servicetype->update($request->all());

        return redirect()->route('servicetypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceType = ServiceType::findOrFail($id);
        $serviceType->delete();

        return redirect()->route('servicetypes.index')->with('success', 'Information has been  deleted');
    }
}
