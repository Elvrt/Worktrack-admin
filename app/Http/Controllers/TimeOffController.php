<?php

namespace App\Http\Controllers;

use App\Models\TimeOffModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;

class TimeOffController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Time Off List',
            'list' => ['Home', 'Time Off', 'List']
        ];

        $activeMenu = 'time-off';

        $timeOffs = TimeOffModel::whereIn('status', ['approved', 'rejected'])->get();

        return view('time-off.index', compact('breadcrumb', 'timeOffs', 'activeMenu'));
    }

    public function show($id)
    {
        $timeOff = TimeOffModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Time Off Detail',
            'list' => ['Home', 'Time Off', 'Detail']
        ];

        $activeMenu = 'time-off';

        $employees = EmployeeModel::all();

        return view('time-off.show', compact('breadcrumb', 'timeOff', 'employees','activeMenu'));
    }

    public function destroy($id)
    {
        $check = TimeOffModel::find($id);
        if (!$check) {
            return redirect('time-off')->with('error', 'Time Off data not found');
        }

        try {
            if ($check->letter) {
                CloudinaryController::delete($check->letter, 'worktrack/letter');
            }

            TimeOffModel::destroy($id);

            return redirect('time-off')->with('success', 'Time Off data successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('time-off')->with('error', 'Time Off data failed to be deleted because there are still other tables associated with this data');
        }
    }
}
