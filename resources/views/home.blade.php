@extends('layouts.app')

@section('title', 'Laura & Victor — 13 de Setembro, 2026')

@section('content')

{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="relative min-h-[100svh] flex flex-col items-center justify-center overflow-hidden">

    {{-- Background image --}}
    <div
        class="absolute inset-0 bg-center bg-cover"
        style="background-image: url('https://images.unsplash.com/photo-1519741497674-611481863552?w=1600&q=80')"
    ></div>

    {{-- Dark overlay --}}
    <div class="absolute inset-0 bg-black/60"></div>

    {{-- Content --}}
    <div class="relative z-10 flex flex-col items-center text-center px-6 py-32 gap-8">

        <p class="font-sans text-[10px] tracking-[0.4em] uppercase text-coastal">
            13 de Setembro, 2026
        </p>

        <div class="flex flex-col items-center gap-1">
            <h1 class="font-serif text-[clamp(4rem,14vw,10rem)] leading-none text-vanilla tracking-tight">
                Laura
            </h1>
            <span class="font-serif text-[clamp(2rem,6vw,5rem)] leading-none text-coastal italic">&amp;</span>
            <h1 class="font-serif text-[clamp(4rem,14vw,10rem)] leading-none text-vanilla tracking-tight">
                Victor
            </h1>
        </div>

        <div class="decorative-line w-24 my-2"></div>

        <p class="font-sans text-xs text-ink-muted tracking-[0.25em] uppercase">
            Joinville, Santa Catarina &ensp;&middot;&ensp; 16h30
        </p>

        {{-- Countdown --}}
        <div x-data="countdown()" x-init="start()" class="flex items-center gap-6 sm:gap-10 pt-2">
            <div class="flex flex-col items-center">
                <span x-text="days" class="font-serif text-4xl sm:text-5xl text-vanilla leading-none">0</span>
                <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-ink-muted mt-2">Dias</span>
            </div>
            <span class="text-surface-border text-2xl font-light">:</span>
            <div class="flex flex-col items-center">
                <span x-text="hours" class="font-serif text-4xl sm:text-5xl text-vanilla leading-none">0</span>
                <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-ink-muted mt-2">Horas</span>
            </div>
            <span class="text-surface-border text-2xl font-light">:</span>
            <div class="flex flex-col items-center">
                <span x-text="minutes" class="font-serif text-4xl sm:text-5xl text-vanilla leading-none">0</span>
                <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-ink-muted mt-2">Min</span>
            </div>
            <span class="text-surface-border text-2xl font-light">:</span>
            <div class="flex flex-col items-center">
                <span x-text="seconds" class="font-serif text-4xl sm:text-5xl text-coastal leading-none">0</span>
                <span class="font-sans text-[9px] tracking-[0.3em] uppercase text-ink-muted mt-2">Seg</span>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
            <a
                href="/presentes"
                class="font-sans text-xs tracking-[0.25em] uppercase px-9 py-4 border border-coastal text-coastal hover:bg-coastal hover:text-black transition-all duration-300"
            >
                Ver Lista de Presentes
            </a>
            <a
                href="/mensagens"
                class="font-sans text-xs tracking-[0.25em] uppercase px-9 py-4 bg-coastal text-black hover:bg-coastal-dark transition-all duration-300"
            >
                Deixar Mensagem
            </a>
        </div>

    </div>

    {{-- Scroll cue --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2">
        <div class="w-px h-14 bg-coastal/30 mx-auto"></div>
    </div>

</section>

{{-- ============================================================
     HOW IT WORKS
     ============================================================ --}}
<section class="py-28 bg-black" id="como-funciona">
    <div class="max-w-5xl mx-auto px-6">

        <div class="text-center mb-20">
            <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal mb-4">Simples e seguro</p>
            <h2 class="font-serif text-4xl md:text-5xl text-vanilla">Como Funciona</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6">

            {{-- Step 1 --}}
            <div class="bg-surface border border-surface-border p-10 flex flex-col gap-6">
                <div class="w-11 h-11 rounded-full border border-coastal flex items-center justify-center shrink-0">
                    <span class="font-serif text-lg text-coastal leading-none">1</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="font-serif text-xl text-vanilla">Escolha um Presente</h3>
                    <p class="font-sans text-sm text-ink-muted leading-relaxed">
                        Navegue pela nossa lista e encontre o presente que mais combina com voce e com o casal.
                    </p>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="bg-surface border border-surface-border p-10 flex flex-col gap-6">
                <div class="w-11 h-11 rounded-full border border-coastal flex items-center justify-center shrink-0">
                    <span class="font-serif text-lg text-coastal leading-none">2</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="font-serif text-xl text-vanilla">Pagamento Seguro</h3>
                    <p class="font-sans text-sm text-ink-muted leading-relaxed">
                        Contribua via Pix ou cartao de credito de forma rapida, segura e totalmente confiavel.
                    </p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="bg-surface border border-surface-border p-10 flex flex-col gap-6">
                <div class="w-11 h-11 rounded-full border border-coastal flex items-center justify-center shrink-0">
                    <span class="font-serif text-lg text-coastal leading-none">3</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="font-serif text-xl text-vanilla">Envie seu Carinho</h3>
                    <p class="font-sans text-sm text-ink-muted leading-relaxed">
                        Sua contribuicao chegara com uma mensagem especial que guardaremos para sempre.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     FEATURED GIFTS
     ============================================================ --}}
<section class="py-28 bg-black" id="lista">
    <div class="max-w-5xl mx-auto px-6">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="flex flex-col gap-3">
                <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal">Lista de Casamento</p>
                <h2 class="font-serif text-4xl md:text-5xl text-vanilla">Presentes em Destaque</h2>
            </div>
            <a
                href="/presentes"
                class="font-sans text-xs tracking-[0.2em] uppercase text-coastal hover:text-coastal-dark transition-colors group flex items-center gap-2 shrink-0"
            >
                Ver todos os presentes
                <span class="inline-block transition-transform duration-200 group-hover:translate-x-1">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-surface-border">
            <x-gift-card
                name="Jogo de Panelas"
                price="680,00"
                image="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&q=80"
                :percentage="75"
                amountRaised="510,00"
            />
            <x-gift-card
                name="Maquina de Cafe"
                price="1.200,00"
                image="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&q=80"
                :percentage="40"
                amountRaised="480,00"
            />
            <x-gift-card
                name="Enxoval de Cama"
                price="450,00"
                image="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80"
                :percentage="90"
                amountRaised="405,00"
            />
        </div>

        <div class="mt-12 text-center md:hidden">
            <a
                href="/presentes"
                class="font-sans text-xs tracking-[0.25em] uppercase px-9 py-4 border border-coastal text-coastal hover:bg-coastal hover:text-black transition-all duration-300 inline-block"
            >
                Ver todos os presentes
            </a>
        </div>

    </div>
</section>

{{-- ============================================================
     GALLERY — NOSSA HISTORIA
     ============================================================ --}}
<section class="py-28 bg-surface" id="nossa-historia">
    <div class="max-w-5xl mx-auto px-6">

        <div class="text-center mb-16">
            <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal mb-4">Um pouco sobre nos</p>
            <h2 class="font-serif text-4xl md:text-5xl text-vanilla">Nossa Historia</h2>
            <div class="decorative-line w-24 mx-auto mt-6"></div>
        </div>

        {{-- Masonry-like grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">

            {{-- Tall left image: spans 2 rows on md --}}
            <div class="relative col-span-1 md:row-span-2 overflow-hidden aspect-[3/4] md:aspect-auto">
                <img
                    src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=800&q=80"
                    alt="Aliancas de casamento"
                    class="absolute inset-0 w-full h-full object-cover"
                    loading="lazy"
                />
            </div>

            {{-- Wide top image --}}
            <div class="relative col-span-1 md:col-span-2 overflow-hidden aspect-video">
                <img
                    src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&q=80"
                    alt="Local do casamento"
                    class="absolute inset-0 w-full h-full object-cover"
                    loading="lazy"
                />
            </div>

            {{-- Small top-right image --}}
            <div class="relative col-span-1 overflow-hidden aspect-square">
                <img
                    src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&q=80"
                    alt="Casal"
                    class="absolute inset-0 w-full h-full object-cover"
                    loading="lazy"
                />
            </div>

            {{-- Wide bottom image --}}
            <div class="relative col-span-2 md:col-span-3 overflow-hidden aspect-video">
                <img
                    src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?w=800&q=80"
                    alt="Detalhes do casamento"
                    class="absolute inset-0 w-full h-full object-cover"
                    loading="lazy"
                />
            </div>

        </div>

    </div>
</section>

{{-- ============================================================
     CONTACT CTA
     ============================================================ --}}
<section class="py-28 bg-black" id="contato">
    <div class="max-w-3xl mx-auto px-6">

        <div class="bg-surface border border-surface-border p-10 md:p-16 flex flex-col gap-10">

            <div class="flex flex-col gap-3 text-center">
                <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal">Estamos aqui</p>
                <h2 class="font-serif text-4xl md:text-5xl text-vanilla">Alguma Duvida?</h2>
                <p class="font-sans text-sm text-ink-muted leading-relaxed max-w-md mx-auto">
                    Fique a vontade para nos enviar uma mensagem. Respondemos com carinho a cada pergunta.
                </p>
            </div>

            <form class="flex flex-col gap-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <label for="contact-name" class="font-sans text-[10px] tracking-[0.25em] uppercase text-ink-muted">
                            Nome
                        </label>
                        <input
                            id="contact-name"
                            type="text"
                            placeholder="Seu nome"
                            class="font-sans text-sm text-vanilla bg-transparent border border-surface-border px-4 py-3 focus:outline-none focus:border-coastal transition-colors placeholder:text-ink-muted/40"
                        />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="contact-email" class="font-sans text-[10px] tracking-[0.25em] uppercase text-ink-muted">
                            E-mail
                        </label>
                        <input
                            id="contact-email"
                            type="email"
                            placeholder="seu@email.com"
                            class="font-sans text-sm text-vanilla bg-transparent border border-surface-border px-4 py-3 focus:outline-none focus:border-coastal transition-colors placeholder:text-ink-muted/40"
                        />
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="contact-message" class="font-sans text-[10px] tracking-[0.25em] uppercase text-ink-muted">
                        Mensagem
                    </label>
                    <textarea
                        id="contact-message"
                        rows="5"
                        placeholder="Escreva sua mensagem..."
                        class="font-sans text-sm text-vanilla bg-transparent border border-surface-border px-4 py-3 focus:outline-none focus:border-coastal transition-colors resize-none placeholder:text-ink-muted/40"
                    ></textarea>
                </div>

                <div class="pt-1">
                    <button
                        type="submit"
                        class="font-sans text-xs tracking-[0.25em] uppercase px-10 py-4 bg-coastal text-black hover:bg-coastal-dark transition-all duration-300 w-full sm:w-auto"
                    >
                        Enviar Mensagem
                    </button>
                </div>

            </form>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
function countdown() {
    return {
        days: '00',
        hours: '00',
        minutes: '00',
        seconds: '00',
        start() {
            this.update();
            setInterval(() => this.update(), 1000);
        },
        update() {
            const wedding = new Date('2026-09-13T16:30:00-03:00').getTime();
            const now = Date.now();
            const diff = wedding - now;
            if (diff <= 0) {
                this.days = '00';
                this.hours = '00';
                this.minutes = '00';
                this.seconds = '00';
                return;
            }
            this.days = String(Math.floor(diff / 86400000)).padStart(2, '0');
            this.hours = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
            this.minutes = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
            this.seconds = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
        }
    }
}
</script>
@endpush
