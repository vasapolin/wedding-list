<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use App\Models\Message;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonationStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $paidCents = (int) Donation::query()
            ->where('status', Donation::STATUS_PAID)
            ->sum('amount_cents');

        $paidCount = Donation::query()
            ->where('status', Donation::STATUS_PAID)
            ->count();

        $pendingCount = Donation::query()
            ->where('status', Donation::STATUS_PENDING)
            ->count();

        $messageCount = Message::query()->count();

        return [
            Stat::make('Total arrecadado', 'R$ '.number_format($paidCents / 100, 2, ',', '.'))
                ->description('Somando apenas doações confirmadas')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Doações pagas', (string) $paidCount)
                ->description('Pagamentos confirmados')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Aguardando pagamento', (string) $pendingCount)
                ->description('Cobranças pendentes')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Mensagens no mural', (string) $messageCount)
                ->description('Recados dos convidados')
                ->descriptionIcon('heroicon-m-chat-bubble-left-ellipsis')
                ->color('info'),
        ];
    }
}
