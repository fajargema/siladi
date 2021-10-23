<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode', 'title', 'description', 'date', 'location', 'types_id', 'categories_id', 'users_id', 'attachment', 'slug', 'privacy'
    ];

    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'types_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'categories_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
