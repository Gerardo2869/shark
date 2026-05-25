<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bundle;
use App\Models\BundleItem;
use App\Models\Figure;
use App\Models\Paint;

class BundleSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $figures = Figure::all();
        $paints = Paint::all();

        if ($figures->isEmpty() || $paints->isEmpty()) {
            return;
        }

        $adjectives = ['Epic', 'Ultimate', 'Starter', 'Advanced', 'Collector\'s', 'Premium', 'Basic', 'Deluxe', 'Essential', 'Master', 'Warlord\'s', 'Painter\'s', 'Heroic', 'Legendary'];
        $nouns = ['Kit', 'Pack', 'Bundle', 'Collection', 'Set', 'Assortment', 'Arsenal', 'Horde', 'Squad', 'Selection', 'Cache', 'Stash'];

        for ($i = 0; $i < 20; $i++) {
            $bundleName = $faker->randomElement($adjectives) . ' ' . $faker->randomElement($nouns);
            // Optionally add a random word to make it more unique
            if (rand(0, 1)) {
                $bundleName .= ' ' . ucfirst($faker->word());
            }

            $bundle = Bundle::create([
                'name' => $bundleName,
                'description' => $faker->sentence(rand(8, 15)),
                'price' => $faker->randomFloat(2, 25, 300),
                'is_active' => $faker->boolean(90),
            ]);

            // Add 1 to 4 random figures
            $numFigures = rand(1, 4);
            $selectedFigures = $figures->random(min($numFigures, $figures->count()));
            foreach ($selectedFigures as $figure) {
                BundleItem::create([
                    'bundle_id' => $bundle->id,
                    'sellable_type' => Figure::class,
                    'sellable_id' => $figure->id,
                    'quantity' => rand(1, 3),
                ]);
            }

            // Add 1 to 6 random paints
            $numPaints = rand(1, 6);
            $selectedPaints = $paints->random(min($numPaints, $paints->count()));
            foreach ($selectedPaints as $paint) {
                BundleItem::create([
                    'bundle_id' => $bundle->id,
                    'sellable_type' => Paint::class,
                    'sellable_id' => $paint->id,
                    'quantity' => rand(1, 4),
                ]);
            }
        }
    }
}
