@extends('layouts.app')

@section('title', 'Lista de Presentes - Laura & Victor')

@section('content')
<div class="max-w-[1440px] mx-auto w-full xl:flex xl:items-start">

    {{-- Main content area --}}
    <div class="flex-1 px-6 lg:px-16 xl:pr-12 xl:border-r border-surface-border">

        {{-- Header --}}
        <header class="pt-28 pb-10" data-reveal>
            <p class="font-sans text-xs tracking-[0.2em] uppercase text-coastal mb-4">Laura &amp; Victor · 2026</p>
            <h1 class="font-serif text-5xl md:text-6xl text-ink leading-tight mb-4">Lista de Presentes</h1>
            <div class="decorative-line w-24 mb-6"></div>
            <p class="font-sans text-sans text-ink-muted text-base max-w-md leading-relaxed">
                Cada presente simboliza um pedaço do nosso sonho compartilhado. Obrigado por fazer parte deste momento.
            </p>
        </header>

        {{-- Filters --}}
        @php
            $filters = [
                'todos' => 'Todos',
                'cem' => 'Até R$ 100',
                'medio' => 'R$ 100 – R$ 500',
                'premium' => 'Premium',
                'lua' => 'Lua de Mel',
            ];
        @endphp
        <div class="mb-10">
            <div class="flex flex-wrap gap-2">
                @foreach($filters as $key => $label)
                    @php
                        $isActive = $activeFilter === $key;
                        $href = $key === 'todos'
                            ? route('gifts.index')
                            : route('gifts.index', ['filter' => $key]);
                    @endphp
                    <a
                        href="{{ $href }}"
                        class="font-sans text-sm px-5 py-2 rounded-full border transition-all duration-200 whitespace-nowrap
                            {{ $isActive ? 'bg-coastal text-black border-coastal' : 'bg-transparent text-ink-muted border-surface-border hover:border-coastal/50' }}"
                    >
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        @if(session('cart.added'))
            <div class="mb-6 px-5 py-3 border border-coastal/40 bg-coastal/5 text-coastal font-sans text-sm">
                Adicionado ao carrinho: {{ session('cart.added') }}
            </div>
        @endif

        @error('amount')
            <div class="mb-6 px-5 py-3 border border-red-700/40 bg-red-900/20 text-red-300 font-sans text-sm">
                {{ $message }}
            </div>
        @enderror

        {{-- Gift Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 pb-24">

            @forelse($gifts as $gift)
                <div class="bg-surface border border-surface-border overflow-hidden flex flex-col group" data-reveal @if($loop->index % 3 > 0) data-reveal-delay="{{ $loop->index % 3 }}" @endif>
                    @php
                        $imageUrl = $gift->image_url;
                    @endphp
                    <div
                        class="aspect-[4/3] bg-cover bg-center bg-surface-light transition-transform duration-500 group-hover:scale-[1.02]"
                        style="background-image: url('{{ $imageUrl }}')"
                    ></div>
                    <div class="p-5 flex flex-col flex-1 gap-4">
                        <div>
                            <h3 class="font-serif text-xl text-ink leading-snug mb-1">{{ $gift->name }}</h3>
                            @if($gift->description)
                                <p class="font-sans text-sm text-ink-muted leading-relaxed">
                                    {{ $gift->description }}
                                </p>
                            @endif
                        </div>
                        <div>
                            <div class="flex justify-between font-sans text-xs text-ink-muted mb-2">
                                <span>{{ $gift->progress_percentage }}% presenteado</span>
                                <span>R$ {{ number_format($gift->raised_cents / 100, 2, ',', '.') }} / R$ {{ number_format($gift->price_cents / 100, 2, ',', '.') }}</span>
                            </div>
                            <div class="h-1 w-full bg-surface-border overflow-hidden">
                                <div class="h-full bg-coastal" style="width: {{ $gift->progress_percentage }}%"></div>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-surface-border mt-auto">
                            @if($gift->isFullyFunded())
                                <div class="flex items-center justify-between gap-3">
                                    <span class="font-sans text-sm text-ink-muted">R$ {{ number_format($gift->price_cents / 100, 2, ',', '.') }}</span>
                                    <span class="font-sans text-xs uppercase tracking-widest text-coastal border border-coastal/40 px-3 py-1.5">
                                        Presenteado
                                    </span>
                                </div>
                            @else
                                <form method="POST" action="{{ route('cart.add', $gift) }}" class="flex flex-col gap-2.5">
                                    @csrf
                                    <div class="flex items-center gap-2.5">
                                        <div class="flex items-center flex-1 border border-surface-border bg-black focus-within:border-coastal/60 transition-colors duration-200">
                                            <span class="pl-3 font-sans text-xs text-ink-muted">R$</span>
                                            <input
                                                type="number"
                                                name="amount"
                                                step="0.01"
                                                min="{{ number_format(min(500, $gift->remaining_cents) / 100, 2, '.', '') }}"
                                                max="{{ number_format($gift->remaining_cents / 100, 2, '.', '') }}"
                                                value="{{ number_format($gift->remaining_cents / 100, 2, '.', '') }}"
                                                class="w-full bg-transparent font-sans text-sm text-ink px-2 py-2 outline-none"
                                                aria-label="Quanto contribuir para {{ $gift->name }}"
                                            />
                                        </div>
                                        <button
                                            type="submit"
                                            class="shrink-0 font-sans text-xs uppercase tracking-widest text-black bg-coastal hover:bg-coastal-dark transition-colors duration-200 px-4 py-2.5"
                                        >
                                            Contribuir
                                        </button>
                                    </div>
                                    <p class="font-sans text-xs text-ink-muted">
                                        Faltam R$ {{ number_format($gift->remaining_cents / 100, 2, ',', '.') }} — contribua com quanto puder.
                                    </p>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 font-sans text-ink-muted">
                    Nenhum presente encontrado para esse filtro.
                </div>
            @endforelse

        </div>
    </div>

    {{-- Sidebar Cart (xl only) --}}
    <aside class="hidden xl:flex flex-col w-[340px] shrink-0 sticky top-0 h-screen bg-surface border-l border-surface-border">

        {{-- Cart header --}}
        <div class="px-7 pt-28 pb-6 border-b border-surface-border">
            <p class="font-sans text-xs tracking-[0.2em] uppercase text-coastal mb-1">Seleção</p>
            <h2 class="font-serif text-2xl text-ink">Seu Carrinho</h2>
        </div>

        {{-- Cart items --}}
        <div class="flex-1 overflow-y-auto px-7 py-6 flex flex-col gap-5">
            @forelse($cart->items() as $item)
                @php
                    $g = $item['gift'];
                    $imageUrl = $g->image_url;
                @endphp
                <div class="flex gap-4 pb-5 border-b border-surface-border">
                    <div class="w-16 h-16 shrink-0 bg-cover bg-center" style="background-image: url('{{ $imageUrl }}')"></div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <p class="font-serif text-sm text-ink leading-snug">{{ $g->name }}</p>
                            <p class="font-sans text-xs text-ink-muted mt-0.5">
                                de R$ {{ number_format($g->price_cents / 100, 2, ',', '.') }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-sans text-sm text-coastal">R$ {{ number_format($item['amount_cents'] / 100, 2, ',', '.') }}</span>
                            <form method="POST" action="{{ route('cart.remove', $g) }}">
                                @csrf
                                <button class="font-sans text-xs text-ink-muted hover:text-coastal transition-colors">Remover</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="font-sans text-sm text-ink-muted">Seu carrinho está vazio. Escolha um presente para começar.</p>
            @endforelse
        </div>

        {{-- Cart footer --}}
        <div class="px-7 py-6 border-t border-surface-border">
            <div class="flex items-center justify-between mb-1">
                <span class="font-sans text-sm text-ink-muted">Subtotal</span>
                <span class="font-sans text-sm text-ink-light">R$ {{ number_format($cart->totalCents() / 100, 2, ',', '.') }}</span>
            </div>
            <div class="flex items-center justify-between mb-6">
                <span class="font-sans text-sm text-ink-light">Total</span>
                <span class="font-serif text-2xl text-ink">R$ {{ number_format($cart->totalCents() / 100, 2, ',', '.') }}</span>
            </div>
            @if(! $cart->isEmpty())
                <a
                    href="{{ route('donation.checkout') }}"
                    class="block w-full bg-coastal text-black font-sans text-sm text-center py-3.5 hover:bg-coastal-dark transition-colors duration-200"
                >
                    Continuar para pagamento
                </a>
            @else
                <span class="block w-full bg-surface-border text-ink-muted font-sans text-sm text-center py-3.5 cursor-not-allowed">
                    Continuar para pagamento
                </span>
            @endif
        </div>

    </aside>

</div>

{{-- Mobile floating cart button --}}
<div class="xl:hidden fixed bottom-6 right-6 z-50">
    <a
        href="{{ $cart->isEmpty() ? route('gifts.index') : route('donation.checkout') }}"
        class="w-14 h-14 rounded-full bg-coastal text-black shadow-lg shadow-coastal/20 flex items-center justify-center hover:bg-coastal-dark transition-colors duration-200 relative"
        aria-label="Ver carrinho"
    >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
        </svg>
        @if($cart->count() > 0)
            <span class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-black text-coastal text-xs font-sans flex items-center justify-center border border-coastal">
                {{ $cart->count() }}
            </span>
        @endif
    </a>
</div>
@endsection
