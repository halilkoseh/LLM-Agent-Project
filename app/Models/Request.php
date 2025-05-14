<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'language',
        'request_type',
        'content',
        'additional_notes', // Ek alanı ekle
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modelOutputs()
    {
        return $this->hasMany(ModelOutput::class);
    }
}
