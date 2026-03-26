<?php

namespace App\Http\Controllers;

use App\Models\Memberrequest;
use Illuminate\Http\Request;

class MemberrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Memberrequest $memberrequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Memberrequest $memberrequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $member = Memberrequest::findOrFail($request->id);
        $member->status = 'pending';
        $member->save();
        return redirect()->back()->with('success','You have successfully requested for member!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Memberrequest $memberrequest)
    {
        //
    }
}
