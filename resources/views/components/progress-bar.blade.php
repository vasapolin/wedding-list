@props(['percentage' => 0, 'label' => '', 'amountText' => ''])

<div class="flex flex-col gap-1.5">
    @if($label || $amountText)
        <div class="flex justify-between items-center">
            <span class="font-sans text-xs text-ink-muted tracking-wide">{{ $label }}</span>
            <span class="font-sans text-xs text-ink-muted tracking-wide">{{ $amountText }}</span>
        </div>
    @endif
    <div class="h-px bg-surface-border overflow-hidden">
        <div
            class="{{ $percentage >= 100 ? 'bg-green-500' : 'bg-coastal' }} h-full transition-all duration-500"
            style="width: {{ min($percentage, 100) }}%"
        ></div>
    </div>
</div>
