<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ledger extends Model
{
        public $fillable = [
        'description','iid','debit','credit'
    ];
}
