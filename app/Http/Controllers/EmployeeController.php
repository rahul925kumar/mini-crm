<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);
        return view('employees.list')->with(['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::get();
        return view('employees.create')->with(['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_id' => 'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric|regex:/^[0-9]{10}$/'
        ]);

        $employee = new Employee([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'phone' => $request->phone,
        ]);

        $employee->save();

        return redirect()->route('employee.index')->with([
            'success' => 'Employee added Successfully',
            'expires_at' => now()->addMinutes(5),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::where('id', $id)->with('company')->first();
        return view('employees.show')->with(['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $new_id = (int) $id;
        $employee = Employee::findOrFail($new_id);
        $companies = Company::get();
        return view('employees.edit')->with(['employee' => $employee, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'company_id' => 'required|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric|regex:/^[0-9]{10}$/'
        ]);

        $new_id = (int) $id;
        $employee = Employee::find($new_id);
        if (!$employee) {
            return redirect()->back()->with(['error' => 'employee not found.', 'expires_at' => now()->addMinutes(5),]);
        }


        $employee->company_id = $request->company_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;

        $employee->save();

        return redirect()->route('employee.index')->with(['success' => 'Employee updated successfully', 'expires_at' => now()->addMinutes(5),]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->route('employee.index')->with('error', 'employee not found.');
        }
        $employee->delete();

        return redirect()->route('employee.index')->with([
            'success' => 'employee deleted successfully',
            'expires_at' => now()->addMinutes(5),
        ]);
    }
}