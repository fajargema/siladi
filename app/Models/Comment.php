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

    public function aspiration()
    {
        return $this->hasOne(Aspiration::class, 'id', 'reports_id');
    }

    public function complaint()
    {
        return $this->hasOne(Aspiration::class, 'id', 'reports_id');
    }

    public function informationrequest()
    {
        return $this->hasOne(Aspiration::class, 'id', 'reports_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
