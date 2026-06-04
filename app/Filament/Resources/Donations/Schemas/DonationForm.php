<?php

namespace App\Filament\Resources\Donations\Schemas;

use App\Models\Donation;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DonationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Doação')
                    ->columns(2)
                    ->components([
                        Select::make('gift_id')
                            ->label('Presente')
                            ->relationship('gift', 'name')
                            ->searchable()
                            ->placeholder('Doação livre (sem presente)'),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                Donation::STATUS_PENDING => 'Pendente',
                                Donation::STATUS_PAID => 'Pago',
                                Donation::STATUS_FAILED => 'Falhou',
                                Donation::STATUS_REFUNDED => 'Estornado',
                            ])
                            ->required()
                            ->native(false),
                        TextInput::make('amount_cents')
                            ->label('Valor (R$)')
                            ->prefix('R$')
                            ->numeric()
                            ->step(0.01)
                            ->dehydrateStateUsing(fn ($state) => (int) round(((float) $state) * 100))
                            ->formatStateUsing(fn ($state) => $state !== null ? number_format($state / 100, 2, '.', '') : null),
                        Select::make('payment_method')
                            ->label('Método')
                            ->options([
                                'pix' => 'Pix',
                                'credit_card' => 'Cartão de crédito',
                                'manual' => 'Manual',
                            ])
                            ->native(false),
                    ]),

                Section::make('Doador')
                    ->columns(2)
                    ->components([
                        TextInput::make('donor_name')->label('Nome'),
                        TextInput::make('donor_email')->label('E-mail')->email(),
                        Toggle::make('is_anonymous')->label('Anônimo'),
                        Textarea::make('message')
                            ->label('Mensagem')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Asaas')
                    ->columns(2)
                    ->components([
                        TextInput::make('asaas_payment_id')->label('ID Asaas'),
                        TextInput::make('paid_at')
                            ->label('Pago em')
                            ->disabled(),
                    ]),
            ]);
    }
}
