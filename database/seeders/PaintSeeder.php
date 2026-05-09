<?php

namespace Database\Seeders;

use App\Models\Paint;
use Illuminate\Database\Seeder;

class PaintSeeder extends Seeder
{
    public function run(): void
    {
        $paints = [
            // Citadel Base
            ['name' => 'Abaddon Black', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#000000', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Mephiston Red', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#991115', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Macragge Blue', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#0D407F', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Deathworld Forest', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#585D36', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Retributor Armour', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#C39E50', 'finish' => 'Metallic', 'ml' => 12],
            ['name' => 'Leadbelcher', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#888D8F', 'finish' => 'Metallic', 'ml' => 12],
            ['name' => 'Balthasar Gold', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#AB7351', 'finish' => 'Metallic', 'ml' => 12],
            ['name' => 'Bugman\'s Glow', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#834F44', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Death Guard Green', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#848A66', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Zandri Dust', 'brand' => 'Citadel', 'color_type' => 'Base', 'hex_color' => '#9E915C', 'finish' => 'Matte', 'ml' => 12],

            // Citadel Layer
            ['name' => 'Evil Sunz Scarlet', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#C11921', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Flash Gitz Yellow', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#FFF300', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'White Scar', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#FFFFFF', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Altdorf Guard Blue', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#2D4696', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Auric Armour Gold', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#E3B063', 'finish' => 'Metallic', 'ml' => 12],
            ['name' => 'Ironbreaker', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#A1A5A7', 'finish' => 'Metallic', 'ml' => 12],
            ['name' => 'Moot Green', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#39AD44', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Wild Rider Red', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#E82E1B', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Russ Grey', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#50607B', 'finish' => 'Matte', 'ml' => 12],
            ['name' => 'Fenrisian Grey', 'brand' => 'Citadel', 'color_type' => 'Layer', 'hex_color' => '#6D90A7', 'finish' => 'Matte', 'ml' => 12],

            // Citadel Shade
            ['name' => 'Nuln Oil', 'brand' => 'Citadel', 'color_type' => 'Shade', 'hex_color' => '#1A1A1A', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Agrax Earthshade', 'brand' => 'Citadel', 'color_type' => 'Shade', 'hex_color' => '#3D2A1F', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Reikland Fleshshade', 'brand' => 'Citadel', 'color_type' => 'Shade', 'hex_color' => '#4D2A1F', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Seraphim Sepia', 'brand' => 'Citadel', 'color_type' => 'Shade', 'hex_color' => '#8B6A4C', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Carroburg Crimson', 'brand' => 'Citadel', 'color_type' => 'Shade', 'hex_color' => '#5A1A1A', 'finish' => 'Matte', 'ml' => 18],

            // Vallejo Game Color
            ['name' => 'Electric Blue', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#0097D7', 'finish' => 'Matte', 'ml' => 17],
            ['name' => 'Dead White', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#FFFFFF', 'finish' => 'Matte', 'ml' => 17],
            ['name' => 'Bloody Red', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#C41E3A', 'finish' => 'Matte', 'ml' => 17],
            ['name' => 'Sun Yellow', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#FFD700', 'finish' => 'Matte', 'ml' => 17],
            ['name' => 'Goblin Green', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#3D8C40', 'finish' => 'Matte', 'ml' => 17],
            ['name' => 'Bonewhite', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#E3DAC9', 'finish' => 'Matte', 'ml' => 17],
            ['name' => 'Beasty Brown', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#664229', 'finish' => 'Matte', 'ml' => 17],
            ['name' => 'Gunmetal', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#545454', 'finish' => 'Metallic', 'ml' => 17],
            ['name' => 'Silver', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#C0C0C0', 'finish' => 'Metallic', 'ml' => 17],
            ['name' => 'Glorious Gold', 'brand' => 'Vallejo', 'color_type' => 'Game Color', 'hex_color' => '#DAA520', 'finish' => 'Metallic', 'ml' => 17],

            // Army Painter
            ['name' => 'Matt Black', 'brand' => 'Army Painter', 'color_type' => 'Warpaints', 'hex_color' => '#000000', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Pure Red', 'brand' => 'Army Painter', 'color_type' => 'Warpaints', 'hex_color' => '#FF0000', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Daemonic Yellow', 'brand' => 'Army Painter', 'color_type' => 'Warpaints', 'hex_color' => '#FFFF00', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Greenskin', 'brand' => 'Army Painter', 'color_type' => 'Warpaints', 'hex_color' => '#2E8B57', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Ultramarine Blue', 'brand' => 'Army Painter', 'color_type' => 'Warpaints', 'hex_color' => '#4169E1', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Barbarian Flesh', 'brand' => 'Army Painter', 'color_type' => 'Warpaints', 'hex_color' => '#E9967A', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Oak Brown', 'brand' => 'Army Painter', 'color_type' => 'Warpaints', 'hex_color' => '#8B4513', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Plate Mail Metal', 'brand' => 'Army Painter', 'color_type' => 'Warpaints', 'hex_color' => '#708090', 'finish' => 'Metallic', 'ml' => 18],
            ['name' => 'Weapon Bronze', 'brand' => 'Army Painter', 'color_type' => 'Warpaints', 'hex_color' => '#CD7F32', 'finish' => 'Metallic', 'ml' => 18],
            ['name' => 'Strong Tone', 'brand' => 'Army Painter', 'color_type' => 'Quickshade Wash', 'hex_color' => '#2B1B17', 'finish' => 'Matte', 'ml' => 18],

            // Citadel Contrast
            ['name' => 'Blood Angels Red', 'brand' => 'Citadel', 'color_type' => 'Contrast', 'hex_color' => '#8B0000', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Talassar Blue', 'brand' => 'Citadel', 'color_type' => 'Contrast', 'hex_color' => '#0000FF', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Black Templar', 'brand' => 'Citadel', 'color_type' => 'Contrast', 'hex_color' => '#0A0A0A', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Skeleton Horde', 'brand' => 'Citadel', 'color_type' => 'Contrast', 'hex_color' => '#D2B48C', 'finish' => 'Matte', 'ml' => 18],
            ['name' => 'Guilliman Flesh', 'brand' => 'Citadel', 'color_type' => 'Contrast', 'hex_color' => '#FF7F50', 'finish' => 'Matte', 'ml' => 18],
        ];

        foreach ($paints as $data) {
            Paint::create(array_merge($data, [
                'stock' => rand(5, 30),
                'price' => rand(4, 12) + 0.50,
                'is_active' => true,
                'code' => strtoupper(substr(md5($data['name']), 0, 6)),
                'expiration_date' => now()->addYears(2),
            ]));
        }
    }
}
