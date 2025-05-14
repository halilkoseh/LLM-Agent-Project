<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request;
use App\Models\AppModel;
use App\Models\UserFeedback;

class ModelOutput extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'model_id',
        'output_content',
        'processing_time',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function model()
    {
        return $this->belongsTo(AppModel::class);
    }


    public function feedbacks()
    {
        return $this->hasMany(UserFeedback::class);
    }
}
