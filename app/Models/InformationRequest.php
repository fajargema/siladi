<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InformationRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'location', 'categories_id', 'users_id', 'attachment', 'slug'
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'categories_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
