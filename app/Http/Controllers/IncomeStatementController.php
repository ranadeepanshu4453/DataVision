<?php

namespace App\Http\Controllers;

use App\Imports\CompaniesImport;
use App\Imports\IncomeStatementImport;
use App\Models\BoldValue;
use App\Models\Company;
use App\Models\IncomeStatement;
use App\Models\Notification as ModelsNotification;
use App\Notifications\ImportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;

class IncomeStatementController extends Controller
{
   
    public $boldEnties= [];
    public $updatedStatus=[];
    public $fileUpdated=0;
    
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
        $this->updatedStatus=$import->updatedstatus();

        session(['boldEnties' => $this->boldEnties[0]]);
        // Import the Excel file
        // Excel::import(new IncomeStatementImport, $request->file('file'));
    //    $bolddata= Excel::import(new IncomeStatementImport($fullPath),storage_path('app/' . $path));
        // Excel::import(new CompaniesImport, $request->file('file'));


        //sending notification 
        $user=Auth::user();
        
        
        // 

        $c_id=Company::latest()->first()->id;
        if($this->updatedStatus[0]==true){
            //sending notifications
            $user->notify(new ImportNotification("File Updated :: ".basename($fullPath),""));
            $this->fileUpdated++;
            //
            return redirect()->route('update.company',$this->updatedStatus[1]);
        }
        elseif($this->boldEnties[1]==true){
            return redirect()->route('dashboard');
        }else{
            $user->notify(new ImportNotification("New File Imported :: ".basename($fullPath),""));
            return redirect()->route('chart',$c_id)->with('success', 'Data imported successfully!');
        }
            
    }

    public function erase(){
        
        IncomeStatement::truncate();
        Company::truncate();
        BoldValue::truncate();
        ModelsNotification::truncate();

        return back();
    }

    public function deleteCompany($id)
{
    $company = Company::find($id);

    if ($company) {
        IncomeStatement::where('company_id', $id)->delete();
        BoldValue::where('company_id', $id)->delete();
        $company->delete();

        return redirect()->back()->with('success', 'Company and related records deleted successfully!');
    }

    return redirect()->back()->with('error', 'Company not found.');
}


    public function showCompanies(Request $request)
    {
        $query = $request->get('search');
        
        $companies = Company::when($query, function($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', "%{$query}%");
        })->get();
        
        return view('dashboard', compact('companies'));
    }


    public function chart($id)
    {
        // Retrieve the bold entries from the session
        $this->boldEnties = session('boldEnties', []);
    
        if (!empty($this->boldEnties)) {
            // Store the bold values in the database if they exist
            BoldValue::updateOrCreate(
            ['company_id' => $id], // Conditions to find an existing record
            ['bold_values' => json_encode($this->boldEnties)] // Attributes to update or create
        );
        }
    
        // Delete the bold entries from the session after storage
        session()->forget('boldEnties');
        $this->boldEnties=[];
        $company_name=Company::find($id);
    
        // Retrieve stored bold values from the database
        $storedBoldValues = BoldValue::where('company_id', $id)->pluck('bold_values')->first();
        $categoriesToCheck = !empty($this->boldEnties) ? $this->boldEnties : json_decode($storedBoldValues, true);
    
        $groupedDataByCategory = [];
    
        // Loop through each category and group data by date
        foreach ($categoriesToCheck as $category) {
            $filteredData = IncomeStatement::where('company_id', $id)
                                            ->where('category', $category)
                                            ->orderBy('date')
                                            ->get()
                                            ->groupBy('date');
    
            // Store the grouped data in the array with the category as the key
            $groupedDataByCategory[$category] = $filteredData;
        }
    
        return view('income.chart', [
            'data' => $groupedDataByCategory,
            'company_id'=>$company_name->name,
        ]);
    }
    

    public function logout(){
        Auth::logout();
        return redirect()->route('welcome');
    }


    public function updatedCompany($id){
        $data=Company::find($id);
        return view('income.updated',[
            'updated_company'=>$data,
        ]);
    }

}
