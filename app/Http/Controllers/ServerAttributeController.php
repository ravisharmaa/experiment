<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeServer;
use App\Customer;
use App\Server;
use DB;
use App\User;
use Illuminate\Http\Request;

class ServerAttributeController extends Controller
{
    public function create(Server $server)
    {
        return view('server-attribute.create', compact('server'));
    }


    public function store(Request $request, Server $server)
    {
        if ($request->get('name') === "CPU") {
            $attribute = Attribute::whereName('CPU')->first();

            $server->attributes()->attach($attribute,
                ['server_id' => \request('server_id'),
                    'warning_threshold' => \request('cpu_warning_threshold'),
                    'critical_threshold' => \request('cpu_critical_threshold'),
                    'email' => \request('emails'),
                    'visibility' => \request('visibility')]);
        } elseif ($request->get('name') === "Memory") {
            $attribute = Attribute::whereName('Memory')->first();
            $server->attributes()->attach($attribute,
                ['server_id' => \request('server_id'),
                    'warning_threshold' => \request('memory_warning_threshold'),
                    'critical_threshold' => \request('memory_critical_threshold'),
                    'email' => \request('emails'),
                    'visibility' => \request('visibility')]);
        } elseif ($request->get('name') === "Disk") {
            $attribute = Attribute::whereName('Disk')->first();
            $server->attributes()->attach($attribute,
                ['server_id' => \request('server_id'),
                    'warning_threshold' => \request('disk_warning_threshold'),
                    'critical_threshold' => \request('disk_critical_threshold'),
                    'disk_name' => slugger(\request('disk_name')),
                    'disk_location' => \request('disk_name'),
                    'email' => \request('emails'),
                    'visibility' => \request('visibility')]);
        }

        return response()->json(['success' => 'Request Server Monitor Attributes successfully Added']);
    }

    public function update(Request $request)
    {
        //$request->validate([
        //    'warning_threshold' => 'required',
        //    'critical_threshold' => 'required'
        //]);

        $attributeserver = AttributeServer::findOrFail($request->get('id'));
        $attributeserver->warning_threshold = $request->get('warning_threshold');
        $attributeserver->critical_threshold = $request->get('critical_threshold');

        if (($request->get('disk_name'))) {
            $attributeserver->disk_name = slugger($request->get('disk_name'));
            $attributeserver->disk_location = $request->get('disk_name');
        }

        $attributeserver->email = $request->get('email');
        $attributeserver->save();

        return response()->json(['success' => 'Request Server Monitor Attributes successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeservers = AttributeServer::find($id);
        $attributeservers->delete();

        return response()->json(['success' => 'Information has been  deleted']);
    }
}
