<?php

namespace App\Filament\Resources\Donations\Tables;

use App\Models\Donation;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DonationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('donor_name')
                    ->label('Doador')
                    ->formatStateUsing(fn ($state, Donation $record) => $record->is_anonymous ? 'Anônimo' : ($state ?? '—'))
                    ->searchable(),
                TextColumn::make('donor_email')
                    ->label('E-mail')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('gift.name')
                    ->label('Presente')
                    ->placeholder('Doação livre')
                    ->searchable(),
                TextColumn::make('amount_cents')
                    ->label('Valor')
                    ->money('BRL', divideBy: 100)
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('Método')
                    ->badge(),
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
                IconColumn::make('is_anonymous')
                    ->label('Anônimo')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('asaas_payment_id')
                    ->label('ID Asaas')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('paid_at')
                    ->label('Pago em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        Donation::STATUS_PENDING => 'Pendente',
                        Donation::STATUS_PAID => 'Pago',
                        Donation::STATUS_FAILED => 'Falhou',
                        Donation::STATUS_REFUNDED => 'Estornado',
                    ]),
                SelectFilter::make('payment_method')
                    ->label('Método')
                    ->options([
                        'pix' => 'Pix',
                        'credit_card' => 'Cartão',
                        'manual' => 'Manual',
                    ]),
                Filter::make('paid')
                    ->label('Apenas confirmadas')
                    ->query(fn (Builder $q) => $q->where('status', Donation::STATUS_PAID)),
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
