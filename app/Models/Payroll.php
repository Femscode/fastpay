<?php

namespace App\Models;

use App\Models\Payee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payrolls';
    public function payee() {
        return $this->hasMany(Payee::class,'payroll_id','uuid');
    }
  
}
