<?php

namespace Database\Seeders;

use App\Models\SiteAsset;
use Illuminate\Database\Seeder;

class SiteAssetSeeder extends Seeder
{
    public function run(): void
    {
        $assets = [
            ['key' => 'home.hero', 'label' => 'Home — Hero (fundo)', 'fallback_url' => '/images/site/home-hero.jpg'],
            ['key' => 'home.hero.mobile', 'label' => 'Home — Hero (fundo mobile)', 'fallback_url' => '/images/site/home-hero-mobile.jpg'],
            ['key' => 'messages.hero', 'label' => 'Mensagens — Hero (fundo)', 'fallback_url' => '/images/site/messages-hero.jpg'],
            ['key' => 'how-to-donate.hero', 'label' => 'Como Presentear — Hero', 'fallback_url' => '/images/site/how-to-donate-hero.jpg'],
            ['key' => 'how-to-donate.detail', 'label' => 'Como Presentear — Detalhe (presentes simbólicos)', 'fallback_url' => '/images/site/how-to-donate-detail.jpg'],
            ['key' => 'how-to-donate.flexible', 'label' => 'Como Presentear — Contribuição Flexível', 'fallback_url' => '/images/site/how-to-donate-flexible.jpg'],
            ['key' => 'gifts.placeholder', 'label' => 'Presentes — Imagem padrão (sem foto)', 'fallback_url' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&q=80'],
            ['key' => 'confirmation.hero', 'label' => 'Confirmação — Imagem', 'fallback_url' => '/images/site/confirmation-hero.jpg'],
        ];

        foreach ($assets as $data) {
            SiteAsset::query()->updateOrCreate(
                ['key' => $data['key']],
                $data,
            );
        }
    }
}
