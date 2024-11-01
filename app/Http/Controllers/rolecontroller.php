<?php

namespace App\Http\Controllers;

use App\Models\rolemodel;
use Illuminate\Http\Request;

class rolecontroller extends Controller
{
    public function index()
    {
        $role = rolemodel::all();
        return view('role.index', compact('role'));
    }

    // Show the form for creating a new role
    public function create()
    {
        return view('role.create');
    }

    // Store a newly created role in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'position' => 'required|String',
        ]);

        rolemodel::create($validated);

        return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    // Display the specified role
    public function show(rolemodel $role)
    {
        return view('role.show', compact('role'));
    }

    // Show the form for editing the specified role
    public function edit(rolemodel $role)
    {
        return view('role.edit', compact('role'));
    }

    // Update the specified role in storage
    public function update(Request $request, rolemodel $role)
    {
        $validated = $request->validate([
            'position' => 'required|String',
        ]);

        $role->update($validated);

        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }

    // Remove the specified role from storage
    public function destroy(rolemodel $role)
    {
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
    }
}
