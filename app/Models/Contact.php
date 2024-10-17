<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable =[
      
        'image',
        'address',
        'mobile_1',
        'mobile_2',
        'mobile_3',
        'office_no',
        'email',
        'facebook',
        'instagram',
        'youtube',
        'linkdin'
    ];
}
