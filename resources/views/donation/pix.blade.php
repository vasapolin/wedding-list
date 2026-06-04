@extends('layouts.app')

@section('title', 'Pagamento Pix - Laura & Victor')

@section('content')
<div class="pt-28 pb-24 px-4 min-h-screen bg-black">
    <div class="max-w-md mx-auto">

        <div class="bg-surface border border-surface-border" x-data="{ copied: false }">

            {{-- Status Header --}}
            <div class="border-b border-surface-border px-8 py-8 text-center">
                <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-5">
                    {{ $donation->status === \App\Models\Donation::STATUS_PAID ? 'Pagamento Confirmado' : 'Aguardando Pagamento' }}
                </p>
                <p class="font-serif text-5xl font-light text-ink mb-3">R$ {{ number_format($donation->amount_cents / 100, 2, ',', '.') }}</p>
                <p class="font-sans text-sm text-ink-muted">
                    {{ $donation->gift?->name ?? 'Contribuição direta para Laura & Victor' }}
                </p>
            </div>

            <div class="px-8 py-10 flex flex-col items-center">
                @if($pix['copy_paste'])
                    <p class="font-sans text-sm text-ink-muted text-center mb-8">
                        Abra o app do seu banco e escaneie o código abaixo.
                    </p>

                    <div class="w-52 h-52 border border-surface-border bg-white flex items-center justify-center mb-8 overflow-hidden">
                        @if($pix['qr_code_image'])
                            <img src="{{ $pix['qr_code_image'] }}" alt="QR Code Pix" class="w-full h-full object-contain" />
                        @else
                            <span class="font-sans text-xs uppercase tracking-widest text-ink-muted">QR Code indisponível</span>
                        @endif
                    </div>

                    <div class="w-full mb-10">
                        <p class="font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">Pix copia e cola</p>
                        <div class="flex border border-surface-border">
                            <input
                                id="pix-code"
                                class="flex-1 px-4 h-11 bg-surface-light font-sans text-xs text-ink-muted outline-none truncate"
                                readonly
                                value="{{ $pix['copy_paste'] }}"
                            />
                            <button
                                type="button"
                                @click="navigator.clipboard.writeText(document.getElementById('pix-code').value); copied = true; setTimeout(() => copied = false, 2000)"
                                class="px-4 border-l border-surface-border bg-surface hover:bg-coastal hover:text-black transition-colors duration-200 font-sans text-xs uppercase tracking-widest text-ink-muted"
                            >
                                <span x-show="! copied">Copiar</span>
                                <span x-show="copied" x-cloak>Copiado!</span>
                            </button>
                        </div>
                    </div>
                @elseif($donation->asaas_payment_id)
                    <div class="w-full mb-8 p-6 bg-surface-light border border-surface-border text-center">
                        <p class="font-sans text-sm text-ink mb-3">Seu QR Code Pix está sendo gerado.</p>
                        <p class="font-sans text-xs text-ink-muted mb-5">
                            Isso costuma levar apenas alguns segundos.
                        </p>
                        <a
                            href="{{ route('donation.pix', $donation) }}"
                            class="inline-block font-sans text-xs uppercase tracking-widest px-6 py-3 border border-coastal text-coastal hover:bg-coastal hover:text-black transition-colors duration-200"
                        >
                            Recarregar
                        </a>
                    </div>
                @else
                    <div class="w-full mb-8 p-6 bg-surface-light border border-surface-border">
                        <p class="font-sans text-sm text-ink mb-3">Doação registrada.</p>
                        <p class="font-sans text-xs text-ink-muted mb-3">
                            O sistema de pagamento online ainda não foi configurado. Por enquanto, faça um Pix manual para o casal — nós confirmaremos a entrada do valor.
                        </p>
                        <p class="font-mono text-xs text-coastal">ID interno: {{ $donation->id }}</p>
                    </div>
                @endif

                @if($donation->status !== \App\Models\Donation::STATUS_PAID)
                    <a
                        href="{{ route('donation.status', $donation) }}"
                        class="block w-full text-center bg-coastal hover:bg-coastal-dark transition-colors duration-300 text-black font-sans text-xs uppercase tracking-widest py-4 mb-6"
                    >
                        Verificar pagamento
                    </a>
                @else
                    <a
                        href="{{ route('donation.confirmation', $donation) }}"
                        class="block w-full text-center bg-coastal hover:bg-coastal-dark transition-colors duration-300 text-black font-sans text-xs uppercase tracking-widest py-4 mb-6"
                    >
                        Ver confirmação
                    </a>
                @endif

                <a
                    href="{{ route('how-to-donate') }}"
                    class="font-sans text-xs text-ink-muted hover:text-coastal transition-colors duration-200 tracking-wide"
                >
                    Preciso de ajuda
                </a>

            </div>

        </div>

        <div class="mt-8 text-center">
            <div class="decorative-line w-16 mx-auto mb-5"></div>
            <p class="font-sans text-xs text-ink-muted tracking-wide">
                Pagamento processado pela Asaas com criptografia SSL
            </p>
        </div>

    </div>
</div>
@endsection
