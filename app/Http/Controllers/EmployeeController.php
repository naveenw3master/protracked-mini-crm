<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with(['company'])->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('id', 'name')->orderBy('name', 'asc')->pluck('name', 'id');

        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:App\Models\Company,id',
            'first_name' => 'required|max:64',
            'last_name' => 'required|max:64',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|digits:10',
        ]);

        $employee = new Employee($request->all());
        $employee->save();
        
        return redirect()->route('employees.index')->with('success', __('Employee Created Successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_id' => 'required|exists:App\Models\Company,id',
            'first_name' => 'required|max:64',
            'last_name' => 'required|max:64',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|digits:10',
        ]);

        $employee = Employee::find($id);

        $employee->fill($request->only(['company_id', 'first_name', 'last_name', 'email', 'phone']));
        $employee->update();

        return redirect()->route('employees.index')->with('success', __('Employee Updated Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', __('Employee Deleted Successfully!'));
    }
}
