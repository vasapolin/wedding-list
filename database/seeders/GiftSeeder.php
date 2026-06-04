<?php

namespace Database\Seeders;

use App\Models\Gift;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GiftSeeder extends Seeder
{
    public function run(): void
    {
        $gifts = [
            [
                'name' => 'Kit de Panelas Premium',
                'description' => 'Para cozinharmos juntos cada refeição do nosso novo lar.',
                'image_path' => null,
                'category' => 'casa',
                'price_cents' => 68000,
                'raised_cents' => 51000,
                'sort_order' => 1,
            ],
            [
                'name' => 'Máquina de Café Espresso',
                'description' => 'Nossos cafés da manhã merecem começar com perfeição.',
                'image_path' => null,
                'category' => 'casa',
                'price_cents' => 120000,
                'raised_cents' => 48000,
                'sort_order' => 2,
            ],
            [
                'name' => 'Enxoval de Cama',
                'description' => 'Roupas de cama em algodão egípcio para noites de sonho.',
                'image_path' => null,
                'category' => 'casa',
                'price_cents' => 45000,
                'raised_cents' => 40500,
                'sort_order' => 3,
            ],
            [
                'name' => 'Dia de Spa para o Casal',
                'description' => 'Um momento de relaxamento pós-casamento para recarregarmos as energias.',
                'image_path' => null,
                'category' => 'experiencias',
                'price_cents' => 30000,
                'raised_cents' => 4500,
                'sort_order' => 4,
            ],
            [
                'name' => 'Adega dos Noivos',
                'description' => 'Ajude-nos a iniciar nossa coleção de vinhos para momentos especiais.',
                'image_path' => null,
                'category' => 'experiencias',
                'price_cents' => 50000,
                'raised_cents' => 25000,
                'sort_order' => 5,
            ],
            [
                'name' => 'Enxoval de Banho',
                'description' => 'Toalhas felpudas e detalhes que farão nosso banheiro mais aconchegante.',
                'image_path' => null,
                'category' => 'casa',
                'price_cents' => 40000,
                'raised_cents' => 34000,
                'sort_order' => 6,
            ],
            [
                'name' => 'Lua de Mel em Lisboa',
                'description' => 'Contribua para uma viagem inesquecível pela cidade que sempre sonhamos visitar juntos.',
                'image_path' => null,
                'category' => 'lua-de-mel',
                'price_cents' => 350000,
                'raised_cents' => 80000,
                'sort_order' => 7,
            ],
        ];

        foreach ($gifts as $data) {
            $data['slug'] = Str::slug($data['name']);
            Gift::query()->firstOrCreate(
                ['slug' => $data['slug']],
                $data,
            );
        }
    }
}
