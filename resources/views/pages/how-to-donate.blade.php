@extends('layouts.app')

@section('title', 'Como Doar - Ana & Lucas')

@section('content')
{{-- Hero Section --}}
<section class="max-w-[1200px] mx-auto px-6 lg:px-10 py-16 md:py-24">
    <div class="flex flex-col lg:flex-row gap-12 items-center">
        <div class="flex-1 flex flex-col gap-6">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider w-fit">
                <span class="material-symbols-outlined text-sm">info</span> Guia de Contribuicao
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight tracking-tight">
                Como presentear <br/><span class="text-primary">os noivos</span>
            </h1>
            <p class="text-lg text-gray-500 dark:text-gray-400 leading-relaxed max-w-xl">
                Sua contribuicao e o comeco da nossa nova historia. Criamos um sistema simples e seguro para que voce possa participar deste momento de forma pratica.
            </p>
            <div class="flex gap-4 pt-4">
                <a href="/doar" class="bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:shadow-lg transition-all flex items-center gap-2">
                    Ir para doacao <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>
        </div>
        <div class="flex-1 w-full">
            <div class="relative">
                <div class="w-full aspect-square bg-cover bg-center rounded-3xl shadow-2xl overflow-hidden" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBzRaLkUYn_P2LSLOeWvAIXdHVYkzkMzMbaZowjASYjX0gLdkMDujVUmQHoeX5uHhb0nTCLyL9cBPpwsRIIpDz_3Kn01EJvHrbWPN7vAMLLIIPEz0SVOkmx7uJJnEgW9GIohiK4i91GyR0vEcCJiGTsABX9XAgR3sUlvgNTvG0-KhuodKDbXAxhiwqmG-UE40UC5A9LEX7KsZogj46BObhWai3y_bisRT_mkHVvPAi1ClpNjJxoPDYmbSyTdUzF8tgU_zWwDh4YPAKp')"></div>
                <div class="absolute -bottom-6 -left-6 bg-white dark:bg-background-dark p-6 rounded-2xl shadow-xl flex items-center gap-4 border border-[#eee] dark:border-[#333]">
                    <div class="bg-green-100 p-3 rounded-full text-green-600">
                        <span class="material-symbols-outlined">verified_user</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Ambiente Seguro</p>
                        <p class="font-bold dark:text-white">Pagamento via Asaas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Process Steps --}}
<section class="bg-white dark:bg-[#1a1710] py-20 border-y border-[#eee] dark:border-[#333]">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold dark:text-white mb-4">O passo a passo e simples</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="flex flex-col items-center text-center group">
                <div class="size-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">list_alt</span>
                </div>
                <h3 class="text-xl font-bold mb-3 dark:text-white">1. Escolha</h3>
                <p class="text-gray-500 dark:text-gray-400">Navegue pela nossa lista e escolha um item simbolico ou defina um valor livre.</p>
            </div>
            <div class="flex flex-col items-center text-center group">
                <div class="size-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">credit_score</span>
                </div>
                <h3 class="text-xl font-bold mb-3 dark:text-white">2. Pagamento</h3>
                <p class="text-gray-500 dark:text-gray-400">Pague com seguranca via Pix ou Cartao de Credito atraves da plataforma Asaas.</p>
            </div>
            <div class="flex flex-col items-center text-center group">
                <div class="size-16 rounded-2xl bg-primary/10 text-primary flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">celebration</span>
                </div>
                <h3 class="text-xl font-bold mb-3 dark:text-white">3. Pronto!</h3>
                <p class="text-gray-500 dark:text-gray-400">Nos recebemos o valor e voce pode deixar uma mensagem especial para nos.</p>
            </div>
        </div>
    </div>
</section>

{{-- Gift Types Comparison --}}
<section class="py-24 max-w-[1200px] mx-auto px-6">
    <div class="flex flex-col md:flex-row gap-8">
        {{-- Symbolic Gift --}}
        <div class="flex-1 bg-white dark:bg-[#1a1710] rounded-3xl p-8 shadow-sm hover:shadow-md transition-all border border-[#eee] dark:border-[#333] flex flex-col">
            <div class="h-48 w-full bg-gray-100 dark:bg-gray-800 rounded-2xl mb-6 overflow-hidden">
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBTwqvxc_WMb2dE9Ejp8lhs-5EXvy7DxB-KpSzuzNrrPLBiw7DqcbFmkxbxUwtLDOAa0V5pkWIEgG8rspzeXS4jdu7Sg62m3_WAryGgpsTJ-BhgLuvhlQEVZvKe_oAloSiloyFcpiv58bpl6MOuhpSsZZ4E9bO9l647WYF83GmoAJ1jIKBvC4SbUytwqP8AfD19_7XTGFfuKV03db7qOJosPgYXkFC8-a_gs49D4SoCWlxWobKtyuTOQ-UcfQI0hIeC4lLba6BK8WtU')"></div>
            </div>
            <h3 class="text-2xl font-bold mb-4 dark:text-white">Presentes Simbolicos</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-8 flex-grow">
                Itens como "Um jantar em Paris" ou "Diaria em hotel" sao ilustrativos. O valor do presente e convertido em saldo para realizarmos nossos sonhos.
            </p>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                    <span class="material-symbols-outlined text-primary text-sm">check_circle</span> Itens a partir de R$ 50,00
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                    <span class="material-symbols-outlined text-primary text-sm">check_circle</span> Diversas opcoes divertidas
                </li>
            </ul>
            <a href="/presentes" class="block w-full text-center py-4 rounded-xl border-2 border-primary text-primary font-bold hover:bg-primary hover:text-white transition-all">Ver Lista de Presentes</a>
        </div>
        {{-- Direct Donation --}}
        <div class="flex-1 bg-[#181611] rounded-3xl p-8 shadow-2xl flex flex-col text-white">
            <div class="h-48 w-full bg-primary/20 rounded-2xl mb-6 overflow-hidden flex items-center justify-center">
                <span class="material-symbols-outlined text-6xl text-primary">payments</span>
            </div>
            <h3 class="text-2xl font-bold mb-4">Contribuicao Flexivel</h3>
            <p class="text-gray-400 mb-8 flex-grow">
                Prefere praticidade total? Voce pode contribuir com qualquer valor diretamente para nossa conta conjunta, sem precisar escolher um item especifico.
            </p>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-2 text-sm text-gray-300">
                    <span class="material-symbols-outlined text-primary text-sm">check_circle</span> Defina o valor que desejar
                </li>
                <li class="flex items-center gap-2 text-sm text-gray-300">
                    <span class="material-symbols-outlined text-primary text-sm">check_circle</span> Confirmacao imediata via Pix
                </li>
            </ul>
            <a href="/doar/direto" class="block w-full text-center py-4 rounded-xl bg-primary text-[#181611] font-bold hover:brightness-110 transition-all">Contribuir com Valor Livre</a>
        </div>
    </div>
