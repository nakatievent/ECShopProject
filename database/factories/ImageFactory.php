<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // 画像のフルパスを生成
        $fullImagePath = fake()->image(storage_path('app/public'), 640, 480);

        // フルパスからファイル名を抽出
        $imageName = basename($fullImagePath);

        // URL形式に変換
        $imageUrl = url('storage/' . $imageName);

        return [
            'image_url' => $imageUrl,
        ];
    }
}
