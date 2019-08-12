<?php

namespace App\Http\Controllers\Monitor;

use App\Disk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiskController extends Controller
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
        $disks = Disk::all();
        return view('disks.index', compact('disks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('disks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'monitor_name' => 'required',
            'monitor_command' => 'required'
        ]);


        $service = Disk::firstOrNew($request->all());
        $service->save();
        return response()->json(['success' => 'Request Monitor successfully Added']);
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
    public function edit(Disk $disk)
    {
        //$disk= Disk::find($id);
        return view('disks.edit', compact('disk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disk $disk)
    {
        $request->validate([
            'disk_name' => 'required'
        ]);

        $disk->update($request->all());

        return redirect()->route('disks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
