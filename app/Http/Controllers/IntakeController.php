<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IntakeController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     */
    public function store(Request $request)
    {
        $currently_wearing = $request->get('currently_wearing') === null ? null : implode(',', $request->get('currently_wearing'));
        $conditions        = $request->get('conditions') === null ? null : implode(',', $request->get('conditions'));
        $history           = $request->get('history') === null ? null : implode(',', $request->get('history'));
        $change            = $request->get('last_change') === null ? null : implode(',', $request->get('last_change'));
        $consent           = $request->get('consent') === null ? null : implode(',', $request->get('consent'));

        $intake = new Intake;

        $intake->first_name = $request->get('first_name');
        $intake->last_name  = $request->get('last_name');
        $intake->email      = $request->get('email');
        $intake->phone      = $request->get('phone');
        $intake->age        = $request->get('age');
        $intake->other      = $request->get('other');

        $intake->currently_wearing = $currently_wearing;
        $intake->conditions        = $conditions;
        $intake->history           = $history;
        $intake->last_change       = $change;
        $intake->consent           = $consent;
        $intake->issues_near       = $request->get('issues_near') !== null ? 1 : 0;
        $intake->issues_far        = $request->get('issues_far') !== null ?  1 : 0;

        $intake->save();

        // Redirect
        return redirect()->route('success')->with('status', 'Thank you!');

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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        //
    }
}
