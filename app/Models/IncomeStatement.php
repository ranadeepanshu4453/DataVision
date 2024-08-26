<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeStatement extends Model
{
    use HasFactory;
    protected $fillable=['company_id','date','category','value'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