</section>

{{-- Security Banner --}}
<section class="max-w-[1200px] mx-auto px-6 mb-24">
    <div class="bg-primary/10 rounded-3xl p-10 flex flex-col md:flex-row items-center gap-10 border border-primary/20">
        <div class="flex-1">
            <h3 class="text-2xl font-bold mb-4 dark:text-white">Pagamento Seguro com Asaas</h3>
            <p class="text-gray-600 dark:text-gray-300">
                Utilizamos a tecnologia da <strong>Asaas</strong>, uma das maiores processadoras de pagamento do Brasil. Seus dados estao protegidos por criptografia de ponta a ponta.
            </p>
        </div>
        <div class="flex gap-6 items-center flex-wrap justify-center">
            <div class="flex flex-col items-center opacity-70 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-4xl mb-1 dark:text-white">qr_code_2</span>
                <span class="text-[10px] font-bold tracking-widest uppercase dark:text-white">Pix</span>
            </div>
            <div class="flex flex-col items-center opacity-70 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-4xl mb-1 dark:text-white">credit_card</span>
                <span class="text-[10px] font-bold tracking-widest uppercase dark:text-white">Cartao</span>
            </div>
            <div class="h-10 w-px bg-gray-300 dark:bg-gray-700 hidden md:block"></div>
            <div class="flex flex-col items-center">
                <span class="material-symbols-outlined text-4xl mb-1 text-green-500">lock</span>
                <span class="text-[10px] font-bold tracking-widest uppercase dark:text-white">SSL Seguro</span>
            </div>
        </div>
    </div>
</section>

{{-- FAQ Section --}}
<section class="max-w-[800px] mx-auto px-6 pb-24" x-data="{ openFaq: null }">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold dark:text-white mb-4">Duvidas Frequentes</h2>
        <p class="text-gray-500 dark:text-gray-400">Tudo o que voce precisa saber para presentear com tranquilidade.</p>
    </div>
    <div class="space-y-4">
        @php
        $faqs = [
            ['q' => 'Posso enviar uma mensagem junto ao presente?', 'a' => 'Sim! Apos a confirmacao do pagamento, voce tera um espaco dedicado para escrever uma mensagem especial para o casal. Nos leremos todas com muito carinho.'],
            ['q' => 'A doacao pode ser anonima?', 'a' => 'Sim, no momento do checkout voce pode optar por ocultar seu nome da lista publica de presentes. No entanto, nos (os noivos) sempre saberemos quem nos presenteou para podermos agradecer.'],
            ['q' => 'Como vou saber se o pagamento deu certo?', 'a' => 'Assim que o pagamento for processado pelo Asaas (instantaneo no Pix, alguns minutos no cartao), voce recebera um e-mail de confirmacao.'],
            ['q' => 'Os noivos recebem o produto fisico?', 'a' => 'Nao. Todos os itens na lista sao simbolicos. Nos recebemos o valor em dinheiro para que possamos organizar nossa casa e viagem da forma que for mais conveniente.'],
        ];
        @endphp
        @foreach($faqs as $i => $faq)
        <div class="border border-[#eee] dark:border-[#333] rounded-2xl bg-white dark:bg-[#1a1710] overflow-hidden">
            <button @click="openFaq === {{ $i }} ? openFaq = null : openFaq = {{ $i }}" class="flex items-center justify-between p-6 cursor-pointer w-full text-left">
                <h4 class="font-bold dark:text-white">{{ $faq['q'] }}</h4>
                <span class="material-symbols-outlined transition-transform duration-300 dark:text-white" :class="openFaq === {{ $i }} ? 'rotate-180' : ''">expand_more</span>
            </button>
            <div x-show="openFaq === {{ $i }}" x-collapse x-cloak class="px-6 pb-6 text-gray-500 dark:text-gray-400">
                {{ $faq['a'] }}
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
