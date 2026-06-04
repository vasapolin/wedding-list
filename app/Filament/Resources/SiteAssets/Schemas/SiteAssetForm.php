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
                            ->directory('site')
                            ->visibility('public')
                            ->maxSize(8192)
                            ->helperText('Se deixar vazio, o site usará a imagem de fallback abaixo.'),
                        TextInput::make('fallback_url')
                            ->label('URL de fallback')
                            ->url()
                            ->helperText('Mostrada enquanto não houver upload.'),
                    ]),
            ]);
    }
}
