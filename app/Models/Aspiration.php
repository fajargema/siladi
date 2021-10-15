<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aspiration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'location', 'categories_id', 'users_id', 'attachment', 'slug'
    ];
}
