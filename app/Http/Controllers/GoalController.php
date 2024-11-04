<?php

namespace App\Http\Controllers;

use App\Models\GoalModel;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Goal List',
            'list' => ['Home', 'Goal', 'List']
        ];

        $activeMenu = 'goal';

        $goals = GoalModel::all();

        return view('goal.index', compact('breadcrumb', 'goals', 'activeMenu'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
