<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Entity;
use App\EntityCustomer;
use App\Events\NewUserAdded;
use App\Http\Requests\UsersCreateRequest;
use App\CustomerServer;
use App\User;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('app-admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::with('customer')->get();

        return view('users.index', compact('users', 'entities'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Gate::allows('can-view')) {
            $customers = Customer::select('name', 'slug')->get();
            return $customers;
        } else {
            return 'You are not admin!!!!';
        }

    }

    /**
     * @param UsersCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsersCreateRequest $request)
    {
        $customer = Customer::whereSlug(request('username'))->first()->id;

        // model hook fired when user created
        // see boot method on User model
        $user = User::create([
            'name' => request('name'),
            'username' => ('admin' == request('role')) ? request('username') : str_slug(request('name'), '_'),
            'role' => request('role'),
            'customer_id' => $customer,
            'email' => request('email'),
            'password' => request('password'),
            'timezone' => request('timezone'),
            'additional_emails' => request('additional_emails'),
        ]);



        // fire new user added
        event(new NewUserAdded($user, $request->get('password')));

        return redirect()->route('users.index');
    }


}
