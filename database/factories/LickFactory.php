<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LickFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $temp = [
            // chatgpt
            'name' => $this->faker->randomElement([
                // Guitars
                'Fender Stratocaster',
                'Gibson Les Paul',
                'Ibanez RG',
                'PRS Custom 24',
                'Yamaha Pacifica',
                'Epiphone SG',
                'Gretsch Electromatic',
                'Jackson Soloist',
                'Schecter Hellraiser',
                'Fender Telecaster',

                // Video Games
                'The Legend of Zelda: Breath of the Wild',
                'God of War',
                'Spider-Man: Miles Morales',
                'Halo Infinite',
                'Elden Ring',
                'Cyberpunk 2077',
                'Animal Crossing: New Horizons',
                'Minecraft',
                'Call of Duty: Modern Warfare',
                'FIFA 23',

                // Consoles
                'PlayStation 5',
                'Xbox Series X',
                'Nintendo Switch',
                'PlayStation 4',
                'Xbox One',
                'Nintendo Switch Lite',
                'PlayStation 4 Pro',
                'Xbox Series S',
                'Steam Deck',
                'RetroPie Console',

                // Electronics
                'Apple iPhone 14',
                'Samsung Galaxy S23',
                'MacBook Pro 16"',
                'Dell XPS 13',
                'iPad Air',
                'Sony WH-1000XM5 Headphones',
                'Bose QuietComfort 45',
                'Amazon Echo Dot',
                'Google Nest Hub',
                'Fitbit Charge 6'
            ]),

            'cost' => $this->faker->numberBetween(1, 500),
            'date' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        ];

        $temp['profit'] = $temp['cost'] * -1;

        return $temp;
    }
}
