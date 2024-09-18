<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $priceNumbers = [120, 130, 140, 160, 180];

        return [
            'company_id'=> Company::factory(), 
            'product_name'=> $this->faker->word(),
            'price'=> $this->faker->randomElement($priceNumbers),
            'stock'=> $this->faker->numberBetween($min = 0,$max = 30),
            'comment'=> $this->faker->realText(30),
            'img_path'=> $this->faker->imageUrl(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            //
        ];
    }
}
