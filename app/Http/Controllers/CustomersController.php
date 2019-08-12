<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerRequest;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('app-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * @param CustomerRequest $customerRequest
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerRequest $customerRequest)
    {
        Customer::create([
            'name' => \request('name'),
            'email' => \request('email'),
            'address' => \request('address'),
            'phone' => \request('phone'),
            'slug' => str_slug(\request('name'), ''),
            'remarks' => \request('remarks'),
            'contact_person' => \request('contact_person'),
        ]);

        return redirect()->route('customers.index')->with('flash', 'New Customer Added');
    }

    /**
     * @param Customer $customer
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * @param CustomerRequest $customerRequest
     * @param Customer        $customer
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerRequest $customerRequest, Customer $customer)
    {
        $customer->update([
            'name' => \request('name'),
            'email' => \request('email'),
            'address' => \request('address'),
            'remarks' => \request('remarks'),
            'phone' => \request('phone'),
            'contact_person' => \request('contact_person'),
        ]);

        return redirect()->route('customers.index')->with('flash', 'Customer Updated Successfully');
    }

    /**
     * @param Customer $customer
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('flash', 'Customer Deleted Successfully');
    }
}
