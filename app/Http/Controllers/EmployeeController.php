<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = employee::all();

        return View::make('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee' => 'required',
            'name' => 'required',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required',
            'address' => 'required',
            'profil' => 'required|image|mimes:jpg,png,jpeg',
        ]);
        $rules = array(
           
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('sharks/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $shark = new shark;
            $shark->name       = Input::get('name');
            $shark->email      = Input::get('email');
            $shark->shark_level = Input::get('shark_level');
            $shark->save();

            // redirect
            Session::flash('message', 'Successfully created shark!');
            return Redirect::to('sharks');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
