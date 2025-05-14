<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use App\Models\ModelOutput;


class AppModel extends EloquentModel
{
    use HasFactory;

    protected $table = 'models'; // Bu önemli, tablo adımız hâlâ "models"

    protected $fillable = [
        'model_name',
        'provider',
        'version',
        'capabilities',
    ];

    protected $casts = [
        'capabilities' => 'array',
    ];

    public function modelOutputs()
    {
        return $this->hasMany(ModelOutput::class);
    }
}
