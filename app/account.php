<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account extends Model
{
     protected $fillable = [
        'AccountNo','holder_name','bank_name','branch','balance'
    ];
}
