@extends('layouts.app')

@section('title', 'Checkout - Laura & Victor')

@section('content')
<div class="pt-28 pb-24 px-4 min-h-screen bg-black" x-data="{ paymentMethod: 'pix' }">
    <div class="max-w-5xl mx-auto">

        {{-- Progress Stepper --}}
        <div class="flex items-center mb-14">
            <div class="flex items-center gap-3">
                <span class="font-sans text-xs w-6 h-6 flex items-center justify-center border border-coastal text-coastal shrink-0">&#10003;</span>
                <span class="font-sans text-xs uppercase tracking-widest text-coastal">Seleção</span>
            </div>
            <div class="h-px w-8 bg-surface-border mx-4 shrink-0"></div>
            <div class="flex items-center gap-3">
                <span class="font-sans text-xs w-6 h-6 flex items-center justify-center bg-coastal text-black shrink-0">2</span>
                <span class="font-sans text-xs uppercase tracking-widest text-ink font-medium">Checkout</span>
            </div>
            <div class="h-px w-8 bg-surface-border mx-4 shrink-0"></div>
            <div class="flex items-center gap-3">
                <span class="font-sans text-xs w-6 h-6 flex items-center justify-center border border-surface-border text-ink-muted shrink-0">3</span>
                <span class="font-sans text-xs uppercase tracking-widest text-ink-muted">Confirmação</span>
            </div>
        </div>

        <div class="mb-12">
            <h1 class="font-serif text-5xl font-light text-ink mb-3">Finalize seu presente</h1>
            <p class="font-sans text-sm text-ink-muted">Complete os detalhes abaixo para enviar sua contribuição.</p>
        </div>

        @if($cart->isEmpty())
            <div class="border border-coastal/40 p-10 text-center">
                <p class="font-serif text-2xl text-ink mb-4">Seu carrinho está vazio</p>
                <p class="font-sans text-sm text-ink-muted mb-6">Escolha um presente da lista para começar.</p>
                <a href="{{ route('gifts.index') }}" class="inline-block font-sans text-xs uppercase tracking-widest px-9 py-4 bg-coastal text-black hover:bg-coastal-dark transition-colors duration-200">
                    Ver Lista de Presentes
                </a>
            </div>
        @else
        <form method="POST" action="{{ route('donation.store') }}" class="flex flex-col lg:flex-row gap-10">
            @csrf
            <input type="hidden" name="use_cart" value="1" />

            <div class="flex-1 flex flex-col gap-8">

                <div class="bg-surface border border-surface-border p-8">
                    <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-7">1. Suas Informações</p>
                    <div class="flex flex-col gap-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">Nome completo</label>
                                <input
                                    name="donor_name"
                                    value="{{ old('donor_name') }}"
                                    class="w-full h-12 px-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 placeholder:text-ink-muted"
                                    placeholder="Seu nome"
                                    type="text"
                                />
                            </div>
                            <div>
                                <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">E-mail</label>
                                <input
                                    name="donor_email"
                                    type="email"
                                    required
                                    value="{{ old('donor_email') }}"
                                    class="w-full h-12 px-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 placeholder:text-ink-muted"
                                    placeholder="seu@email.com"
                                />
                                @error('donor_email')<p class="font-sans text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
                            <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">CPF <span class="normal-case italic tracking-normal text-ink-muted ml-1">(exigido pelo processador de pagamento)</span></label>
                            <input
                                name="donor_document"
                                type="text"
                                required
                                inputmode="numeric"
                                value="{{ old('donor_document') }}"
                                class="w-full h-12 px-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 placeholder:text-ink-muted"
                                placeholder="000.000.000-00"
                            />
                            @error('donor_document')<p class="font-sans text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">
                                Mensagem para o casal
                                <span class="normal-case italic tracking-normal text-ink-muted ml-1">(opcional)</span>
                            </label>
                            <textarea
                                name="message"
                                class="w-full p-4 border border-surface-border focus:border-coastal bg-surface-light font-sans text-sm text-ink outline-none transition-colors duration-200 resize-none placeholder:text-ink-muted"
                                placeholder="Escreva algo especial..."
                                rows="3"
                            >{{ old('message') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-surface border border-surface-border p-8">
                    <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-7">2. Método de Pagamento</p>

                    <div class="flex border border-surface-border mb-8">
                        <label class="flex-1">
                            <input type="radio" name="payment_method" value="pix" class="sr-only peer" x-model="paymentMethod" checked />
                            <div class="font-sans text-xs uppercase tracking-widest py-3 px-6 transition-colors duration-200 text-center cursor-pointer peer-checked:bg-coastal peer-checked:text-black bg-surface text-ink-muted hover:text-ink">Pix</div>
                        </label>
                        <label class="flex-1 border-l border-surface-border">
                            <input type="radio" name="payment_method" value="credit_card" class="sr-only peer" x-model="paymentMethod" />
                            <div class="font-sans text-xs uppercase tracking-widest py-3 px-6 transition-colors duration-200 text-center cursor-pointer peer-checked:bg-coastal peer-checked:text-black bg-surface text-ink-muted hover:text-ink">Cartão de Crédito</div>
                        </label>
                    </div>

                    <div x-show="paymentMethod === 'pix'" x-cloak>
                        <div class="border border-surface-border p-6 text-center bg-surface-light">
                            <p class="font-sans text-sm text-ink-muted mb-3">Um QR Code Pix será gerado na próxima etapa.</p>
                            <p class="font-sans text-xs text-ink-muted">Pagamentos Pix são confirmados instantaneamente.</p>
                        </div>
                    </div>

                    <div x-show="paymentMethod === 'credit_card'" x-cloak>
                        <div class="border border-surface-border p-6 text-center bg-surface-light">
                            <p class="font-sans text-sm text-ink-muted">Você será redirecionado para um ambiente seguro da Asaas para inserir seu cartão.</p>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-surface-border">
                        <p class="font-sans text-xs text-ink-muted text-center tracking-wide">
                            Pagamento seguro &mdash; processado pela Asaas com criptografia SSL
                        </p>
                    </div>
                </div>

            </div>

            <aside class="w-full lg:w-80">
                <div class="sticky top-28 bg-surface border border-surface-border p-8">
                    <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-7">Resumo</p>

                    <div class="flex flex-col gap-5 mb-7">
                        @foreach($cart->items() as $item)
                            @php
                                $g = $item['gift'];
                                $imageUrl = $g->image_url;
                            @endphp
                            <div class="flex gap-4">
                                <div class="w-14 h-14 shrink-0 bg-cover bg-center bg-surface-light border border-surface-border" @if($imageUrl) style="background-image: url('{{ $imageUrl }}')" @endif></div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-sans text-sm text-ink font-medium truncate">{{ $g->name }}</p>
                                    <p class="font-sans text-xs text-ink-muted mt-1">{{ $item['quantity'] }} cota{{ $item['quantity'] > 1 ? 's' : '' }}</p>
                                    <p class="font-sans text-sm text-coastal mt-1">R$ {{ number_format($item['line_cents'] / 100, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="decorative-line w-full mb-6"></div>

                    <div class="flex flex-col gap-3 mb-8">
                        <div class="flex justify-between">
                            <span class="font-sans text-sm text-ink-muted">Subtotal</span>
                            <span class="font-sans text-sm text-ink">R$ {{ number_format($cart->totalCents() / 100, 2, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-sans text-sm text-ink-muted">Taxa</span>
                            <span class="font-sans text-sm text-ink-muted italic">Grátis</span>
                        </div>
                        <div class="flex justify-between items-baseline pt-2 border-t border-surface-border">
                            <span class="font-sans text-sm text-ink font-medium">Total</span>
                            <span class="font-serif text-2xl text-ink">R$ {{ number_format($cart->totalCents() / 100, 2, ',', '.') }}</span>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="block w-full text-center bg-coastal hover:bg-coastal-dark transition-colors duration-300 text-black font-sans text-xs uppercase tracking-widest py-4"
                    >
                        Finalizar Doação
                    </button>
                    <p class="font-sans text-xs text-ink-muted text-center mt-4">
                        Conexão SSL criptografada
                    </p>
                </div>
            </aside>

        </form>
        @endif

    </div>
</div>
@endsection
