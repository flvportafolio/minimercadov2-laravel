<?php

namespace App\Http\Controllers;

use App\Models\Logeo;
use Illuminate\Http\Request;

class LogeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.logeo');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logeo  $logeo
     * @return \Illuminate\Http\Response
     */
    public function show(Logeo $logeo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logeo  $logeo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logeo $logeo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logeo  $logeo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logeo $logeo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logeo  $logeo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logeo $logeo)
    {
        //
    }
}
