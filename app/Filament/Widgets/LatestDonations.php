<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestDonations extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Últimas doações')
            ->query(fn (): Builder => Donation::query()->latest()->limit(10))
            ->paginated(false)
            ->columns([
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i'),
                TextColumn::make('donor_name')
                    ->label('Doador')
                    ->formatStateUsing(fn ($state, Donation $record) => $record->is_anonymous ? 'Anônimo' : ($state ?? '—')),
                TextColumn::make('gift.name')
                    ->label('Presente')
                    ->placeholder('Doação livre'),
                TextColumn::make('amount_cents')
                    ->label('Valor')
                    ->money('BRL', divideBy: 100),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => Donation::STATUS_PENDING,
                        'success' => Donation::STATUS_PAID,
                        'danger' => Donation::STATUS_FAILED,
                        'gray' => Donation::STATUS_REFUNDED,
                    ])
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        Donation::STATUS_PENDING => 'Pendente',
                        Donation::STATUS_PAID => 'Pago',
                        Donation::STATUS_FAILED => 'Falhou',
                        Donation::STATUS_REFUNDED => 'Estornado',
                        default => $state,
                    }),
            ]);
    }
}
