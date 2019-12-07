<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class broker extends Model
{
      protected $fillable = [
        'name','phone','address','NTN','PTN','total_cost','received_cost'
    ];
}
