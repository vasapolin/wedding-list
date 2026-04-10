@extends('layouts.app')

@section('title', 'Presente em Dinheiro - Laura & Victor')

@section('content')
<div class="pt-28 pb-24 px-4 min-h-screen bg-black">
    <div class="max-w-lg mx-auto">

        {{-- Header --}}
        <div class="text-center mb-12">
            <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-4">Contribuicao</p>
            <h1 class="font-serif text-5xl font-light text-ink mb-4">Presente em Dinheiro</h1>
            <div class="decorative-line w-24 mx-auto mb-6"></div>
            <p class="font-sans text-sm text-ink-muted leading-relaxed">
                Contribua com a nossa jornada de forma direta e segura.
            </p>
        </div>

        {{-- Form Card --}}
        <div
            class="bg-surface border border-surface-border p-8 lg:p-10"
            x-data="{ selectedAmount: 100, customAmount: '', anonymous: false }"
        >

            {{-- Quick Amounts --}}
            <div class="mb-8">
                <p class="font-sans text-xs uppercase tracking-widest text-ink-muted mb-5">Selecione um valor</p>
                <div class="grid grid-cols-4 gap-3">
                    @foreach([50, 100, 200, 500] as $amount)
                    <label class="cursor-pointer">
                        <input
                            class="sr-only peer"
                            name="donation-amount"
                            type="radio"
                            value="{{ $amount }}"
                            x-model.number="selectedAmount"
                            @change="customAmount = ''"
                        />
                        <div class="flex h-12 items-center justify-center border border-surface-border peer-checked:border-coastal peer-checked:bg-coastal peer-checked:text-black text-ink-light transition-colors duration-200 cursor-pointer">
                            <span class="font-sans text-sm font-medium">R$&nbsp;{{ $amount }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Custom Amount --}}
            <div class="mb-8">
                <p class="font-sans text-xs uppercase tracking-widest text-ink-muted mb-5">Ou outro valor</p>
                <div class="flex border border-surface-border focus-within:border-coastal transition-colors duration-200">
                    <span class="flex items-center px-4 font-sans text-sm text-ink-muted border-r border-surface-border bg-surface-light select-none">R$</span>
                    <input
                        x-model="customAmount"
                        @input="selectedAmount = 0"
                        class="flex-1 px-4 h-12 bg-surface-light font-sans text-sm text-ink outline-none placeholder:text-ink-muted"
                        placeholder="0,00"
                        type="text"
                    />
                </div>
            </div>

            <div class="decorative-line w-full mb-8"></div>

            {{-- Name --}}
            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <label class="font-sans text-xs uppercase tracking-widest text-ink-muted">Seu Nome</label>
                    <span class="font-sans text-xs text-ink-muted italic">Opcional</span>
                </div>
                <input
                    class="w-full h-12 px-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 placeholder:text-ink-muted"
                    :class="anonymous ? 'opacity-40 pointer-events-none' : ''"
                    :disabled="anonymous"
                    placeholder="Como quer ser identificado?"
                    type="text"
                />
            </div>

            {{-- Anonymous Toggle --}}
            <div class="flex items-center gap-3 mb-6">
                <input
                    x-model="anonymous"
                    id="anonymous-toggle"
                    type="checkbox"
                    class="w-4 h-4 border border-surface-border accent-coastal cursor-pointer"
                />
                <label for="anonymous-toggle" class="font-sans text-sm text-ink-light cursor-pointer select-none">
                    Prefiro fazer uma doacao anonima
                </label>
            </div>

            {{-- Message --}}
            <div class="mb-10">
                <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">Mensagem para o casal</label>
                <textarea
                    class="w-full p-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 resize-none placeholder:text-ink-muted"
                    placeholder="Deixe uma mensagem especial..."
                    rows="3"
                ></textarea>
            </div>

            {{-- CTA --}}
            <a
                href="/checkout"
                class="block w-full text-center bg-coastal hover:bg-coastal-dark transition-colors duration-300 text-black font-sans text-xs uppercase tracking-widest py-4"
            >
                Continuar para pagamento
            </a>

            <p class="font-sans text-xs text-ink-muted text-center mt-5">
                Pagamento seguro &mdash; processado com criptografia SSL
            </p>

        </div>

    </div>
</div>
@endsection
