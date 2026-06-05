<?php

namespace App\Filament\Resources\SiteAssets\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteAssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->components([
                        TextInput::make('label')
                            ->label('Nome')
                            ->disabled()
                            ->dehydrated(false),
                        TextInput::make('key')
                            ->label('Chave')
                            ->disabled()
                            ->dehydrated(false),
                        FileUpload::make('image_path')
                            ->label('Imagem')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public')
                            ->maxSize(8192)
                            ->helperText('Se deixar vazio, o site usará a imagem de fallback abaixo.'),
                        TextInput::make('fallback_url')
                            ->label('URL de fallback')
                            ->rule('regex:#^(https?://|/)#')
                            ->helperText('Mostrada enquanto não houver upload. Aceita URL completa ou caminho do site (ex.: /images/site/home-hero.jpg).'),
                    ]),
            ]);
    }
}
