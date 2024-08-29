<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(){
        $companies=Company::all();
        return view('income.compare',[
            'companies'=>$companies,
        ]);
    }
   
public function compare(Request $request)
{
    $companyIds = $request->input('company_ids');

    // Check if exactly two companies are selected
    if (count($companyIds) !== 2) {
        return redirect()->back()->withErrors(['msg' => 'Please select exactly two companies for comparison.']);
    }

    // Fetch the companies from the database
    $companies = Company::whereIn('id', $companyIds)->get();

    // Pass the companies to the comparison view
    return view('income.compared_chart', compact('companies'));
}

    }

