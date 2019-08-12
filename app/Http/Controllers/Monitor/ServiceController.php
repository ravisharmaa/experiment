<?php

namespace App\Http\Controllers\Monitor;

use App\Disk;
use App\Service;
use App\Server;
use App\ServiceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
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
    public function index($id, $hostname)
    {
        $service = new Service();
        $services = $service->getService($id);
        $servers = Server::findOrFail($id);
        $servicetype = ServiceType::all();

        return view('services.create')
            ->with('id', $id)
            ->with('hostname', $hostname)
            ->with('servicetype', $servicetype)
            ->with('servers', $servers)
            ->with('services', $services);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, Service $service)
    {
        $request->validate([
            'server_id' => 'required',
            'service_type' => 'required',
            'service_name' => 'required'
        ]);

        $service = Service::firstOrNew($request->all());
        $service->save();
        return response()->json(['success' => 'Request Port and and command successfully Added']);

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
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'service_type' => 'required',
            'service_name' => 'required'
        ]);

        $service = Service::findOrFail($request->get('id'));

        $service->service_type = $request->get('service_type');

        $service->service_name = $request->get('service_name');
        //
        $service->service_port = $request->get('service_port');
        //
        $service->service_command = $request->get('service_command');
        //
        $service->save();


        return response()->json(['success' => 'Request Port and and command successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $services = Service::find($id);
        $services->delete();

        return response()->json(['success' => 'Information has been  deleted']);
    }
}
