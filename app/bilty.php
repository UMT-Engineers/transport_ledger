<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bilty extends Model
{
    
       protected $fillable = [
        'bid','cid','receiving_company','weight','c_rate','departure','destination','builty_no','car_no','driver_name','cnic','total_cost','b_rate','invoiced','pay_to_broker','debit_cost','date','month',

    ];
}
