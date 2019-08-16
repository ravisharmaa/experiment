<?php

namespace App\Http\Controllers;

use App\Entity;
use App\EntityCustomer;
use App\Server;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $servers = Server::select('hostname', 'ipaddress', 'id', 'customer_id')->withLatestValue()->paginate(10);
        } else {
            if (auth()->user()->customer) {
                $servers = auth()->user()->customer->servers()->withLatestValue()->get();
            } else {
                abort(404);
            }
        }

        return view('dashboard.index', compact('servers'));
    }

    public function create()
    {
        return view('entities.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        request()->validate([
            'name' => 'required|alpha_dash',
            'url' => 'required',
        ]);

        Entity::create(request()->all());

        return redirect()->route('dashboard');
    }

    /**
     * @param Entity $entity
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Entity $entity)
    {
        $entityUser = array_flatten(EntityCustomer::where('user_id', '=', auth()->id())->pluck('entity_id'));
        if (!in_array($entity->id, $entityUser)) {
            abort(403);
        }

        return view('entities.edit', compact('entity'));
    }

    /**
     * @param Entity $entity
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Entity $entity)
    {
        request()->validate([
            'name' => 'required',
            'url' => 'required',
        ]);

        $entity->update(request()->all());

        return redirect()->route('dashboard');
    }
}
