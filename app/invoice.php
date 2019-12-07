<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    

             public $fillable = [
        'b_quantity','total_cost','c_name','sales_tax','salex_tax_value','cost_inc_tax','payment_received',
    ];
}
