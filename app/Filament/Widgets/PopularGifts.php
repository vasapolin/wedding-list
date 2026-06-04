<?php

namespace App\Filament\Widgets;

use App\Models\Gift;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class PopularGifts extends TableWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Presentes mais populares')
            ->query(fn (): Builder => Gift::query()->orderByDesc('raised_cents')->limit(5))
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->label('Presente'),
                TextColumn::make('price_cents')
                    ->label('Meta')
                    ->money('BRL', divideBy: 100),
                TextColumn::make('raised_cents')
                    ->label('Arrecadado')
                    ->money('BRL', divideBy: 100),
                TextColumn::make('progress')
                    ->label('Progresso')
                    ->state(fn (Gift $record): string => $record->price_cents > 0
                        ? $record->progress_percentage.'%'
                        : '—'),
            ]);
    }
}
