@extends('layouts.app')

@section('title', 'Pagamento Pix - Laura & Victor')

@section('content')
<div class="pt-28 pb-24 px-4 min-h-screen bg-black">
    <div class="max-w-md mx-auto">

        {{-- Card --}}
        <div class="bg-surface border border-surface-border">

            {{-- Status Header --}}
            <div class="border-b border-surface-border px-8 py-8 text-center">
                <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-5">Aguardando Pagamento</p>
                <p class="font-serif text-5xl font-light text-ink mb-3">R$ 250,00</p>
                <p class="font-sans text-sm text-ink-muted">Contribuicao para Lua de Mel</p>
            </div>

            {{-- QR Code --}}
            <div class="px-8 py-10 flex flex-col items-center">
                <p class="font-sans text-sm text-ink-muted text-center mb-8">
                    Abra o app do seu banco e escaneie o codigo abaixo.
                </p>

                {{-- QR Placeholder --}}
                <div class="w-52 h-52 border border-surface-border bg-surface-light flex items-center justify-center mb-8">
                    <span class="font-sans text-xs uppercase tracking-widest text-ink-muted">QR Code</span>
                </div>

                {{-- Timer --}}
                <p class="font-sans text-xs text-ink-muted mb-8">
                    Expira em <span class="text-coastal font-medium">30:00</span>
                </p>

                {{-- Copy Code --}}
                <div class="w-full mb-10">
                    <p class="font-sans text-xs uppercase tracking-widest text-ink-muted mb-3">Pix copia e cola</p>
                    <div class="flex border border-surface-border">
                        <input
                            id="pix-code"
                            class="flex-1 px-4 h-11 bg-surface-light font-sans text-xs text-ink-muted outline-none truncate"
                            readonly
                            value="00020126580014br.gov.bcb.pix013697920374-9842-4b2a-89a3..."
                        />
                        <button
                            class="px-4 border-l border-surface-border bg-surface hover:bg-coastal hover:text-black transition-colors duration-200 font-sans text-xs uppercase tracking-widest text-ink-muted"
                            onclick="navigator.clipboard.writeText(document.getElementById('pix-code').value)"
                        >
                            Copiar
                        </button>
                    </div>
                </div>

                {{-- CTA: Ja paguei --}}
                <a
                    href="/confirmacao"
                    class="block w-full text-center bg-coastal hover:bg-coastal-dark transition-colors duration-300 text-black font-sans text-xs uppercase tracking-widest py-4 mb-6"
                >
                    Ja paguei
                </a>

                {{-- Help Link --}}
                <a
                    href="/como-doar"
                    class="font-sans text-xs text-ink-muted hover:text-coastal transition-colors duration-200 tracking-wide"
                >
                    Preciso de ajuda
                </a>

            </div>

        </div>

        {{-- Footer Note --}}
        <div class="mt-8 text-center">
            <div class="decorative-line w-16 mx-auto mb-5"></div>
            <p class="font-sans text-xs text-ink-muted tracking-wide">
                Pagamento 100% seguro &mdash; processado com criptografia SSL
            </p>
        </div>

    </div>
</div>
@endsection
