@props(['percentage' => 0, 'label' => '', 'amountText' => ''])

<div class="space-y-2">
    <div class="flex justify-between text-xs font-medium uppercase tracking-wider text-gray-500">
        <span>{{ $label }}</span>
        <span>{{ $amountText }}</span>
    </div>
    <div class="w-full bg-gray-100 dark:bg-gray-800 h-2 rounded-full overflow-hidden">
        <div class="{{ $percentage >= 100 ? 'bg-green-500' : 'bg-primary' }} h-full rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
    </div>
</div>
