<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppModel;

class ModelSeeder extends Seeder
{
    public function run(): void
    {
        $models = [
            [
                'model_name' => 'GPT-4',
                'provider' => 'OpenAI',
                'version' => '4.0',
                'capabilities' => json_encode(['code', 'text', 'analysis'])
            ],
            [
                'model_name' => 'Gemini Pro',
                'provider' => 'Google',
                'version' => '1.0',
                'capabilities' => json_encode(['code', 'text', 'analysis'])
            ],
            [
                'model_name' => 'LLaMA',
                'provider' => 'Meta',
                'version' => '2.0',
                'capabilities' => json_encode(['code', 'text'])
            ],
        ];

        foreach ($models as $model) {
            // Eğer aynı isim ve sağlayıcıya sahip model yoksa ekle
            $exists = AppModel::where('model_name', $model['model_name'])
                            ->where('provider', $model['provider'])
                            ->exists();

            if (!$exists) {
                AppModel::create($model);
            }
        }
    }
}
