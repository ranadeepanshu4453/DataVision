<?php

namespace App\Http\Controllers;

use App\Imports\CompaniesImport;
use App\Imports\IncomeStatementImport;
use App\Models\Company;
use App\Models\IncomeStatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class IncomeStatementController extends Controller
{
   
    public $boldEnties= [];
    
    //
    public function import(Request $request)
    {
        
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048', // Limit file size to 2MB
        ]);
        $originalName = $request->file('file')->getClientOriginalName();
        // $path = $request->file('file')->store('uploads/excel');
        $path = $request->file('file')->storeAs('uploads/excel', $originalName);
        $fullPath = storage_path('app/' . $path);
        $import = new IncomeStatementImport($fullPath);
        Excel::import($import, $fullPath);
        $this->boldEnties= $import->getBoldData();
        // Import the Excel file
        // Excel::import(new IncomeStatementImport, $request->file('file'));
    //    $bolddata= Excel::import(new IncomeStatementImport($fullPath),storage_path('app/' . $path));
        // Excel::import(new CompaniesImport, $request->file('file'));
        
        
        
        
        return redirect()->route('dashboard')->with('success', 'Data imported successfully!');
    }

    public function erase(){
        IncomeStatement::truncate();
        Company::truncate();
        return back();
    }
    public function showCompanies(Request $request)
    {
        $query = $request->get('search');
        
        $companies = Company::when($query, function($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%{$query}%");
        })->get();

        return view('dashboard', compact('companies'));
    }

    public function chart($id){
            
        $categoriesToCheck = [
            'Net sales',
            'Cost of sales',
            'Gross margin',
            'Operating expenses',
            'Operating income',
            'Other income (expense), net',
            'Income before provision for income taxes',
            'Net income',
        ];

        $groupedDataByCategory = [];

    // Loop through each category and group data by date
    foreach ($categoriesToCheck as $category) {

        $filteredData = IncomeStatement::where('company_id', $id)->where('category', $category)
                                       ->orderBy('date')
                                       ->get()
                                       ->groupBy('date');

        // Store the grouped data in the array with the category as the key
        $groupedDataByCategory[$category] = $filteredData;
    }
                    
        return view('income.chart', [
            'data' => $groupedDataByCategory,
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('welcome');
    }
}
