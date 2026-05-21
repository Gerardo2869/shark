<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\Figure;
use App\Models\Paint;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;

class QuoteSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            return;
        }

        Auth::login($user);

        $faker = Faker::create();
        $figures = Figure::all();
        $paints = Paint::all();

        if ($figures->isEmpty() && $paints->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 25; $i++) {
            $status = $faker->randomElement(['pending', 'accepted', 'rejected', 'expired']);
            
            $createdAt = now()->subDays(rand(0, 60))->subHours(rand(0, 23))->subMinutes(rand(0, 59));
            $expiresAt = (clone $createdAt)->addDays(15);
            
            if ($status === 'expired' && $expiresAt->isFuture()) {
                $expiresAt = now()->subDays(rand(1, 5));
            }

            $quote = Quote::create([
                'user_id' => $user->id,
                'client_name' => $faker->name,
                'total_amount' => 0,
                'status' => $status,
                'expires_at' => $expiresAt,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            $numItems = rand(1, 4);
            $totalAmount = 0;

            for ($j = 0; $j < $numItems; $j++) {
                $type = rand(0, 1) ? 'figure' : 'paint';
                
                if ($type === 'figure' && $figures->isNotEmpty()) {
                    $item = $figures->random();
                    $quotableType = Figure::class;
                } elseif ($paints->isNotEmpty()) {
                    $item = $paints->random();
                    $quotableType = Paint::class;
                } else {
                    continue;
                }

                $quantity = rand(1, 5);
                $unitPrice = $item->price;
                $subtotal = $quantity * $unitPrice;

                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'quotable_type' => $quotableType,
                    'quotable_id' => $item->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                ]);

                $totalAmount += $subtotal;
            }

            $quote->update([
                'total_amount' => $totalAmount
            ]);
        }
        
        Auth::logout();
    }
}
