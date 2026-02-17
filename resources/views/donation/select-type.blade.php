@extends('layouts.app')

@section('title', 'Gesto de Carinho - Ana & Lucas')

@section('content')
<div class="flex-grow flex items-center justify-center px-4 py-12 lg:py-20">
    <div class="max-w-[960px] w-full flex flex-col items-center">
        {{-- Welcome Text --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-5xl font-bold tracking-tight mb-4">Gesto de Carinho</h1>
            <p class="text-muted text-lg max-w-xl mx-auto leading-relaxed">
                Escolha o que preferir, qualquer valor ajuda. Sua presenca e carinho sao o que mais importam para nos.
            </p>
        </div>
        {{-- Split Cards Layout --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full">
            {{-- Choice 1: Items --}}
            <a class="group flex flex-col items-center p-10 bg-white dark:bg-white/5 border-2 border-transparent rounded-xl shadow-xl shadow-black/[0.03] text-center hover:-translate-y-1 hover:border-primary transition-all duration-300" href="/presentes">
                <div class="mb-8 p-6 bg-primary/10 rounded-full group-hover:bg-primary/20 transition-colors">
                    <span class="material-symbols-outlined text-primary text-5xl">redeem</span>
                </div>
                <h3 class="text-2xl font-bold mb-4">Escolher itens</h3>
                <p class="text-muted text-base leading-relaxed mb-8">
                    Navegue pela nossa lista de presentes e escolha algo especial que combine com nossa nova casa.
                </p>
                <div class="mt-auto inline-flex items-center gap-2 text-primary font-bold group-hover:translate-x-1 transition-transform">
                    Ver Lista Completa
                    <span class="material-symbols-outlined text-sm">arrow_forward_ios</span>
                </div>
            </a>
            {{-- Choice 2: Direct Donation --}}
            <a class="group flex flex-col items-center p-10 bg-white dark:bg-white/5 border-2 border-transparent rounded-xl shadow-xl shadow-black/[0.03] text-center hover:-translate-y-1 hover:border-primary transition-all duration-300" href="/doar/direto">
                <div class="mb-8 p-6 bg-primary/10 rounded-full group-hover:bg-primary/20 transition-colors">
                    <span class="material-symbols-outlined text-primary text-5xl">volunteer_activism</span>
                </div>
                <h3 class="text-2xl font-bold mb-4">Doacao direta</h3>
                <p class="text-muted text-base leading-relaxed mb-8">
                    Contribua com qualquer valor de forma rapida e segura via PIX ou cartao para nossa lua de mel.
                </p>
                <div class="mt-auto inline-flex items-center gap-2 text-primary font-bold group-hover:translate-x-1 transition-transform">
                    Doar Agora
                    <span class="material-symbols-outlined text-sm">arrow_forward_ios</span>
                </div>
            </a>
        </div>
        {{-- Trust Section --}}
        <div class="mt-16 flex flex-col items-center gap-4">
            <div class="flex items-center gap-3 text-xs uppercase tracking-widest text-muted font-semibold">
                <span class="material-symbols-outlined text-lg">shield_with_heart</span>
                Ambiente Seguro
            </div>
            <p class="text-muted text-sm mt-4">
                Pagamento 100% seguro processado via Asaas
            </p>
        </div>
    </div>
</div>
@endsection
