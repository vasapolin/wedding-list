<?php

namespace Database\Seeders;

use App\Models\SiteAsset;
use Illuminate\Database\Seeder;

class SiteAssetSeeder extends Seeder
{
    public function run(): void
    {
        $assets = [
            ['key' => 'home.hero', 'label' => 'Home — Hero (fundo)', 'fallback_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=1600&q=80'],
            ['key' => 'home.gallery.1', 'label' => 'Home — Galeria 1 (alianças)', 'fallback_url' => 'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=800&q=80'],
            ['key' => 'home.gallery.2', 'label' => 'Home — Galeria 2 (local)', 'fallback_url' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&q=80'],
            ['key' => 'home.gallery.3', 'label' => 'Home — Galeria 3 (casal)', 'fallback_url' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&q=80'],
            ['key' => 'home.gallery.4', 'label' => 'Home — Galeria 4 (detalhes)', 'fallback_url' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=800&q=80'],
            ['key' => 'messages.hero', 'label' => 'Mensagens — Hero (fundo)', 'fallback_url' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=1200&q=80'],
            ['key' => 'how-to-donate.hero', 'label' => 'Como Presentear — Hero', 'fallback_url' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&q=80'],
            ['key' => 'how-to-donate.detail', 'label' => 'Como Presentear — Detalhe (presentes simbólicos)', 'fallback_url' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&q=80'],
            ['key' => 'gifts.placeholder', 'label' => 'Presentes — Imagem padrão (sem foto)', 'fallback_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&q=80'],
            ['key' => 'confirmation.hero', 'label' => 'Confirmação — Imagem', 'fallback_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80'],
        ];

        foreach ($assets as $data) {
            SiteAsset::query()->firstOrCreate(
                ['key' => $data['key']],
                $data,
            );
        }
    }
}
