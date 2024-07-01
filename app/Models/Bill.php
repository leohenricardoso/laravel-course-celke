<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    // Reference table name
    protected $table = 'bills';

    /*
        Indicate which column can be registered on database
        Create at and updated at is fillable automatically by laravel framework
    */
    protected $fillable = ['name', 'bill_value', 'due_date'];

}
