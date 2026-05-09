<?php

namespace Database\Seeders;

use App\Models\Figure;
use Illuminate\Database\Seeder;

class FigureSeeder extends Seeder
{
    public function run(): void
    {
        $figures = [
            // Warhammer 40k - Space Marines
            ['name' => 'Primaris Intercessors', 'faction' => 'Space Marines', 'unit_type' => 'Troops', 'material' => 'Plastic', 'base_size' => '32mm', 'points' => 100],
            ['name' => 'Primaris Captain', 'faction' => 'Space Marines', 'unit_type' => 'HQ', 'material' => 'Plastic', 'base_size' => '40mm', 'points' => 105],
            ['name' => 'Redemptor Dreadnought', 'faction' => 'Space Marines', 'unit_type' => 'Elite', 'material' => 'Plastic', 'base_size' => '90mm', 'points' => 185],
            ['name' => 'Bladeguard Veterans', 'faction' => 'Space Marines', 'unit_type' => 'Elite', 'material' => 'Plastic', 'base_size' => '40mm', 'points' => 105],
            ['name' => 'Outriders', 'faction' => 'Space Marines', 'unit_type' => 'Fast Attack', 'material' => 'Plastic', 'base_size' => '90mm Oval', 'points' => 135],

            // Warhammer 40k - Necrons
            ['name' => 'Necron Warriors', 'faction' => 'Necrons', 'unit_type' => 'Troops', 'material' => 'Plastic', 'base_size' => '32mm', 'points' => 130],
            ['name' => 'Skorpekh Destroyers', 'faction' => 'Necrons', 'unit_type' => 'Elite', 'material' => 'Plastic', 'base_size' => '50mm', 'points' => 90],
            ['name' => 'Overlord', 'faction' => 'Necrons', 'unit_type' => 'HQ', 'material' => 'Plastic', 'base_size' => '40mm', 'points' => 95],
            ['name' => 'Canoptek Scarab Swarms', 'faction' => 'Necrons', 'unit_type' => 'Fast Attack', 'material' => 'Plastic', 'base_size' => '40mm', 'points' => 45],
            ['name' => 'Canoptek Doomstalker', 'faction' => 'Necrons', 'unit_type' => 'Heavy Support', 'material' => 'Plastic', 'base_size' => '90mm', 'points' => 130],

            // Warhammer 40k - Orks
            ['name' => 'Ork Boyz', 'faction' => 'Orks', 'unit_type' => 'Troops', 'material' => 'Plastic', 'base_size' => '32mm', 'points' => 80],
            ['name' => 'Beastboss', 'faction' => 'Orks', 'unit_type' => 'HQ', 'material' => 'Plastic', 'base_size' => '50mm', 'points' => 95],
            ['name' => 'Squighog Boyz', 'faction' => 'Orks', 'unit_type' => 'Fast Attack', 'material' => 'Plastic', 'base_size' => '75mm Oval', 'points' => 75],
            ['name' => 'Deff Dread', 'faction' => 'Orks', 'unit_type' => 'Heavy Support', 'material' => 'Plastic', 'base_size' => '60mm', 'points' => 85],
            ['name' => 'Grozghull Mag Uruk Thraka', 'faction' => 'Orks', 'unit_type' => 'HQ', 'material' => 'Plastic', 'base_size' => '80mm', 'points' => 300],

            // AOS - Stormcast Eternals
            ['name' => 'Liberators', 'faction' => 'Stormcast Eternals', 'unit_type' => 'Battleline', 'material' => 'Plastic', 'base_size' => '40mm', 'points' => 115],
            ['name' => 'Lord-Imperatant', 'faction' => 'Stormcast Eternals', 'unit_type' => 'Leader', 'material' => 'Plastic', 'base_size' => '40mm', 'points' => 175],
            ['name' => 'Vindictors', 'faction' => 'Stormcast Eternals', 'unit_type' => 'Battleline', 'material' => 'Plastic', 'base_size' => '40mm', 'points' => 130],
            ['name' => 'Yndrasta', 'faction' => 'Stormcast Eternals', 'unit_type' => 'Leader', 'material' => 'Plastic', 'base_size' => '60mm', 'points' => 320],
            ['name' => 'Annihilators', 'faction' => 'Stormcast Eternals', 'unit_type' => 'Elite', 'material' => 'Plastic', 'base_size' => '40mm', 'points' => 200],

            // D&D - Monsters
            ['name' => 'Beholder', 'faction' => 'D&D Monsters', 'unit_type' => 'Large', 'material' => 'Resin', 'base_size' => '50mm', 'points' => 0],
            ['name' => 'Ancient Red Dragon', 'faction' => 'D&D Monsters', 'unit_type' => 'Gargantuan', 'material' => 'Resin', 'base_size' => '100mm', 'points' => 0],
            ['name' => 'Mind Flayer', 'faction' => 'D&D Monsters', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Gelatinous Cube', 'faction' => 'D&D Monsters', 'unit_type' => 'Large', 'material' => 'Plastic', 'base_size' => '50mm', 'points' => 0],
            ['name' => 'Lich', 'faction' => 'D&D Monsters', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Owl Bear', 'faction' => 'D&D Monsters', 'unit_type' => 'Large', 'material' => 'Resin', 'base_size' => '50mm', 'points' => 0],
            ['name' => 'Mimic', 'faction' => 'D&D Monsters', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Goblin Warband', 'faction' => 'D&D Monsters', 'unit_type' => 'Small', 'material' => 'Plastic', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Displacer Beast', 'faction' => 'D&D Monsters', 'unit_type' => 'Large', 'material' => 'Resin', 'base_size' => '50mm', 'points' => 0],
            ['name' => 'Demogorgon', 'faction' => 'D&D Monsters', 'unit_type' => 'Huge', 'material' => 'Resin', 'base_size' => '75mm', 'points' => 0],

            // D&D - Heroes
            ['name' => 'Human Fighter', 'faction' => 'D&D Heroes', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Elf Ranger', 'faction' => 'D&D Heroes', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Dwarf Cleric', 'faction' => 'D&D Heroes', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Tiefling Warlock', 'faction' => 'D&D Heroes', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Halfling Rogue', 'faction' => 'D&D Heroes', 'unit_type' => 'Small', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Dragonborn Paladin', 'faction' => 'D&D Heroes', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Gnome Wizard', 'faction' => 'D&D Heroes', 'unit_type' => 'Small', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Half-Orc Barbarian', 'faction' => 'D&D Heroes', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Tabaxi Monk', 'faction' => 'D&D Heroes', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],
            ['name' => 'Firbolg Druid', 'faction' => 'D&D Heroes', 'unit_type' => 'Medium', 'material' => 'Resin', 'base_size' => '25mm', 'points' => 0],

            // Warhammer 40k - Chaos
            ['name' => 'Chaos Space Marines', 'faction' => 'Chaos', 'unit_type' => 'Troops', 'material' => 'Plastic', 'base_size' => '32mm', 'points' => 110],
            ['name' => 'Abaddon the Despoiler', 'faction' => 'Chaos', 'unit_type' => 'HQ', 'material' => 'Plastic', 'base_size' => '60mm', 'points' => 300],
            ['name' => 'Obliterators', 'faction' => 'Chaos', 'unit_type' => 'Elite', 'material' => 'Plastic', 'base_size' => '50mm', 'points' => 190],
            ['name' => 'Venomcrawler', 'faction' => 'Chaos', 'unit_type' => 'Fast Attack', 'material' => 'Plastic', 'base_size' => '100mm', 'points' => 105],
            ['name' => 'Heldrake', 'faction' => 'Chaos', 'unit_type' => 'Flyer', 'material' => 'Plastic', 'base_size' => '120mm Oval', 'points' => 165],

            // Eldar
            ['name' => 'Guardian Defenders', 'faction' => 'Aeldari', 'unit_type' => 'Troops', 'material' => 'Plastic', 'base_size' => '28.5mm', 'points' => 90],
            ['name' => 'Avatar of Khaine', 'faction' => 'Aeldari', 'unit_type' => 'HQ', 'material' => 'Plastic', 'base_size' => '80mm', 'points' => 280],
            ['name' => 'Howling Banshees', 'faction' => 'Aeldari', 'unit_type' => 'Elite', 'material' => 'Plastic', 'base_size' => '28.5mm', 'points' => 110],
            ['name' => 'Wraithlord', 'faction' => 'Aeldari', 'unit_type' => 'Heavy Support', 'material' => 'Plastic', 'base_size' => '60mm', 'points' => 100],
            ['name' => 'Farseer', 'faction' => 'Aeldari', 'unit_type' => 'HQ', 'material' => 'Plastic', 'base_size' => '25mm', 'points' => 95],
        ];

        foreach ($figures as $data) {
            Figure::create(array_merge($data, [
                'stock' => rand(1, 15),
                'price' => rand(25, 150) + 0.99,
                'image' => 'https://loremflickr.com/400/400/miniature,warhammer,painting?lock=' . rand(1, 1000),
                'condition' => 'New on Sprue',
                'is_active' => true,
            ]));
        }
    }
}
