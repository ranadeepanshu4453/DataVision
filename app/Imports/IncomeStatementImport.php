<?php
namespace App\Imports;

use App\Models\Company;
use App\Models\IncomeStatement;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Validators\ValidationException;
class IncomeStatementImport implements ToCollection
{
    /**
     * @param Collection $rows
     *
     * @return void
     */
    protected $dates = [];
    protected $boldValues = [];
    public $finalboldValues = [];
    protected $OriginalFileName;
    public $bool=false;
    public $updated_status=false;
    public $com_id;

    public function __construct($OriginalFileName){
        $this->OriginalFileName=$OriginalFileName;
    }

    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        try{
            //fetching all bold entries from file
            $this->BoldCells($rows);
            //---------------->
            
            // dd($rows[0][0].$rows[1][0]);
            // $cellValue = $rows->getActiveSheet()->getCell('A6')->getFormattedValue();
            // dd($cellValue);
            // dd($this->OriginalFileName);
            $company_name = (string) $rows[0][0].$rows[1][0];
            // $company_name ="Meta";
            // dd((string) $rows[0][0].$rows[1][0]);
            $existingCompany = Company::where('name', $company_name)->first();
    
            if ($existingCompany) {
                $this->updated_status=true;
                $this->com_id=$existingCompany->id;
                // If a company with the same name already exists, you can skip or handle it as needed.
                $company_id = $existingCompany;
            } else {
                // If no company with the same name exists, create a new one.
                $company = new Company();
                $company->name = $company_name;
                $company->save();
            
                // Retrieve the newly created company's ID
                $company_id = $company;
            }
    
            $company_name=$rows[0];
            $dates=$rows[4];
            $this->dates = $rows[4]->toArray();
            // $bold=$dates[0];
            // $isBold = $bold->getFont()->getBold();
            // dd($isBold);
            // $count=1;
            // dd($dates);
            
            foreach ($rows as $row) {
                
                $category = $row[0]; 
                
                for ($i = 1; $i < count($row); $i++) {
                    $value = $row[$i]; 
                    // $value = Calculation::getCalculatedValue($row[$i]);
    
    
    
                    if ($value !== null) {
                        if($category=='12 months ended:'){
                            continue;
                        }
                        $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->getDateByIndex($i)));
                        IncomeStatement::updateOrCreate(
                            [
                                'category' => $category,
                                'date' => $date,
                                'company_id' => $company_id->id,  // This should be in the search criteria
                            ],
                            [
                                'value' => $value,  // This is the value to update if the record is found, or insert if it's not found
                            ]
                        );
                        
                    }
                }
            }
            DB::commit();
            //  return $this->finalboldValues;
            // return view('dashboard',['data'=>$this->finalboldValues]);
            

        }catch(\Exception $e){
            DB::rollBack();
            $this->bool=true;
            return redirect()->route('dashboard')->with('error', 'An error occurred during import: Database is rolling back' . $e->getMessage());
        }

    }



    /**
     * Get the date for the corresponding index.
     *
     * @param int $index
     * @return string
     */
    private function getDateByIndex($index)
    {
        return $this->dates[$index] ?? null;
    }

    public function BoldCells(Collection $rows){
        $spreadsheet = IOFactory::load($this->OriginalFileName);
        
        foreach ($spreadsheet->getAllSheets() as $sheet) {
            // Loop through each row and column
            foreach ($sheet->getRowIterator() as $row) {
                foreach ($row->getCellIterator() as $cell) {
                    // Check if the cell is bold    
                    if (!is_string($cell->getValue())) {
                        // Skip this cell
                        continue;
                    }
                    $style = $cell->getStyle();
                    $font = $style->getFont();
                    if ($font->getBold()) {
                        // Store the bold value
                        $this->boldValues[] = $cell->getValue();
                    }
                }
            }
        }
        $this->finalboldValues= $this->getValuesAfter("12 months ended:");
        
    }

    protected function getValuesAfter($searchTerm)
    {
        // Find the index of the search term
        $index = array_search($searchTerm, $this->boldValues);

        // If the term is found, return the values after it
        if ($index !== false) {
            return array_slice($this->boldValues, $index + 1);
        }

        // Return an empty array if the term is not found
        return [];
    }
    public function getBoldData(){
        return [$this->finalboldValues,$this->bool];
    }

    public function updatedstatus(){
        return [$this->updated_status,$this->com_id];
    }
}
