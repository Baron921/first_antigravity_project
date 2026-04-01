<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'salary',
        'is_active',
    ];

    public function company()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
