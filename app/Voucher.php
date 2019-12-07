<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
     protected $fillable = [
        'Amount', 'AmountInWords', 'bid','iid','eid','aid','cheque_no','cheque_date','cheque_bank_name','type','payee','Description','employee_operation',
    ];
}
