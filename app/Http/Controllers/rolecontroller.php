<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Role List',
            'list' => ['Home', 'Role', 'List']
        ];

        $activeMenu = 'role';

        $roles = RoleModel::all();

        return view('role.index', compact('breadcrumb', 'roles', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Role Create',
            'list' => ['Home', 'Role', 'Create']
        ];

        $activeMenu = 'role';

        return view('role.create', compact('breadcrumb', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'position' => 'required|string|unique:role,position|max:30',
            ],
            [
                'position.required' => 'The position field is required.',
                'position.string' => 'The position must be a valid string.',
                'position.unique' => 'This position already exists. Please choose a different one.',
                'position.max' => 'The position must not exceed 30 characters.',
            ]
        );

        RoleModel::create([
            'position' => $request->position,
        ]);

        return redirect('role')->with('success', 'Role data successfully saved');
    }

    public function show(string $id)
    {
        $role = RoleModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Role Detail',
            'list' => ['Home', 'Role', 'Detail']
        ];

        $activeMenu = 'role';

        return view('role.show', compact('breadcrumb', 'role', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $role = RoleModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Role Edit',
            'list' => ['Home', 'Role', 'Edit']
        ];

        $activeMenu = 'role';

        return view('role.edit', compact('breadcrumb', 'role', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'position' => 'required|string|unique:role,position,'.$id.',role_id|max:30',
            ],
            [
                'position.required' => 'The position field is required.',
                'position.string' => 'The position must be a valid string.',
                'position.unique' => 'This position already exists. Please choose a different one.',
                'position.max' => 'The position must not exceed 30 characters.',
            ]
        );

        RoleModel::find($id)->update([
            'position' => $request->position,
        ]);

        return redirect('role')->with('success', 'Role data successfully changed');
    }

    public function destroy(string $id)
    {
        $check = RoleModel::find($id);
        if (!$check) {
            return redirect('role')->with('error', 'Role data not found');
        }

        try {
            RoleModel::destroy($id);

            return redirect('role')->with('success', 'Role data successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('role')->with('error', 'Role data failed to be deleted because there are still other tables associated with this data');
        }
    }
}
