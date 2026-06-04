<?php

namespace App\Filament\Resources\Gifts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class GiftsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Imagem')
                    ->square()
                    ->size(56),
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('category')
                    ->label('Categoria')
                    ->badge()
                    ->searchable(),
                TextColumn::make('price_cents')
                    ->label('Valor')
                    ->money('BRL', divideBy: 100)
                    ->sortable(),
                TextColumn::make('raised_cents')
                    ->label('Arrecadado')
                    ->money('BRL', divideBy: 100)
                    ->sortable(),
                TextColumn::make('progress_percentage')
                    ->label('Progresso')
                    ->suffix('%'),
                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Ordem')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Ativos'),
                SelectFilter::make('category')
                    ->options([
                        'casa' => 'Casa',
                        'lua-de-mel' => 'Lua de Mel',
                        'experiencias' => 'Experiências',
                        'premium' => 'Premium',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
