<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateHire extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'image',
        'description1',
        'description2',
        'description3'

    ];
}
