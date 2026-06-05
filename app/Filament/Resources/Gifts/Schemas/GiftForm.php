<?php

namespace App\Filament\Resources\Gifts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GiftForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identificação')
                    ->columns(2)
                    ->components([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, callable $set, callable $get): void {
                                if (! empty($get('slug'))) {
                                    return;
                                }
                                $set('slug', Str::slug((string) $state));
                            }),
                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(3)
                            ->columnSpanFull(),
                        Select::make('category')
                            ->label('Categoria')
                            ->options([
                                'casa' => 'Casa',
                                'lua-de-mel' => 'Lua de Mel',
                                'experiencias' => 'Experiências',
                                'premium' => 'Premium',
                            ])
                            ->native(false)
                            ->searchable(),
                    ]),

                Section::make('Imagem')
                    ->components([
                        FileUpload::make('image_path')
                            ->label('Foto do presente')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('gifts')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->helperText('Recomendado 4:3, até 5MB.'),
                    ]),

                Section::make('Valor')
                    ->columns(2)
                    ->components([
                        TextInput::make('price_cents')
                            ->label('Valor total (R$)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('R$')
                            ->step(0.01)
                            ->dehydrateStateUsing(fn ($state) => (int) round(((float) $state) * 100))
                            ->formatStateUsing(fn ($state) => $state !== null ? number_format($state / 100, 2, '.', '') : null)
                            ->helperText('Valor "alvo" do presente.'),
                        TextInput::make('raised_cents')
                            ->label('Já arrecadado (R$)')
                            ->numeric()
                            ->minValue(0)
                            ->prefix('R$')
                            ->step(0.01)
                            ->default(0)
                            ->dehydrateStateUsing(fn ($state) => (int) round(((float) ($state ?? 0)) * 100))
                            ->formatStateUsing(fn ($state) => $state !== null ? number_format($state / 100, 2, '.', '') : '0.00')
                            ->helperText('Atualizado automaticamente quando uma doação é confirmada.'),
                    ]),

                Section::make('Exibição')
                    ->columns(2)
                    ->components([
                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Ordem de exibição')
                            ->numeric()
                            ->minValue(0)
                            ->default(0),
                    ]),
            ]);
    }
}
