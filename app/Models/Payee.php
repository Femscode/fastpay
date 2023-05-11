<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payee extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'payees';
    public function payroll() {
        return $this->belongsTo(Payroll::class,'payroll_id','uuid');
    }
}
