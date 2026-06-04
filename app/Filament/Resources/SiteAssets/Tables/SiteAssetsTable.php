<?php

namespace App\Filament\Resources\SiteAssets\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteAssetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('key')
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Imagem')
                    ->square()
                    ->size(72)
                    ->defaultImageUrl(fn ($record) => $record->fallback_url),
                TextColumn::make('label')
                    ->label('Nome')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('key')
                    ->label('Chave')
                    ->copyable()
                    ->fontFamily('mono')
                    ->size('xs'),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([]);
    }
}
