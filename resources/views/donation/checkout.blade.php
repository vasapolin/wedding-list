@extends('layouts.app')

@section('title', 'Checkout - Laura & Victor')

@section('content')
<div class="pt-28 pb-24 px-4 min-h-screen bg-black" x-data="{ paymentMethod: 'pix' }">
    <div class="max-w-5xl mx-auto">

        {{-- Progress Stepper --}}
        <div class="flex items-center mb-14">
            {{-- Step 1: done --}}
            <div class="flex items-center gap-3">
                <span class="font-sans text-xs w-6 h-6 flex items-center justify-center border border-coastal text-coastal shrink-0">&#10003;</span>
                <span class="font-sans text-xs uppercase tracking-widest text-coastal">Selecao</span>
            </div>
            <div class="h-px w-8 bg-surface-border mx-4 shrink-0"></div>
            {{-- Step 2: active --}}
            <div class="flex items-center gap-3">
                <span class="font-sans text-xs w-6 h-6 flex items-center justify-center bg-coastal text-black shrink-0">2</span>
                <span class="font-sans text-xs uppercase tracking-widest text-ink font-medium">Checkout</span>
            </div>
            <div class="h-px w-8 bg-surface-border mx-4 shrink-0"></div>
            {{-- Step 3: pending --}}
            <div class="flex items-center gap-3">
                <span class="font-sans text-xs w-6 h-6 flex items-center justify-center border border-surface-border text-ink-muted shrink-0">3</span>
                <span class="font-sans text-xs uppercase tracking-widest text-ink-muted">Confirmacao</span>
            </div>
        </div>

        {{-- Page Title --}}
        <div class="mb-12">
            <h1 class="font-serif text-5xl font-light text-ink mb-3">Finalize seu presente</h1>
            <p class="font-sans text-sm text-ink-muted">Complete os detalhes abaixo para enviar sua contribuicao.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Left: Forms --}}
            <div class="flex-1 flex flex-col gap-8">

                {{-- Section 1: Suas Informacoes --}}
                <div class="bg-surface border border-surface-border p-8">
                    <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-7">1. Suas Informacoes</p>
                    <div class="flex flex-col gap-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">Nome completo</label>
                                <input
                                    class="w-full h-12 px-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 placeholder:text-ink-muted"
                                    placeholder="Seu nome"
                                    type="text"
                                />
                            </div>
                            <div>
                                <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">E-mail</label>
                                <input
                                    class="w-full h-12 px-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 placeholder:text-ink-muted"
                                    placeholder="seu@email.com"
                                    type="email"
                                />
                            </div>
                        </div>
                        <div>
                            <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">
                                Mensagem para o casal
                                <span class="normal-case italic tracking-normal text-ink-muted ml-1">(opcional)</span>
                            </label>
                            <textarea
                                class="w-full p-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 resize-none placeholder:text-ink-muted"
                                placeholder="Escreva algo especial..."
                                rows="3"
                            ></textarea>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Metodo de Pagamento --}}
                <div class="bg-surface border border-surface-border p-8">
                    <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-7">2. Metodo de Pagamento</p>

                    {{-- Tabs --}}
                    <div class="flex border border-surface-border mb-8">
                        <button
                            @click="paymentMethod = 'pix'"
                            :class="paymentMethod === 'pix' ? 'bg-coastal text-black' : 'bg-surface text-ink-muted hover:text-ink'"
                            class="flex-1 font-sans text-xs uppercase tracking-widest py-3 px-6 transition-colors duration-200"
                        >
                            Pix
                        </button>
                        <button
                            @click="paymentMethod = 'cartao'"
                            :class="paymentMethod === 'cartao' ? 'bg-coastal text-black' : 'bg-surface text-ink-muted hover:text-ink'"
                            class="flex-1 font-sans text-xs uppercase tracking-widest py-3 px-6 border-l border-surface-border transition-colors duration-200"
                        >
                            Cartao de Credito
                        </button>
                    </div>

                    {{-- Pix Panel --}}
                    <div x-show="paymentMethod === 'pix'" x-cloak>
                        <div class="border border-surface-border p-6 text-center bg-surface-light">
                            <p class="font-sans text-sm text-ink-muted mb-3">Um QR Code Pix sera gerado na proxima etapa.</p>
                            <p class="font-sans text-xs text-ink-muted">Pagamentos Pix sao confirmados instantaneamente.</p>
                        </div>
                    </div>

                    {{-- Cartao Panel --}}
                    <div x-show="paymentMethod === 'cartao'" x-cloak class="flex flex-col gap-5">
                        <div>
                            <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">Numero do Cartao</label>
                            <input
                                class="w-full h-12 px-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 placeholder:text-ink-muted"
                                placeholder="0000 0000 0000 0000"
                                type="text"
                            />
                        </div>
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">Validade</label>
                                <input
                                    class="w-full h-12 px-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 placeholder:text-ink-muted"
                                    placeholder="MM/AA"
                                    type="text"
                                />
                            </div>
                            <div>
                                <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">CVV</label>
                                <input
                                    class="w-full h-12 px-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 placeholder:text-ink-muted"
                                    placeholder="123"
                                    type="text"
                                />
                            </div>
                        </div>
                    </div>

                    {{-- Trust --}}
                    <div class="mt-8 pt-6 border-t border-surface-border">
                        <p class="font-sans text-xs text-ink-muted text-center tracking-wide">
                            Pagamento seguro &mdash; processado com criptografia SSL
                        </p>
                    </div>
                </div>

            </div>

            {{-- Right: Order Summary --}}
            <aside class="w-full lg:w-80">
                <div class="sticky top-28 bg-surface border border-surface-border p-8">
                    <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-7">Resumo</p>

                    {{-- Items --}}
                    <div class="flex flex-col gap-5 mb-7">
                        <div class="flex gap-4">
                            <div class="w-14 h-14 shrink-0 bg-surface-light border border-surface-border flex items-center justify-center">
                                <span class="font-sans text-xs text-ink-muted text-center leading-tight">Item</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-sans text-sm text-ink font-medium truncate">Maquina de Cafe Espresso</p>
                                <p class="font-sans text-xs text-ink-muted mt-1">Lista de presentes</p>
                                <p class="font-sans text-sm text-coastal mt-1">R$ 450,00</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-14 h-14 shrink-0 bg-surface-light border border-surface-border flex items-center justify-center">
                                <span class="font-sans text-xs text-ink-muted text-center leading-tight">Pix</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-sans text-sm text-ink font-medium truncate">Fundo Lua de Mel</p>
                                <p class="font-sans text-xs text-ink-muted mt-1">Doacao direta</p>
                                <p class="font-sans text-sm text-coastal mt-1">R$ 100,00</p>
                            </div>
                        </div>
                    </div>

                    <div class="decorative-line w-full mb-6"></div>

                    {{-- Totals --}}
                    <div class="flex flex-col gap-3 mb-8">
                        <div class="flex justify-between">
                            <span class="font-sans text-sm text-ink-muted">Subtotal</span>
                            <span class="font-sans text-sm text-ink">R$ 550,00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-sans text-sm text-ink-muted">Taxa</span>
                            <span class="font-sans text-sm text-ink-muted italic">Gratis</span>
                        </div>
                        <div class="flex justify-between items-baseline pt-2 border-t border-surface-border">
                            <span class="font-sans text-sm text-ink font-medium">Total</span>
                            <span class="font-serif text-2xl text-ink">R$ 550,00</span>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <a
                        href="/pagamento/pix"
                        class="block w-full text-center bg-coastal hover:bg-coastal-dark transition-colors duration-300 text-black font-sans text-xs uppercase tracking-widest py-4"
                    >
                        Finalizar Doacao
                    </a>
                    <p class="font-sans text-xs text-ink-muted text-center mt-4">
                        Conexao SSL criptografada
                    </p>
                </div>
            </aside>

        </div>

    </div>
</div>
@endsection
