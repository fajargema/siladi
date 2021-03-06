<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reports_id', 'users_id', 'body'
    ];

    public function complaint()
    {
        return $this->hasOne(Complaint::class, 'id', 'reports_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
