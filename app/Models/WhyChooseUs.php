<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    use HasFactory;
    protected $fillable =[
        'image',
        'description',
        'title1',
        'description1',
        'title2',
        'description2',
        'title3',
        'description3',
        'title4',
        'description4',
        'title5',
        'description5'

    ];
}
