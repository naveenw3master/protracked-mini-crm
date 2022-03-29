<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'name' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|max:5120|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url|max:255',
        ]);

        $fileName = null;
        if ($request->hasFile('logo')) {
            $fileName = uniqid('company_logo_', true).'.'.$request->logo->extension();
            $request->logo->move(public_path('storage/company-logos'), $fileName);
        }

        $company = new Company($request->all());
        if($fileName) $company->logo = $fileName;
        $company->save();
        
        return redirect()->route('companies.index')->with('success', __('Company Created Successfully!'));
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
        $company = Company::find($id);

        return view('companies.edit', compact('company'));
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
            'name' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|max:5120|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|url|max:255',
        ]);

        $company = Company::find($id);

        $fileName = null;
        if ($request->hasFile('logo')) {
            $fileName = uniqid('company_logo_', true).'.'.$request->logo->extension();
            $request->logo->move(public_path('storage/company-logos'), $fileName);
        }

        $company->fill($request->only(['name', 'email', 'website']));
        if($fileName) $company->logo = $fileName;
        $company->update();

        return redirect()->route('companies.index')->with('success', __('Company Updated Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();

        return redirect()->route('companies.index')->with('success', __('Company Deleted Successfully!'));
    }
}
