<?php

namespace App\Http\Controllers;

use App\Models\Customer\Visit;
use App\Models\Satisfaction;
use Illuminate\Http\Request;

class SatisfactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('questionnaire.satisfaction.index');
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
        $satisfaction = new Satisfaction;

        $satisfaction->procedure    = $request->get('procedure') === null ? null : implode(',', $request->get('procedure'));
        $satisfaction->satisfaction = $request->get('satisfaction') === null ? null : implode(',', $request->get('satisfaction'));
        $satisfaction->recommend    = $request->get('recommend') === null ? null : implode(',', $request->get('recommend'));
        $satisfaction->improvement  = $request->get('improvement');
        $satisfaction->visit        = $request->get('visit');
        $satisfaction->purpose      = $request->get('purpose');

        $satisfaction->save();

        // Redirect
        return redirect()->route('success')->with('status', 'Thank you!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $visit
     *
     * @return \Illuminate\Http\Response
     */
    public function show($visit)
    {
        return response()->view('questionnaire.satisfaction.show', ['visit' => Visit::find($visit)]);
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
