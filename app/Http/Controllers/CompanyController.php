<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        // echo "<pre>";
        // print_r(count($companies));
        // die;
        return view('companies.list')->with(['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'logo' => 'required|image|mimes:jpeg,png,gif|max:2048',
            // 'logo' => 'required|image|mimes:jpeg,png,gif|max:2048|dimensions:min_width=100,min_height=100',
            'website' => 'required|max:255'
        ]);

        $filename = time() . '_' . $request->file('logo')->getClientOriginalName();
        $request->file('logo')->storeAs('public/company_logos', $filename);
        $company = new Company([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'website' => $validatedData['website'],
            'logo' => $filename,
        ]);

        $company->save();
        return redirect()->route('companies.index')->with([
            'success' => 'Company added Successfully',
            'expires_at' => now()->addMinutes(5),
        ]);
    }

    public function show(string $id)
    {
        $company = Company::where('id', $id)->with('employees')->first();
        return view('companies.show-company')->with(['company' => $company]);
    }

    public function edit(string $id)
    {
        $new_id = (int) $id;
        $company = Company::findOrFail($new_id);
        return view('companies.edit')->with(['company' => $company]);
    }

    public function update(Request $request, string $id)
    {
        $new_id = (int) $id;
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'website' => 'required|max:255'
        ]);

        $company = Company::find($new_id);
        if (!$company) {
            return redirect()->back()->with('error', 'Company not found.');
        }

        $filename = '';
        if ($request->file('logo')) {
            $filename = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('public/company_logos', $filename);
            $imagePath = storage_path('public/company_logos' . $request->old_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        } else {
            $filename = $request->old_image;
        }
               
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $filename;
        $company->website = $request->website;

        $company->save();

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');

       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return redirect()->route('companies.index')->with('error', 'Company not found.');
        }
        $company->delete();
    
        return redirect()->route('companies.index')->with([
            'success' => 'Company deleted successfully',
            'expires_at' => now()->addMinutes(5),
        ]);

    }
}