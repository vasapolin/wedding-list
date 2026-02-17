@props(['name', 'price', 'image', 'percentage' => 0, 'amountRaised' => '0', 'description' => '', 'badge' => '', 'installment' => ''])

<div class="group bg-white dark:bg-background-dark rounded-2xl overflow-hidden border border-[#e5e3dc] dark:border-[#3a3526] shadow-sm hover:shadow-md transition-all flex flex-col">
    <div class="h-64 bg-center bg-cover relative" style="background-image: url('{{ $image }}')">
        @if($badge)
            <div class="absolute top-3 right-3 bg-white/90 dark:bg-background-dark/90 px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase text-primary">{{ $badge }}</div>
        @endif
    </div>
    <div class="p-6 space-y-4 flex flex-col flex-1">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-lg font-bold group-hover:text-primary transition-colors">{{ $name }}</h3>
                <p class="text-sm text-primary font-semibold">R$ {{ $price }}</p>
            </div>
        </div>
        @if($description)
            <p class="text-muted text-sm flex-1">{{ $description }}</p>
        @endif
        <x-progress-bar :percentage="$percentage" :label="$percentage . '% Alcancado'" :amountText="'R$ ' . $amountRaised" />
        <a href="/doar" class="block w-full text-center bg-primary/10 hover:bg-primary/20 text-primary py-3 rounded-xl font-bold transition-all mt-auto">Contribuir</a>
    </div>
</div>
