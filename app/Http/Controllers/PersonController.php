<?php

namespace App\Http\Controllers;

use App\AnonymousIdNumber;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
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

        return view('register-person');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Can only create Person account if authenticated
        if(Auth::check()) {

            $person = new Person();
            $person->first_name = $request->first_name;
            $person->preferred_first_name = $request->preferred_first_name;
            $person->last_name = $request->last_name;
            $person->user_type = $request->user_type;
            $person->user_id = Auth::user()->id;
            $person->save();

            $anonymousFinalExamId = new AnonymousIdNumber();
            $anonymousFinalExamId->uin = $person->id;
            $anonymousFinalExamId->exam_type = 'final';
            $anonymousFinalExamId->save();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        if(Auth::check() AND empty(Auth::user()->universityPerson)) {

            return redirect()->route('create-person-form');

        }

        return view('person');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
