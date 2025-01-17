<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    protected $table ="parties";

    public function gstBills()
    {
        return $this->hasMany(GstBill::class);
    }
}
