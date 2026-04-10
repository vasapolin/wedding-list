@extends('layouts.app')

@section('title', 'Lista de Presentes - Laura & Victor')

@section('content')
<div class="max-w-[1440px] mx-auto w-full xl:flex xl:items-start">

    {{-- Main content area --}}
    <div class="flex-1 px-6 lg:px-16 xl:pr-12 xl:border-r border-surface-border">

        {{-- Header --}}
        <header class="pt-28 pb-10">
            <p class="font-sans text-xs tracking-[0.2em] uppercase text-coastal mb-4">Laura &amp; Victor · 2026</p>
            <h1 class="font-serif text-5xl md:text-6xl text-ink leading-tight mb-4">Lista de Presentes</h1>
            <div class="decorative-line w-24 mb-6"></div>
            <p class="font-sans text-ink-muted text-base max-w-md leading-relaxed">
                Cada presente simboliza um pedaço do nosso sonho compartilhado. Obrigado por fazer parte deste momento.
            </p>
        </header>

        {{-- Filters --}}
        <div x-data="{ activeFilter: 'todos' }" class="mb-10">
            <div class="flex flex-wrap gap-2">
                <button
                    @click="activeFilter = 'todos'"
                    :class="activeFilter === 'todos' ? 'bg-coastal text-black border-coastal' : 'bg-transparent text-ink-muted border-surface-border hover:border-coastal/50'"
                    class="font-sans text-sm px-5 py-2 rounded-full border transition-all duration-200 whitespace-nowrap cursor-pointer"
                >
                    Todos
                </button>
                <button
                    @click="activeFilter = 'cem'"
                    :class="activeFilter === 'cem' ? 'bg-coastal text-black border-coastal' : 'bg-transparent text-ink-muted border-surface-border hover:border-coastal/50'"
                    class="font-sans text-sm px-5 py-2 rounded-full border transition-all duration-200 whitespace-nowrap cursor-pointer"
                >
                    Até R$ 100
                </button>
                <button
                    @click="activeFilter = 'medio'"
                    :class="activeFilter === 'medio' ? 'bg-coastal text-black border-coastal' : 'bg-transparent text-ink-muted border-surface-border hover:border-coastal/50'"
                    class="font-sans text-sm px-5 py-2 rounded-full border transition-all duration-200 whitespace-nowrap cursor-pointer"
                >
                    R$ 100 – R$ 500
                </button>
                <button
                    @click="activeFilter = 'premium'"
                    :class="activeFilter === 'premium' ? 'bg-coastal text-black border-coastal' : 'bg-transparent text-ink-muted border-surface-border hover:border-coastal/50'"
                    class="font-sans text-sm px-5 py-2 rounded-full border transition-all duration-200 whitespace-nowrap cursor-pointer"
                >
                    Premium
                </button>
                <button
                    @click="activeFilter = 'lua'"
                    :class="activeFilter === 'lua' ? 'bg-coastal text-black border-coastal' : 'bg-transparent text-ink-muted border-surface-border hover:border-coastal/50'"
                    class="font-sans text-sm px-5 py-2 rounded-full border transition-all duration-200 whitespace-nowrap cursor-pointer"
                >
                    Lua de Mel
                </button>
            </div>
        </div>

        {{-- Gift Cards Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 pb-24">

            {{-- Card 1: Kit de Panelas --}}
            <div class="bg-surface border border-surface-border overflow-hidden flex flex-col group">
                <div
                    class="aspect-[4/3] bg-cover bg-center transition-transform duration-500 group-hover:scale-[1.02]"
                    style="background-image: url('https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&q=80')"
                ></div>
                <div class="p-5 flex flex-col flex-1 gap-4">
                    <div>
                        <h3 class="font-serif text-xl text-ink leading-snug mb-1">Kit de Panelas Premium</h3>
                        <p class="font-sans text-sm text-ink-muted leading-relaxed">
                            Para cozinharmos juntos cada refeição do nosso novo lar.
                        </p>
                    </div>
                    <div>
                        <div class="flex justify-between font-sans text-xs text-ink-muted mb-2">
                            <span>75% presenteado</span>
                            <span>R$ 510 / R$ 680</span>
                        </div>
                        <div class="h-1 w-full bg-surface-border overflow-hidden">
                            <div class="h-full bg-coastal" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-surface-border mt-auto">
                        <span class="font-sans text-sm text-coastal">R$ 680,00</span>
                        <a href="/doar" class="font-sans text-sm text-ink-light hover:text-coastal transition-colors underline underline-offset-4 decoration-ink-muted/40 hover:decoration-coastal">
                            Contribuir
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card 2: Máquina de Café --}}
            <div class="bg-surface border border-surface-border overflow-hidden flex flex-col group">
                <div
                    class="aspect-[4/3] bg-cover bg-center transition-transform duration-500 group-hover:scale-[1.02]"
                    style="background-image: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&q=80')"
                ></div>
                <div class="p-5 flex flex-col flex-1 gap-4">
                    <div>
                        <h3 class="font-serif text-xl text-ink leading-snug mb-1">Máquina de Café Espresso</h3>
                        <p class="font-sans text-sm text-ink-muted leading-relaxed">
                            Nossos cafés da manhã merecem começar com perfeição.
                        </p>
                    </div>
                    <div>
                        <div class="flex justify-between font-sans text-xs text-ink-muted mb-2">
                            <span>40% presenteado</span>
                            <span>R$ 480 / R$ 1.200</span>
                        </div>
                        <div class="h-1 w-full bg-surface-border overflow-hidden">
                            <div class="h-full bg-coastal" style="width: 40%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-surface-border mt-auto">
                        <span class="font-sans text-sm text-coastal">R$ 1.200,00</span>
                        <a href="/doar" class="font-sans text-sm text-ink-light hover:text-coastal transition-colors underline underline-offset-4 decoration-ink-muted/40 hover:decoration-coastal">
                            Contribuir
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card 3: Enxoval de Cama --}}
            <div class="bg-surface border border-surface-border overflow-hidden flex flex-col group">
                <div
                    class="aspect-[4/3] bg-cover bg-center transition-transform duration-500 group-hover:scale-[1.02]"
                    style="background-image: url('https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80')"
                ></div>
                <div class="p-5 flex flex-col flex-1 gap-4">
                    <div>
                        <h3 class="font-serif text-xl text-ink leading-snug mb-1">Enxoval de Cama</h3>
                        <p class="font-sans text-sm text-ink-muted leading-relaxed">
                            Roupas de cama em algodão egípcio para noites de sonho.
                        </p>
                    </div>
                    <div>
                        <div class="flex justify-between font-sans text-xs text-ink-muted mb-2">
                            <span>90% presenteado</span>
                            <span>R$ 405 / R$ 450</span>
                        </div>
                        <div class="h-1 w-full bg-surface-border overflow-hidden">
                            <div class="h-full bg-coastal" style="width: 90%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-surface-border mt-auto">
                        <span class="font-sans text-sm text-coastal">R$ 450,00</span>
                        <a href="/doar" class="font-sans text-sm text-ink-light hover:text-coastal transition-colors underline underline-offset-4 decoration-ink-muted/40 hover:decoration-coastal">
                            Contribuir
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card 4: Dia de Spa --}}
            <div class="bg-surface border border-surface-border overflow-hidden flex flex-col group">
                <div
                    class="aspect-[4/3] bg-cover bg-center transition-transform duration-500 group-hover:scale-[1.02]"
                    style="background-image: url('https://images.unsplash.com/photo-1540555700478-4be289fbec6d?w=600&q=80')"
                ></div>
                <div class="p-5 flex flex-col flex-1 gap-4">
                    <div>
                        <h3 class="font-serif text-xl text-ink leading-snug mb-1">Dia de Spa para o Casal</h3>
                        <p class="font-sans text-sm text-ink-muted leading-relaxed">
                            Um momento de relaxamento pós-casamento para recarregarmos as energias.
                        </p>
                    </div>
                    <div>
                        <div class="flex justify-between font-sans text-xs text-ink-muted mb-2">
                            <span>15% presenteado</span>
                            <span>R$ 45 / R$ 300</span>
                        </div>
                        <div class="h-1 w-full bg-surface-border overflow-hidden">
                            <div class="h-full bg-coastal" style="width: 15%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-surface-border mt-auto">
                        <span class="font-sans text-sm text-coastal">R$ 300,00</span>
                        <a href="/doar" class="font-sans text-sm text-ink-light hover:text-coastal transition-colors underline underline-offset-4 decoration-ink-muted/40 hover:decoration-coastal">
                            Contribuir
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card 5: Adega dos Noivos --}}
            <div class="bg-surface border border-surface-border overflow-hidden flex flex-col group">
                <div
                    class="aspect-[4/3] bg-cover bg-center transition-transform duration-500 group-hover:scale-[1.02]"
                    style="background-image: url('https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?w=600&q=80')"
                ></div>
                <div class="p-5 flex flex-col flex-1 gap-4">
                    <div>
                        <h3 class="font-serif text-xl text-ink leading-snug mb-1">Adega dos Noivos</h3>
                        <p class="font-sans text-sm text-ink-muted leading-relaxed">
                            Ajude-nos a iniciar nossa coleção de vinhos para momentos especiais.
                        </p>
                    </div>
                    <div>
                        <div class="flex justify-between font-sans text-xs text-ink-muted mb-2">
                            <span>50% presenteado</span>
                            <span>R$ 250 / R$ 500</span>
                        </div>
                        <div class="h-1 w-full bg-surface-border overflow-hidden">
                            <div class="h-full bg-coastal" style="width: 50%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-surface-border mt-auto">
                        <span class="font-sans text-sm text-coastal">R$ 500,00</span>
                        <a href="/doar" class="font-sans text-sm text-ink-light hover:text-coastal transition-colors underline underline-offset-4 decoration-ink-muted/40 hover:decoration-coastal">
                            Contribuir
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card 6: Enxoval de Banho --}}
            <div class="bg-surface border border-surface-border overflow-hidden flex flex-col group">
                <div
                    class="aspect-[4/3] bg-cover bg-center transition-transform duration-500 group-hover:scale-[1.02]"
                    style="background-image: url('https://images.unsplash.com/photo-1584568694244-14fbdf83bd30?w=600&q=80')"
                ></div>
                <div class="p-5 flex flex-col flex-1 gap-4">
                    <div>
                        <h3 class="font-serif text-xl text-ink leading-snug mb-1">Enxoval de Banho</h3>
                        <p class="font-sans text-sm text-ink-muted leading-relaxed">
                            Toalhas felpudas e detalhes que farão nosso banheiro mais aconchegante.
                        </p>
                    </div>
                    <div>
                        <div class="flex justify-between font-sans text-xs text-ink-muted mb-2">
                            <span>85% presenteado</span>
                            <span>R$ 340 / R$ 400</span>
                        </div>
                        <div class="h-1 w-full bg-surface-border overflow-hidden">
                            <div class="h-full bg-coastal" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-surface-border mt-auto">
                        <span class="font-sans text-sm text-coastal">R$ 400,00</span>
                        <a href="/doar" class="font-sans text-sm text-ink-light hover:text-coastal transition-colors underline underline-offset-4 decoration-ink-muted/40 hover:decoration-coastal">
                            Contribuir
                        </a>
                    </div>
                </div>
            </div>

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

            {{-- Item 1 --}}
            <div class="flex gap-4 pb-5 border-b border-surface-border">
                <div
                    class="w-16 h-16 shrink-0 bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=200&q=80')"
                ></div>
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <p class="font-serif text-sm text-ink leading-snug">Kit de Panelas Premium</p>
                        <p class="font-sans text-xs text-ink-muted mt-0.5">1 cota</p>
                    </div>
                    <span class="font-sans text-sm text-coastal">R$ 100,00</span>
                </div>
            </div>

            {{-- Item 2 --}}
            <div class="flex gap-4 pb-5 border-b border-surface-border">
                <div
                    class="w-16 h-16 shrink-0 bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1540555700478-4be289fbec6d?w=200&q=80')"
                ></div>
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <p class="font-serif text-sm text-ink leading-snug">Dia de Spa para o Casal</p>
                        <p class="font-sans text-xs text-ink-muted mt-0.5">1 cota</p>
                    </div>
                    <span class="font-sans text-sm text-coastal">R$ 150,00</span>
                </div>
            </div>

        </div>

        {{-- Cart footer --}}
        <div class="px-7 py-6 border-t border-surface-border">
            <div class="flex items-center justify-between mb-1">
                <span class="font-sans text-sm text-ink-muted">Subtotal</span>
                <span class="font-sans text-sm text-ink-light">R$ 250,00</span>
            </div>
            <div class="flex items-center justify-between mb-6">
                <span class="font-sans text-sm text-ink-light">Total</span>
                <span class="font-serif text-2xl text-ink">R$ 250,00</span>
            </div>
            <a
                href="/doar"
                class="block w-full bg-coastal text-black font-sans text-sm text-center py-3.5 hover:bg-coastal-dark transition-colors duration-200"
            >
                Continuar para pagamento
            </a>
        </div>

    </aside>

</div>

{{-- Mobile floating cart button --}}
<div class="xl:hidden fixed bottom-6 right-6 z-50">
    <button
        class="w-14 h-14 rounded-full bg-coastal text-black shadow-lg shadow-coastal/20 flex items-center justify-center hover:bg-coastal-dark transition-colors duration-200"
        aria-label="Ver carrinho"
    >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
        </svg>
    </button>
</div>
@endsection
