@extends('layouts.app')

@section('title', 'Como Presentear - Laura & Victor')

@section('content')

{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="pt-28 pb-20 px-6 lg:px-10 bg-black">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col lg:flex-row items-center gap-16">

            {{-- Left: Text --}}
            <div class="flex-1 flex flex-col gap-8">
                <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal">
                    Guia de Presentear
                </p>

                <h1 class="font-serif text-5xl md:text-6xl lg:text-7xl font-light leading-tight text-vanilla">
                    Como presentear<br>
                    <em class="text-coastal not-italic">os noivos</em>
                </h1>

                <p class="font-sans text-sm text-ink-light leading-relaxed max-w-md">
                    Criamos um sistema simples e seguro para que voce possa participar deste momento especial de forma pratica e cheia de carinho.
                </p>

                <div class="pt-2">
                    <a
                        href="/presentes"
                        class="inline-block font-sans text-xs tracking-[0.25em] uppercase px-9 py-4 bg-coastal text-black hover:bg-coastal-dark transition-all duration-300"
                    >
                        Ver Lista de Presentes
                    </a>
                </div>
            </div>

            {{-- Right: Stock image --}}
            <div class="flex-1 w-full max-w-lg lg:max-w-none">
                <div class="relative overflow-hidden rounded-sm aspect-[4/5]">
                    <img
                        src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=800&q=80"
                        alt="Casamento Laura e Victor"
                        class="absolute inset-0 w-full h-full object-cover"
                        loading="eager"
                    />
                    <div class="absolute inset-0 bg-black/20"></div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Decorative line --}}
<div class="max-w-5xl mx-auto px-6 lg:px-10">
    <div class="decorative-line"></div>
</div>

{{-- ============================================================
     PROCESS STEPS
     ============================================================ --}}
<section class="py-28 px-6 lg:px-10 bg-surface">
    <div class="max-w-5xl mx-auto">

        <div class="text-center mb-20">
            <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal mb-4">Passo a Passo</p>
            <h2 class="font-serif text-4xl md:text-5xl font-light text-vanilla">
                Como funciona
            </h2>
            <div class="decorative-line w-24 mx-auto mt-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Step 1 --}}
            <div class="bg-black border border-surface-border p-10 flex flex-col gap-6">
                <div class="w-11 h-11 rounded-full border border-coastal flex items-center justify-center shrink-0">
                    <span class="font-serif text-lg text-coastal leading-none">1</span>
                </div>
                <div class="flex flex-col gap-3">
                    <h3 class="font-serif text-2xl font-light text-vanilla">Escolha</h3>
                    <p class="font-sans text-sm text-ink-muted leading-relaxed">
                        Navegue pela nossa lista e selecione um item simbolico que queira oferecer ao casal. Cada presente representa um sonho.
                    </p>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="bg-black border border-surface-border p-10 flex flex-col gap-6">
                <div class="w-11 h-11 rounded-full border border-coastal flex items-center justify-center shrink-0">
                    <span class="font-serif text-lg text-coastal leading-none">2</span>
                </div>
                <div class="flex flex-col gap-3">
                    <h3 class="font-serif text-2xl font-light text-vanilla">Pagamento</h3>
                    <p class="font-sans text-sm text-ink-muted leading-relaxed">
                        Pague com seguranca via Pix ou Cartao de Credito atraves da plataforma Asaas. Rapido, confiavel e sem complicacoes.
                    </p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="bg-black border border-surface-border p-10 flex flex-col gap-6">
                <div class="w-11 h-11 rounded-full border border-coastal flex items-center justify-center shrink-0">
                    <span class="font-serif text-lg text-coastal leading-none">3</span>
                </div>
                <div class="flex flex-col gap-3">
                    <h3 class="font-serif text-2xl font-light text-vanilla">Pronto!</h3>
                    <p class="font-sans text-sm text-ink-muted leading-relaxed">
                        Confirmacao imediata. Voce ainda pode deixar uma mensagem carinhosa que guardaremos para sempre.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Decorative line --}}
