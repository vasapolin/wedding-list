@extends('layouts.app')

@section('title', 'Mural de Mensagens - Ana & Lucas')

@section('content')
<div class="mx-auto w-full max-w-[1200px] px-6 py-10">
    {{-- Hero Section --}}
    <div class="relative mb-12 overflow-hidden rounded-xl bg-cover bg-center p-12 text-center" style='background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuBIABzo2m1GsZ8lnAaubt01-MlbA1RRxKJB7xWIsnIO0LB9gpJCohmFkxCH72iac8kW7q9sR5LCqIkUCcE_5avCBtJcdwoArGFbE-jjxVETaKPvBsPfwI_1Oc3NoqFzElmqgT9Ct2Qd9N1HFRUGUIzJ3uhhdRM69E56HeebO2Uy9dWToh36iyX8Bv0fXyjiaxMapbkeTIP_Py2-MlR52pId8wpEGmj6WpKbm6wz5CvRQYIBH8P4DCZmvCGwc_8zFOr1HaEgUfPavYhc");'>
        <div class="relative z-10 flex flex-col items-center gap-4">
            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-bold tracking-widest uppercase rounded-full">Mural</span>
            <h1 class="text-4xl md:text-6xl font-black text-white leading-tight">Mural de Mensagens</h1>
            <p class="max-w-2xl text-lg text-white/90 font-medium">
                Obrigado por fazer parte da nossa historia. Seu amor e apoio significam o mundo para nos. Compartilhe seus pensamentos e desejos abaixo.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        {{-- Left Sidebar: Forms --}}
        <div class="lg:col-span-4 flex flex-col gap-8">
            {{-- Message Form Card --}}
            <div class="bg-white dark:bg-[#2d281a] p-8 rounded-xl border border-[#e5e3dc] dark:border-[#3d382d] shadow-sm">
                <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit_note</span>
                    Deixe uma Mensagem
                </h3>
                <form class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold opacity-70">Seu Nome</label>
                        <input class="w-full rounded-lg border-[#e5e3dc] dark:border-[#3d382d] bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary py-3" placeholder="Seu nome completo" type="text"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold opacity-70">Mensagem</label>
                        <textarea class="w-full rounded-lg border-[#e5e3dc] dark:border-[#3d382d] bg-background-light dark:bg-background-dark focus:border-primary focus:ring-primary py-3" placeholder="Escreva algo carinhoso para o casal..." rows="4"></textarea>
                    </div>
                    <button class="w-full bg-primary text-white font-bold py-3 rounded-lg hover:shadow-lg transition-all flex items-center justify-center gap-2" type="submit">
                        Publicar Mensagem
                        <span class="material-symbols-outlined text-sm">send</span>
                    </button>
                </form>
            </div>
            {{-- Donation Quick Widget --}}
            <div class="bg-primary/10 dark:bg-primary/5 p-8 rounded-xl border-2 border-dashed border-primary/30 relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 text-primary/10 rotate-12">
                    <span class="material-symbols-outlined text-9xl">redeem</span>
                </div>
                <h3 class="text-xl font-bold mb-2">Lista & Doacao</h3>
                <p class="text-sm opacity-80 mb-6">Contribua diretamente para nossa lua de mel via pagamento seguro Asaas.</p>
                <div class="grid grid-cols-3 gap-3 mb-6">
                    <button class="bg-white dark:bg-[#2d281a] border border-[#e5e3dc] dark:border-[#3d382d] py-2 rounded-lg font-bold text-sm hover:border-primary transition-colors">R$ 50</button>
                    <button class="bg-white dark:bg-[#2d281a] border border-[#e5e3dc] dark:border-[#3d382d] py-2 rounded-lg font-bold text-sm hover:border-primary transition-colors">R$ 100</button>
                    <button class="bg-white dark:bg-[#2d281a] border border-[#e5e3dc] dark:border-[#3d382d] py-2 rounded-lg font-bold text-sm hover:border-primary transition-colors">R$ 250</button>
                </div>
                <a href="/doar/direto" class="block w-full text-center bg-primary text-white font-bold py-3 rounded-lg hover:bg-primary/90 transition-all">
                    Doar Valor Personalizado
                </a>
            </div>
        </div>

        {{-- Right: The Message Feed --}}
        <div class="lg:col-span-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold">Mensagens Recentes</h2>
                <div class="flex items-center gap-2 text-sm font-medium opacity-60">
                    <span class="material-symbols-outlined text-base">filter_list</span>
                    Ordenar por: Recentes
                </div>
            </div>
            <div class="flex flex-col gap-6">
                {{-- Message Card 1 --}}
                <div class="bg-white dark:bg-[#2d281a] p-6 rounded-xl border border-[#e5e3dc] dark:border-[#3d382d] shadow-sm relative group">
                    <div class="flex items-start gap-4">
                        <div class="size-12 rounded-full bg-primary/20 flex items-center justify-center shrink-0">
                            <span class="text-primary font-bold">MM</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-bold text-lg">Maria Mendes</h4>
                                <span class="text-xs opacity-50 font-medium">2 horas atras</span>
                            </div>
                            <p class="text-base leading-relaxed opacity-80 italic">
                                "Para o casal mais lindo que eu conheco — que a vida de voces juntos seja tao radiante quanto o dia do casamento. Desejo infinitos anos de amor, risadas e aventuras compartilhadas. Parabens!"
                            </p>
                            <div class="mt-4 flex gap-4">
                                <button class="flex items-center gap-1 text-xs font-bold text-primary group-hover:underline">
                                    <span class="material-symbols-outlined text-base">favorite</span> 12 Curtidas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Message Card 2 --}}
                <div class="bg-white dark:bg-[#2d281a] p-6 rounded-xl border border-[#e5e3dc] dark:border-[#3d382d] shadow-sm relative">
                    <div class="flex items-start gap-4">
                        <div class="size-12 rounded-full bg-primary/20 flex items-center justify-center shrink-0">
                            <span class="text-primary font-bold">JP</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-bold text-lg">Joao Pedro</h4>
                                <span class="text-xs opacity-50 font-medium">5 horas atras</span>
                            </div>
                            <p class="text-base leading-relaxed opacity-80">
                                "Mandei uma contribuicao para o fundo da lua de mel! Espero que voces tenham a melhor viagem. Mal posso esperar para celebrar com voces!"
                            </p>
                            <div class="mt-4">
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider rounded">Contribuiu para Lua de Mel</span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Message Card 3 --}}
                <div class="bg-white dark:bg-[#2d281a] p-6 rounded-xl border border-[#e5e3dc] dark:border-[#3d382d] shadow-sm relative">
                    <div class="flex items-start gap-4">
                        <div class="size-12 rounded-full bg-primary/20 flex items-center justify-center shrink-0">
                            <span class="text-primary font-bold">FS</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-bold text-lg">Familia Silva</h4>
                                <span class="text-xs opacity-50 font-medium">Ontem</span>
                            </div>
                            <p class="text-base leading-relaxed opacity-80">
                                "Tao felizes por voces dois. Acompanhamos voces crescerem juntos e tem sido uma alegria. Lembrem-se de sempre reservar tempo para encontros a dois!"
                            </p>
                            <div class="mt-4 flex gap-4">
                                <button class="flex items-center gap-1 text-xs font-bold text-primary">
                                    <span class="material-symbols-outlined text-base">favorite</span> 8 Curtidas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Message Card 4 --}}
                <div class="bg-white dark:bg-[#2d281a] p-6 rounded-xl border border-[#e5e3dc] dark:border-[#3d382d] shadow-sm relative">
                    <div class="flex items-start gap-4">
                        <div class="size-12 rounded-full bg-primary/20 flex items-center justify-center shrink-0">
                            <span class="text-primary font-bold">CO</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-bold text-lg">Camila Oliveira</h4>
                                <span class="text-xs opacity-50 font-medium">Ontem</span>
                            </div>
                            <p class="text-base leading-relaxed opacity-80">
                                "Parabens! Que o lar de voces seja sempre cheio de alegria e aconchego."
                            </p>
                        </div>
                    </div>
                </div>
                {{-- Load More --}}
                <button class="py-4 text-sm font-bold text-primary hover:opacity-80 transition-opacity flex items-center justify-center gap-2">
                    Ver Mais Mensagens
                    <span class="material-symbols-outlined text-base">keyboard_arrow_down</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
