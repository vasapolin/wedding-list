<?php

namespace App\Filament\Widgets;

use App\Models\Donation;
use Filament\Widgets\ChartWidget;

class DonationsChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Arrecadação por dia (últimos 30 dias)';

    protected ?string $pollingInterval = null;

    protected function getData(): array
    {
        $start = now()->subDays(29)->startOfDay();

        $totalsByDay = Donation::query()
            ->where('status', Donation::STATUS_PAID)
            ->whereNotNull('paid_at')
            ->where('paid_at', '>=', $start)
            ->get(['paid_at', 'amount_cents'])
            ->groupBy(fn (Donation $donation) => $donation->paid_at->toDateString())
            ->map(fn ($donations) => $donations->sum('amount_cents'));

        $labels = [];
        $points = [];

        for ($day = 0; $day < 30; $day++) {
            $date = $start->copy()->addDays($day);
            $labels[] = $date->format('d/m');
            $points[] = round(($totalsByDay[$date->toDateString()] ?? 0) / 100, 2);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Arrecadado (R$)',
                    'data' => $points,
                    'backgroundColor' => '#9bb2c4',
                    'borderColor' => '#9bb2c4',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
