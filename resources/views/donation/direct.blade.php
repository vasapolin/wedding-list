@extends('layouts.app')

@section('title', 'Presente em Dinheiro - Ana & Lucas')

@section('content')
<div class="flex justify-center py-10 px-4 sm:px-6">
    <div class="max-w-[640px] w-full flex flex-col gap-8" x-data="{ selectedAmount: 100, customAmount: '', anonymous: false }">
        {{-- Hero Title --}}
        <div class="text-center space-y-2">
            <h1 class="text-4xl font-extrabold tracking-tight">Presente em Dinheiro</h1>
            <p class="text-muted text-lg">Contribua com a nossa jornada de forma direta e segura.</p>
        </div>
        {{-- Donation Card --}}
        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-xl shadow-black/5 p-6 md:p-10 border border-[#e5e3dc] dark:border-white/5">
            {{-- Quick Amount Selection --}}
            <div class="mb-8">
                <p class="text-base font-semibold mb-4">Selecione um valor</p>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach([50, 100, 200, 500] as $amount)
                    <label class="relative cursor-pointer group">
                        <input class="peer sr-only" name="donation-amount" type="radio" value="{{ $amount }}" x-model.number="selectedAmount" @change="customAmount = ''"/>
                        <div class="flex h-14 items-center justify-center rounded-lg border-2 border-[#e5e3dc] dark:border-white/10 peer-checked:border-primary peer-checked:bg-primary/5 transition-all duration-200">
                            <span class="font-bold text-muted peer-checked:text-primary">R$ {{ $amount }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
            {{-- Custom Amount --}}
            <div class="mb-8">
                <label class="block text-base font-semibold mb-3">Ou digite outro valor</label>
                <div class="relative group">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-muted font-bold text-lg">R$</span>
                    <input x-model="customAmount" @input="selectedAmount = 0" class="w-full pl-12 pr-4 h-14 rounded-lg border border-[#e5e3dc] dark:border-white/10 dark:bg-background-dark focus:ring-2 focus:ring-primary focus:border-primary transition-all text-lg font-semibold" placeholder="0,00" type="text"/>
                </div>
            </div>
            <div class="h-px bg-[#e5e3dc] dark:bg-white/10 w-full mb-8"></div>
            {{-- Guest Details --}}
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="text-base font-semibold">Seu Nome</label>
                        <span class="text-xs text-muted italic">Opcional</span>
                    </div>
                    <input class="w-full h-14 px-4 rounded-lg border border-[#e5e3dc] dark:border-white/10 dark:bg-background-dark focus:ring-2 focus:ring-primary focus:border-primary transition-all" placeholder="Como quer ser identificado?" type="text" :disabled="anonymous"/>
                </div>
                {{-- Anonymous Toggle --}}
                <div class="flex items-center justify-between p-4 rounded-lg bg-background-light dark:bg-white/5">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-muted">visibility_off</span>
                        <span class="text-sm font-medium">Doar anonimamente</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input x-model="anonymous" class="sr-only peer" type="checkbox"/>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
                <div>
                    <label class="block text-base font-semibold mb-2">Mensagem para os noivos</label>
                    <textarea class="w-full p-4 rounded-lg border border-[#e5e3dc] dark:border-white/10 dark:bg-background-dark focus:ring-2 focus:ring-primary focus:border-primary transition-all resize-none" placeholder="Deixe uma mensagem especial..." rows="3"></textarea>
                </div>
            </div>
            {{-- Submit Button --}}
            <div class="mt-10">
                <a href="/checkout" class="w-full bg-primary hover:bg-primary/90 text-white h-14 rounded-lg font-bold text-lg flex items-center justify-center gap-2 shadow-lg shadow-primary/20 transition-all active:scale-[0.98]">
                    Continuar para pagamento
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <div class="flex items-center justify-center gap-2 mt-6 text-muted text-sm">
                    <span class="material-symbols-outlined text-[18px]">lock</span>
                    Pagamento seguro processado por Asaas
                </div>
            </div>
        </div>
        {{-- Footer Small --}}
        <div class="flex flex-wrap justify-center gap-6 text-xs text-muted uppercase tracking-widest font-semibold pb-10">
            <a class="hover:text-primary" href="#">Termos de Uso</a>
            <a class="hover:text-primary" href="#">Privacidade</a>
            <a class="hover:text-primary" href="/como-doar">Ajuda</a>
        </div>
    </div>
</div>
@endsection
