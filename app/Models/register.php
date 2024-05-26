<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Register;

class Register extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'password'
    ];

}
