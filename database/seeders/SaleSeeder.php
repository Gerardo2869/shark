<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Figure;
use App\Models\Paint;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            return;
        }

        Auth::login($user);

        $figures = Figure::all();
        $paints = Paint::all();

        if ($figures->isEmpty() && $paints->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 35; $i++) {
            $createdAt = now()->subDays(rand(0, 60))->subHours(rand(0, 23))->subMinutes(rand(0, 59));
            
            $sale = Sale::create([
                'user_id' => $user->id,
                'total_amount' => 0,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            $numItems = rand(1, 4);
            $totalAmount = 0;

            for ($j = 0; $j < $numItems; $j++) {
                $type = rand(0, 1) ? 'figure' : 'paint';
                
                if ($type === 'figure' && $figures->isNotEmpty()) {
                    $item = $figures->random();
                    $sellableType = Figure::class;
                } elseif ($paints->isNotEmpty()) {
                    $item = $paints->random();
                    $sellableType = Paint::class;
                } else {
                    continue;
                }

                $quantity = rand(1, 3);
                $unitPrice = $item->price;
                $subtotal = $quantity * $unitPrice;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'sellable_type' => $sellableType,
                    'sellable_id' => $item->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $subtotal,
                ]);

                $totalAmount += $subtotal;
            }

            $sale->update([
                'total_amount' => $totalAmount
            ]);
        }
        
        Auth::logout();
    }
}
