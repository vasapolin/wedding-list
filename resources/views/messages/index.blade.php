@extends('layouts.app')

@section('title', 'Mural de Mensagens - Laura & Victor')

@section('content')

{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="relative pt-28 pb-0 h-[420px] flex flex-col items-center justify-center overflow-hidden">

    {{-- Background image --}}
    <div
        class="absolute inset-0 bg-center bg-cover"
        style="background-image: url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=1200&q=80')"
    ></div>

    {{-- Dark overlay --}}
    <div class="absolute inset-0 bg-black/60"></div>

    {{-- Content --}}
    <div class="relative z-10 flex flex-col items-center text-center px-6 gap-5">
        <p class="font-sans text-[10px] tracking-[0.4em] uppercase text-coastal">
            Laura & Victor — 13 de Setembro, 2026
        </p>
        <h1 class="font-serif text-5xl md:text-6xl lg:text-7xl text-white leading-tight">
            Mural de Mensagens
        </h1>
        <p class="font-sans text-sm text-white/70 max-w-md leading-relaxed">
            Compartilhe seus pensamentos e desejos para o casal neste dia tão especial.
        </p>
    </div>

</section>

{{-- ============================================================
     TWO-COLUMN LAYOUT
     ============================================================ --}}
<div class="bg-black py-20">
    <div class="mx-auto max-w-[1200px] px-6 grid grid-cols-1 lg:grid-cols-12 gap-10">

        {{-- ── LEFT SIDEBAR (col-span-4) ── --}}
        <div class="lg:col-span-4 flex flex-col gap-6">

            {{-- Message Form Card --}}
            <div class="bg-surface border border-surface-border p-8 flex flex-col gap-6">

                <div class="flex flex-col gap-1">
                    <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal">
                        Deixe sua marca
                    </p>
                    <h2 class="font-serif text-2xl text-vanilla">Escreva ao Casal</h2>
                </div>

                <form class="flex flex-col gap-5">

                    <div class="flex flex-col gap-2">
                        <label
                            class="font-sans text-[10px] tracking-[0.25em] uppercase text-ink-muted"
                            for="msg-name"
                        >
                            Seu Nome
                        </label>
                        <input
                            id="msg-name"
                            type="text"
                            placeholder="Como deseja ser identificado?"
                            class="w-full bg-surface-light border border-surface-border px-4 py-3 font-sans text-sm text-vanilla placeholder:text-ink-muted/50 focus:outline-none focus:border-coastal transition-colors"
                        />
                    </div>

                    <div class="flex flex-col gap-2">
                        <label
                            class="font-sans text-[10px] tracking-[0.25em] uppercase text-ink-muted"
                            for="msg-text"
                        >
                            Mensagem
                        </label>
                        <textarea
                            id="msg-text"
                            rows="5"
                            placeholder="Escreva algo carinhoso para Laura & Victor..."
                            class="w-full bg-surface-light border border-surface-border px-4 py-3 font-sans text-sm text-vanilla placeholder:text-ink-muted/50 focus:outline-none focus:border-coastal transition-colors resize-none"
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        class="w-full font-sans text-xs tracking-[0.25em] uppercase py-4 bg-coastal text-black hover:bg-coastal-dark transition-all duration-300"
                    >
                        Publicar Mensagem
                    </button>

                </form>
            </div>

            {{-- Quick Donation Widget --}}
            <div class="bg-surface-light border-2 border-dashed border-coastal p-8 flex flex-col gap-5">

                <div class="flex flex-col gap-1">
                    <h3 class="font-serif text-xl text-vanilla">Presentear o Casal</h3>
                    <p class="font-sans text-sm text-ink-muted leading-relaxed">
                        Contribua para nossa lua de mel com um valor especial.
                    </p>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    @foreach(['R$50', 'R$100', 'R$250'] as $amount)
                    <button
                        type="button"
                        class="bg-surface border border-surface-border hover:border-coastal font-sans text-sm font-semibold text-vanilla py-3 transition-colors duration-200"
                    >
                        {{ $amount }}
                    </button>
                    @endforeach
                </div>

                <a
                    href="/doar/direto"
                    class="font-sans text-xs tracking-[0.2em] uppercase text-coastal hover:text-coastal-dark transition-colors text-center"
                >
                    Valor Personalizado &rarr;
                </a>

            </div>

        </div>

        {{-- ── RIGHT: MESSAGE FEED (col-span-8) ── --}}
        <div class="lg:col-span-8 flex flex-col gap-8">

            {{-- Section Header --}}
            <div class="flex items-end justify-between">
                <div class="flex flex-col gap-1">
                    <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal">
                        Da nossa família e amigos
                    </p>
                    <h2 class="font-serif text-3xl md:text-4xl text-vanilla">Mensagens Recentes</h2>
                </div>
                <span class="font-sans text-xs text-ink-muted tracking-widest uppercase hidden sm:block">
                    Ordenar: Recentes
                </span>
            </div>

            <div class="flex flex-col gap-4">

                {{-- Card: Maria Mendes --}}
                <div class="bg-surface border border-surface-border p-6 flex items-start gap-5">
                    <div class="size-11 shrink-0 rounded-full bg-coastal/20 flex items-center justify-center">
                        <span class="font-sans text-xs font-bold text-coastal">MM</span>
                    </div>
                    <div class="flex-1 min-w-0 flex flex-col gap-3">
                        <div class="flex items-center justify-between gap-4">
                            <h4 class="font-serif text-lg text-vanilla">Maria Mendes</h4>
                            <span class="font-sans text-xs text-ink-muted shrink-0">2 horas atrás</span>
                        </div>
                        <p class="font-serif text-base text-ink-light italic leading-relaxed">
                            "Para o casal mais lindo que conheço — que a vida de vocês juntos seja tão radiante quanto o dia do casamento. Desejo infinitos anos de amor, risadas e aventuras compartilhadas."
                        </p>
                        <span class="font-sans text-xs text-ink-muted">12 Curtidas</span>
                    </div>
                </div>

                {{-- Card: João Pedro --}}
                <div class="bg-surface border border-surface-border p-6 flex items-start gap-5">
                    <div class="size-11 shrink-0 rounded-full bg-coastal/20 flex items-center justify-center">
                        <span class="font-sans text-xs font-bold text-coastal">JP</span>
                    </div>
                    <div class="flex-1 min-w-0 flex flex-col gap-3">
                        <div class="flex items-center justify-between gap-4">
                            <h4 class="font-serif text-lg text-vanilla">João Pedro</h4>
                            <span class="font-sans text-xs text-ink-muted shrink-0">5 horas atrás</span>
                        </div>
                        <p class="font-serif text-base text-ink-light italic leading-relaxed">
                            "Que a jornada de vocês seja repleta de cumplicidade e alegria. Estou muito feliz por fazer parte deste momento tão especial!"
                        </p>
                        <span class="font-sans text-xs text-ink-muted">7 Curtidas</span>
                    </div>
                </div>

                {{-- Card: Família Silva --}}
                <div class="bg-surface border border-surface-border p-6 flex items-start gap-5">
                    <div class="size-11 shrink-0 rounded-full bg-coastal/20 flex items-center justify-center">
                        <span class="font-sans text-xs font-bold text-coastal">FS</span>
                    </div>
                    <div class="flex-1 min-w-0 flex flex-col gap-3">
                        <div class="flex items-center justify-between gap-4">
                            <h4 class="font-serif text-lg text-vanilla">Família Silva</h4>
                            <span class="font-sans text-xs text-ink-muted shrink-0">Ontem</span>
                        </div>
                        <p class="font-serif text-base text-ink-light italic leading-relaxed">
                            "Tão felizes por vocês dois. Acompanhamos vocês crescerem juntos e tem sido uma alegria imensa. Lembrem-se sempre de reservar tempo para os encontros a dois!"
                        </p>
                        <span class="font-sans text-xs text-ink-muted">8 Curtidas</span>
                    </div>
                </div>

                {{-- Card: Camila Oliveira --}}
                <div class="bg-surface border border-surface-border p-6 flex items-start gap-5">
                    <div class="size-11 shrink-0 rounded-full bg-coastal/20 flex items-center justify-center">
                        <span class="font-sans text-xs font-bold text-coastal">CO</span>
                    </div>
                    <div class="flex-1 min-w-0 flex flex-col gap-3">
                        <div class="flex items-center justify-between gap-4">
                            <h4 class="font-serif text-lg text-vanilla">Camila Oliveira</h4>
                            <span class="font-sans text-xs text-ink-muted shrink-0">Ontem</span>
                        </div>
                        <p class="font-serif text-base text-ink-light italic leading-relaxed">
                            "Parabéns! Que o lar de vocês seja sempre cheio de alegria, carinho e aconchego."
                        </p>
                        <span class="font-sans text-xs text-ink-muted">5 Curtidas</span>
                    </div>
                </div>

            </div>

            {{-- Ver Mais --}}
            <div class="pt-2 text-center">
                <button
                    type="button"
                    class="font-sans text-xs tracking-[0.25em] uppercase px-9 py-4 border border-surface-border text-ink-light hover:border-coastal hover:text-coastal transition-all duration-300"
                >
                    Ver Mais Mensagens
                </button>
            </div>

        </div>

    </div>
</div>

@endsection
