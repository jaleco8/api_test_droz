<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente' => fake()->name(),
            'producto' => fake()->word(),
            'cantidad' => fake()->numberBetween(1, 10),
            'precio' => fake()->randomFloat(2, 10, 100),
            'total' => fake()->randomFloat(2, 100, 1000),
            'fecha' => fake()->date(),
            'observaciones' => fake()->sentence(),
            'estado' => fake()->randomElement(['pendiente', 'pagado', 'cancelado']),
            'user_id' => fake()->numberBetween(1, 10),
        ];
    }
}
