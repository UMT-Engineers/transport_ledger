<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact_us extends Model
{
    protected $fillabale =[
     'first_name','last_name','phone','subject','messege'
    ];
}
