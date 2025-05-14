<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    use HasFactory;

    protected $table = 'user_feedbacks';

    protected $fillable = [
        'user_id',
        'model_output_id',
        'rating',
        'feedback_text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modelOutput()
    {
        return $this->belongsTo(ModelOutput::class);
    }
}
