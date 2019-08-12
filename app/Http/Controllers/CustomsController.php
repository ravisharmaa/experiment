<?php

namespace App\Http\Controllers;

use App\Custom;
use App\Customer;
use App\Http\Requests\CustomRequest;
use App\Server;
use App\Value;
use Illuminate\Http\Request;

class CustomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Server $server)
    {
        return view('customs.create', compact('server'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomRequest $customRequest)
    {
        $customs = Custom::create([
            'path' => \request('path'),
            'result' => rtrim(\request('result')),
            'server_id' => rtrim(\request('server_id')),
        ]);

        $server = Server::find($customs->server_id);

        return redirect()->route('customs.create', compact('server'))->with('flash', 'Custom Scripts Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        //dd($server);
        $customs = Value::where('server_id', $server->id)->get();
        //dd($customs[0]);
        return view('customs.show',compact('server', 'customs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customs = Custom::find($id);
        $server = Server::find($customs->server_id);

        return view('customs.edit', compact('customs', 'server'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomRequest $customRequest, $id)
    {
        $customs = Custom::find($id);
        $customs->path = \Request::get('path');
        $customs->result = \Request::get('result');
        $customs->save();

        $server = Server::find($customs->server_id);
        return redirect()->route('customs.create', compact('server'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customs = Custom::find($id);
        $server_id = $customs->server_id;

        $customs->delete();
        $server = Server::find($server_id);

        return redirect()->route('customs.create', compact('server'));
    }
}
