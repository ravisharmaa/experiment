<?php

namespace App\Http\Controllers\Monitor;

use App\Customer;
use App\Http\Requests\ServerCreateRequest;
use App\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class ServerController extends Controller
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
    //public function index($id, $hostname)
    public function index()
    {
        if ('admin@javra.com' === auth()->user()->email) {
            $servers = Server::select('hostname', 'ipaddress', 'id')->withLatestValue()->paginate(5);
        } else {
            $servers = Server::whereHas('customers', function ($query) {
                $query->whereHas('users', function ($query) {
                    $query->whereHas('customer', function ($query) {
                        $query->where('id', (auth()->user()->customer->id));
                    });
                });
            })->withLatestValue()->paginate(5);
        }

        return view('servers.index', compact('servers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('can-view')) {
            $customers = Customer::select('id', 'name')->get();
        } else {
            $customers = Customer::where('id', (auth()->user()->customer->id))->select('id', 'name')->get();
        }

        return $customers;
    }

    /**
     * @param ServerCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ServerCreateRequest $request)
    {
        $customer = Customer::where('id', \request('customer_id'))->first();

        $server = Server::create([
            'hostname' => \request('hostname'),
            'ipaddress' => \request('ipaddress'),
        ]);


        $server->customers()->attach($customer);


        return redirect()->route('servers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        return view('servers.edit', compact('server'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(Server $server)
    {
        \Request::validate([
            'hostname' => 'required',
            'ipaddress' => 'required',
        ]);

        $server = Server::find($server->id);
        $server->hostname = \Request::get('hostname');
        $server->ipaddress = \Request::get('ipaddress');
        $server->save();

        return redirect()->route('servers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        $server->attributes()->detach();
        $server->services()->delete();
        $server->values()->delete();
        $server->delete();

        return redirect()->route('servers.index')->with('success', 'Information has been  deleted');
    }
}
