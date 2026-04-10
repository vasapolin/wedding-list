@props(['name', 'price', 'image' => '', 'percentage' => 0, 'amountRaised' => '0', 'description' => '', 'badge' => ''])

<div class="bg-surface border border-surface-border hover:border-coastal/40 transition-colors duration-300 flex flex-col">

    {{-- Image area --}}
    <div class="relative aspect-[4/3] overflow-hidden">
        @if($image)
            <div class="absolute inset-0 bg-center bg-cover" style="background-image: url('{{ $image }}')"></div>
        @else
            <div class="absolute inset-0 bg-surface-light"></div>
        @endif

        @if($badge)
            <div class="absolute top-3 right-3 bg-coastal px-2.5 py-1">
                <span class="font-sans text-[10px] tracking-widest uppercase text-black">{{ $badge }}</span>
            </div>
        @endif
    </div>

    {{-- Content area --}}
    <div class="p-5 flex flex-col gap-3 flex-1">

        <div class="flex flex-col gap-0.5">
            <h3 class="font-serif text-lg text-vanilla leading-snug">{{ $name }}</h3>
            <p class="font-sans text-sm text-coastal">R$ {{ $price }}</p>
        </div>

        @if($description)
            <p class="font-sans text-sm text-ink-muted leading-relaxed">{{ $description }}</p>
        @endif

        <div class="mt-auto flex flex-col gap-3">
            <x-progress-bar
                :percentage="$percentage"
                :label="$percentage . '% alcançado'"
                :amountText="'R$ ' . $amountRaised"
            />

            @if($percentage >= 100)
                <span class="font-sans text-sm text-ink-muted tracking-wide">Concluído</span>
            @else
                <a href="/doar" class="group/link inline-flex items-center gap-2 font-sans text-sm text-coastal hover:text-coastal-light transition-colors">
                    Contribuir
                    <span class="inline-block translate-y-px transition-transform duration-200 group-hover/link:translate-x-0.5">&rarr;</span>
                </a>
            @endif
        </div>

    </div>

</div>
