<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Models\Category;

class Register extends Model
{
    use HasFactory;

    // protected $table = 'home_budgets';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

}