<div class="max-w-5xl mx-auto px-6 lg:px-10">
    <div class="decorative-line"></div>
</div>

{{-- ============================================================
     COMPARISON CARDS
     ============================================================ --}}
<section class="py-28 px-6 lg:px-10 bg-black">
    <div class="max-w-5xl mx-auto">

        <div class="text-center mb-20">
            <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal mb-4">Duas opcoes</p>
            <h2 class="font-serif text-4xl md:text-5xl font-light text-vanilla">
                Escolha sua forma de presentear
            </h2>
        </div>

        <div class="flex flex-col md:flex-row gap-6">

            {{-- Presentes Simbolicos --}}
            <div class="flex-1 bg-surface border border-surface-border flex flex-col overflow-hidden">
                <div class="relative overflow-hidden aspect-video">
                    <img
                        src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&q=80"
                        alt="Presentes Simbolicos"
                        class="absolute inset-0 w-full h-full object-cover"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-black/30"></div>
                </div>
                <div class="flex flex-col flex-1 gap-6 p-8">
                    <div class="flex flex-col gap-2">
                        <p class="font-sans text-[10px] tracking-[0.3em] uppercase text-coastal">Opcao 01</p>
                        <h3 class="font-serif text-3xl font-light text-vanilla">Presentes Simbolicos</h3>
                    </div>
                    <p class="font-sans text-sm text-ink-muted leading-relaxed">
                        Itens como "Jantar em Lisboa" ou "Diaria em hotel" sao ilustrativos. O valor e convertido em saldo para realizarmos nossos sonhos juntos.
                    </p>
                    <ul class="flex flex-col gap-3">
                        <li class="flex items-start gap-3 font-sans text-sm text-ink-light">
                            <span class="mt-1.5 size-1.5 rounded-full bg-coastal shrink-0"></span>
                            Itens a partir de R$ 50,00
                        </li>
                        <li class="flex items-start gap-3 font-sans text-sm text-ink-light">
                            <span class="mt-1.5 size-1.5 rounded-full bg-coastal shrink-0"></span>
                            Diversas opcoes tematicas e romanticas
                        </li>
                        <li class="flex items-start gap-3 font-sans text-sm text-ink-light">
                            <span class="mt-1.5 size-1.5 rounded-full bg-coastal shrink-0"></span>
                            Progresso visivel na lista de presentes
                        </li>
                    </ul>
                    <div class="mt-auto pt-4">
                        <a
                            href="/presentes"
                            class="inline-block font-sans text-xs tracking-[0.25em] uppercase px-7 py-3 border border-coastal text-coastal hover:bg-coastal hover:text-black transition-all duration-300"
                        >
                            Ver Lista de Presentes
                        </a>
                    </div>
                </div>
            </div>

            {{-- Contribuicao Flexivel --}}
            <div class="flex-1 bg-coastal flex flex-col overflow-hidden">
                <div class="aspect-video bg-coastal-dark/60 flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 flex flex-col items-center justify-center gap-3">
                        <div class="w-24 h-px bg-black/20"></div>
                        <p class="font-serif text-4xl text-black/20 font-light">R$</p>
                        <div class="w-24 h-px bg-black/20"></div>
                    </div>
                </div>
                <div class="flex flex-col flex-1 gap-6 p-8">
                    <div class="flex flex-col gap-2">
                        <p class="font-sans text-[10px] tracking-[0.3em] uppercase text-black/50">Opcao 02</p>
                        <h3 class="font-serif text-3xl font-light text-black">Contribuicao Flexivel</h3>
                    </div>
                    <p class="font-sans text-sm text-black/60 leading-relaxed">
                        Prefere praticidade total? Contribua com qualquer valor diretamente, sem precisar escolher um item especifico da lista.
                    </p>
                    <ul class="flex flex-col gap-3">
                        <li class="flex items-start gap-3 font-sans text-sm text-black/70">
                            <span class="mt-1.5 size-1.5 rounded-full bg-black/50 shrink-0"></span>
                            Defina o valor que desejar
                        </li>
                        <li class="flex items-start gap-3 font-sans text-sm text-black/70">
                            <span class="mt-1.5 size-1.5 rounded-full bg-black/50 shrink-0"></span>
                            Confirmacao imediata via Pix
                        </li>
                        <li class="flex items-start gap-3 font-sans text-sm text-black/70">
                            <span class="mt-1.5 size-1.5 rounded-full bg-black/50 shrink-0"></span>
                            100% seguro via plataforma Asaas
                        </li>
                    </ul>
                    <div class="mt-auto pt-4">
                        <a
                            href="/doar"
                            class="inline-block font-sans text-xs tracking-[0.25em] uppercase px-7 py-3 bg-black text-vanilla hover:bg-surface-light transition-all duration-300"
                        >
                            Contribuir com Valor Livre
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Decorative line --}}
<div class="max-w-5xl mx-auto px-6 lg:px-10">
    <div class="decorative-line"></div>
