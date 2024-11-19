<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\EmployeeModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Employee List',
            'list' => ['Home', 'Employee', 'List']
        ];

        $activeMenu = 'employee';

        $employees = EmployeeModel::all();

        return view('employee.index', compact('breadcrumb', 'employees', 'activeMenu'));
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Employee Create',
            'list' => ['Home', 'Employee', 'Create']
        ];

        $activeMenu = 'employee';

        $roles = RoleModel::all();

        return view('employee.create', compact('breadcrumb', 'roles', 'activeMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'employee_number' => 'required|string|max:20|unique:employee,employee_number',
                'name' => 'required|string|max:100',
                'date_of_birth' => 'required|date',
                'phone_number' => 'required|string|max:15|unique:employee,phone_number',
                'address' => 'required|string|max:100',
                'profile' => 'required|image|mimes:jpg,png,jpeg|max:2048',
                'username' => 'required|string|max:50|unique:user,username',
                'password' => 'required|string|min:8',
                'password_confirm' => 'required|string|min:8|same:password',
                'role_id' => 'required',
            ],
            [
                'employee_number.required' => 'The employee number field is required.',
                'employee_number.string' => 'The employee number must be a string.',
                'employee_number.max' => 'The employee number may not be greater than 20 characters.',
                'employee_number.unique' => 'The employee number has already been taken.',

                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name may not be greater than 100 characters.',

                'date_of_birth.required' => 'The date of birth field is required.',
                'date_of_birth.date' => 'The date of birth must be a valid date.',

                'phone_number.required' => 'The phone number field is required.',
                'phone_number.string' => 'The phone number must be a string.',
                'phone_number.max' => 'The phone number may not be greater than 15 characters.',
                'phone_number.unique' => 'The phone number has already been taken.',

                'address.required' => 'The address field is required.',
                'address.string' => 'The address must be a string.',
                'address.max' => 'The address may not be greater than 100 characters.',

                'profile.required' => 'The profile image field is required.',
                'profile.image' => 'The profile must be an image.',
                'profile.mimes' => 'The profile must be a file of type: jpg, png, jpeg.',
                'profile.max' => 'The profile may not be greater than 2MB.',

                'username.required' => 'The username field is required.',
                'username.string' => 'The username must be a string.',
                'username.max' => 'The username may not be greater than 50 characters.',
                'username.unique' => 'The username has already been taken.',

                'password.required' => 'The password field is required.',
                'password.string' => 'The password must be a string.',
                'password.min' => 'The password must be at least 8 characters long.',

                'password_confirm.required' => 'The password confirmation field is required.',
                'password_confirm.string' => 'The password confirmation must be a string.',
                'password_confirm.min' => 'The password confirmation must be at least 8 characters long.',
                'password_confirm.same' => 'The password confirmation does not match.',

                'role_id.required' => 'The position field is required.',
            ]
        );

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $result = CloudinaryController::upload($image->getRealPath(), 'worktrack/profile', 300, 300);
        } else {
            return back()->withErrors(['profile' => 'Failed to upload image.']);
        }

        $employee = EmployeeModel::create([
            'employee_number' => $request->employee_number,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'profile' => $result,
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'employee_id' => $employee->employee_id,
        ]);

        return redirect('employee')->with('success', 'Employee data successfully saved');
    }

    public function show(string $id)
    {
        $employee = EmployeeModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Employee Detail',
            'list' => ['Home', 'Employee', 'Detail']
        ];

        $activeMenu = 'employee';

        $roles = RoleModel::all();

        return view('employee.show', compact('breadcrumb', 'employee', 'roles', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $employee = EmployeeModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Employee Edit',
            'list' => ['Home', 'Employee', 'Edit']
        ];

        $activeMenu = 'employee';

        $roles = RoleModel::all();

        return view('employee.edit', compact('breadcrumb', 'employee', 'roles', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'employee_number' => 'required|string|max:20|unique:employee,employee_number,' . $id . ',employee_id',
                'name' => 'required|string|max:100',
                'date_of_birth' => 'required|date',
                'phone_number' => 'required|string|max:15|unique:employee,phone_number,' . $id . ',employee_id',
                'address' => 'required|string|max:100',
                'profile' => 'sometimes|image|mimes:jpg,png,jpeg|max:2048',
                'username' => 'required|string|max:50|unique:user,username,' . $id . ',user_id',
                'password' => 'nullable|string|min:8',
                'password_confirm' => 'nullable|string|min:8|same:password',
                'role_id' => 'required',
            ],
            [
                'employee_number.required' => 'The employee number field is required.',
                'employee_number.string' => 'The employee number must be a string.',
                'employee_number.max' => 'The employee number may not be greater than 20 characters.',
                'employee_number.unique' => 'The employee number has already been taken.',

                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be a string.',
                'name.max' => 'The name may not be greater than 100 characters.',

                'date_of_birth.required' => 'The date of birth field is required.',
                'date_of_birth.date' => 'The date of birth must be a valid date.',

                'phone_number.required' => 'The phone number field is required.',
                'phone_number.string' => 'The phone number must be a string.',
                'phone_number.max' => 'The phone number may not be greater than 15 characters.',
                'phone_number.unique' => 'The phone number has already been taken.',

                'address.required' => 'The address field is required.',
                'address.string' => 'The address must be a string.',
                'address.max' => 'The address may not be greater than 100 characters.',

                'profile.image' => 'The profile must be an image.',
                'profile.mimes' => 'The profile must be a file of type: jpg, png, jpeg.',
                'profile.max' => 'The profile may not be greater than 2MB.',

                'username.required' => 'The username field is required.',
                'username.string' => 'The username must be a string.',
                'username.max' => 'The username may not be greater than 50 characters.',
                'username.unique' => 'The username has already been taken.',

                'password.string' => 'The password must be a string.',
                'password.min' => 'The password must be at least 8 characters long.',

                'password_confirm.string' => 'The password confirmation must be a string.',
                'password_confirm.min' => 'The password confirmation must be at least 8 characters long.',
                'password_confirm.same' => 'The password confirmation does not match.',

                'role_id.required' => 'The position field is required.',
            ]
        );

        $employee = EmployeeModel::find($id);

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $result = CloudinaryController::replace($employee->profile, $image->getRealPath(), 'worktrack/profile', 300, 300);
        } else {
            $result = $employee->profile;
        }

        $employee->update([
            'employee_number' => $request->employee_number,
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'profile' => $result,
        ]);

        User::where('employee_id', $id)->update([
            'username' => $request->username,
            'role_id' => $request->role_id,
            'password' => $request->password ? bcrypt($request->password) : User::find($id)->password,
        ]);
        
        return redirect('employee')->with('success', 'Employee data successfully changed');
    }

    public function destroy(string $id)
    {
        $employee = EmployeeModel::find($id);

        if (!$employee) {
            return redirect('employee')->with('error', 'Employee data not found');
        }

        try {
            $user = User::where('employee_id', $id)->first();

            if ($user) {
                $user->delete();
            }

            if ($employee->profile) {
                CloudinaryController::delete($employee->profile, 'worktrack/profile');
            }
            $employee->delete();

            return redirect('employee')->with('success', 'Employee data successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('employee')->with('error', 'Employee data failed to be deleted due to existing associations with other tables');
        }
    }
}
