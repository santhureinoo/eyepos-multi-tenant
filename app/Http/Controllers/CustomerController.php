<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('customers.index', ['customers' => Customers::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $customer = new Customers;
        $customer->fill($request->except(['_token', '_method']));
        $customer->save();

        // Redirect
        return redirect()->route('customers.show', $customer->id)->with('status', 'Customer Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return
     */
    public function show($id)
    {
        return view('customers.show', ['customer' => Customers::where('id', $id)->with('orders')->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->view('customers.edit', ['customer' => Customers::where('id', $id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $customer = Customers::find($id);
        $customer->fill($request->except(['_token', '_method']));
        $customer->save();

        // Redirect
        return redirect()->route('customers.show', $customer->id)->with('status', 'Customer Successfully Edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customers::destroy($id);

        // Redirect
        return redirect()->route('customers')->with('status', 'Customer Successfully Deleted.');
    }
}