</div>

{{-- ============================================================
     FAQ
     ============================================================ --}}
<section class="py-28 px-6 lg:px-10 bg-black" x-data="{ openFaq: null }">
    <div class="max-w-2xl mx-auto">

        <div class="text-center mb-16">
            <p class="font-sans text-[10px] tracking-[0.35em] uppercase text-coastal mb-4">Duvidas</p>
            <h2 class="font-serif text-4xl md:text-5xl font-light text-vanilla">
                Perguntas Frequentes
            </h2>
            <div class="decorative-line w-24 mx-auto mt-6"></div>
        </div>

        @php
        $faqs = [
            [
                'q' => 'Posso enviar uma mensagem junto ao presente?',
                'a' => 'Sim! Apos a confirmacao do pagamento, voce tera um espaco dedicado para escrever uma mensagem especial para o casal. Leremos cada uma delas com muito carinho.',
            ],
            [
                'q' => 'A doacao pode ser anonima?',
                'a' => 'Sim. No momento do checkout voce pode optar por nao exibir seu nome na lista publica de presentes. Mesmo assim, nos (os noivos) sempre saberemos quem nos presenteou para podermos agradecer pessoalmente.',
            ],
            [
                'q' => 'Como saberei se o pagamento foi confirmado?',
                'a' => 'Assim que o pagamento for processado pela Asaas — instantaneo no Pix, alguns minutos no cartao — voce recebera um e-mail de confirmacao com todos os detalhes.',
            ],
            [
                'q' => 'Os noivos recebem o produto fisico?',
                'a' => 'Nao. Todos os itens da lista sao simbolicos. Recebemos o valor em dinheiro para organizar nossa casa e nossa lua de mel da forma que for mais conveniente para nos.',
            ],
        ];
        @endphp

        <div class="flex flex-col">
            @foreach($faqs as $i => $faq)
            <div
                class="border-b border-surface-border {{ $i === 0 ? 'border-t' : '' }}"
            >
                <button
                    @click="openFaq === {{ $i }} ? openFaq = null : openFaq = {{ $i }}"
                    class="flex items-center justify-between w-full py-6 text-left gap-8 cursor-pointer group"
                    type="button"
                >
                    <span
                        class="font-serif text-xl font-light transition-colors duration-200"
                        :class="openFaq === {{ $i }} ? 'text-coastal' : 'text-vanilla group-hover:text-coastal'"
                    >
                        {{ $faq['q'] }}
                    </span>
                    <span
                        class="font-serif text-2xl font-light text-coastal shrink-0 transition-transform duration-300 leading-none"
                        :class="openFaq === {{ $i }} ? 'rotate-45' : ''"
                    >
                        +
                    </span>
                </button>
                <div
                    x-show="openFaq === {{ $i }}"
                    x-collapse
                    x-cloak
                >
                    <p class="font-sans text-sm text-ink-muted leading-relaxed pb-6">
                        {{ $faq['a'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection
