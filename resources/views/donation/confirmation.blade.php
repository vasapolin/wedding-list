@extends('layouts.app')

@section('title', 'Confirmacao - Laura & Victor')

@section('content')
<div class="pt-28 pb-24 bg-black">

    {{-- ============================================================
         SUCCESS HEADER
         ============================================================ --}}
    <div class="text-center px-6 mb-10">
        <div class="inline-flex items-center justify-center mb-8">
            <svg class="size-20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="40" cy="40" r="38" stroke="#9bb2c4" stroke-width="1.5"/>
                <polyline points="24,41 35,52 56,30" stroke="#9bb2c4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h1 class="font-serif text-5xl md:text-6xl font-light text-vanilla mb-4 leading-tight">
            Obrigado pelo seu Presente!
        </h1>
        <p class="font-sans text-sm text-ink-light max-w-lg mx-auto leading-relaxed">
            Laura e Victor receberam sua contribuicao com enorme gratidao e carinho. Voce faz parte desta historia.
        </p>
    </div>

    {{-- ============================================================
         DECORATIVE LINE
         ============================================================ --}}
    <div class="decorative-line w-48 mx-auto mb-14"></div>

    {{-- ============================================================
         TWO-COLUMN LAYOUT
         ============================================================ --}}
    <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-8 items-start">

        {{-- LEFT: Donation Summary Card --}}
        <div class="md:col-span-7 flex flex-col gap-5">
            <div class="bg-surface border border-surface-border overflow-hidden">

                {{-- Stock image --}}
                <div class="aspect-video w-full overflow-hidden">
                    <img
                        src="https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80"
                        alt="Laura e Victor"
                        class="w-full h-full object-cover opacity-80"
                    />
                </div>

                <div class="p-8">
                    {{-- Badge --}}
                    <div class="mb-6">
                        <span class="inline-block px-3 py-1 bg-green-900/40 text-green-400 text-[10px] font-sans font-medium border border-green-700/40 tracking-widest uppercase">
                            Pagamento Confirmado
                        </span>
                    </div>

                    {{-- Amount --}}
                    <div class="mb-8">
                        <p class="font-sans text-[10px] text-ink-muted uppercase tracking-[0.25em] mb-2">Valor total</p>
                        <p class="font-serif text-5xl font-light text-coastal">R$ 250,00</p>
                    </div>

                    {{-- Details table --}}
                    <div class="border-t border-surface-border pt-6 flex flex-col gap-4">
                        <div class="flex items-baseline justify-between gap-4">
                            <span class="font-sans text-xs text-ink-muted shrink-0">Item</span>
                            <span class="font-sans text-sm text-vanilla text-right">Contribuicao Lua de Mel</span>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <span class="font-sans text-xs text-ink-muted shrink-0">ID do Pagamento</span>
                            <span class="font-mono text-xs bg-surface-border/60 px-2 py-1 text-ink-light">ASAAS_9283746501</span>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <span class="font-sans text-xs text-ink-muted shrink-0">Data</span>
                            <span class="font-sans text-sm text-vanilla">12 de Outubro de 2024</span>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <span class="font-sans text-xs text-ink-muted shrink-0">Metodo</span>
                            <span class="font-sans text-sm text-vanilla">Pix</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Text links --}}
            <div class="flex items-center justify-between px-1">
                <button
                    onclick="window.print()"
                    class="font-sans text-xs text-ink-muted hover:text-coastal transition-colors tracking-wide"
                >
                    Imprimir Recibo
                </button>
                <a
                    href="/presentes"
                    class="font-sans text-xs text-ink-muted hover:text-coastal transition-colors tracking-wide"
                >
                    Voltar para Lista &rarr;
                </a>
            </div>
        </div>

        {{-- RIGHT: Message + Share --}}
        <div class="md:col-span-5 flex flex-col gap-5">

            {{-- Message box --}}
            <div class="bg-surface border border-surface-border p-7">
                <h3 class="font-serif text-xl font-light text-vanilla mb-1">Mensagem para o Casal</h3>
                <p class="font-sans text-xs text-ink-muted mb-5 leading-relaxed">
                    Deixe um recado carinhoso para Laura e Victor. Eles guardarao para sempre.
                </p>
                <textarea
                    rows="5"
                    placeholder="Escreva algo especial aqui..."
                    class="w-full font-sans text-sm text-vanilla bg-black border border-surface-border px-4 py-3 placeholder:text-ink-muted focus:outline-none focus:border-coastal/60 resize-none transition-colors"
                ></textarea>
                <button class="w-full mt-4 bg-coastal hover:bg-coastal/80 text-black font-sans text-xs font-medium uppercase tracking-widest py-3.5 transition-colors duration-200">
                    Enviar Mensagem
                </button>
            </div>

            {{-- Share box --}}
            <div class="bg-surface border border-surface-border p-7">
                <h3 class="font-serif text-lg font-light text-vanilla mb-1">Compartilhe com Amigos</h3>
                <p class="font-sans text-xs text-ink-muted mb-5 leading-relaxed">
                    Convide outros convidados a contribuir com nossa lista de presentes.
                </p>
                <button
                    onclick="navigator.clipboard.writeText(window.location.origin + '/presentes').then(function(){ var btn = this; btn.textContent = 'Link Copiado!'; setTimeout(function(){ btn.textContent = 'Copiar Link da Lista'; }, 2000); }.bind(this))"
                    class="w-full font-sans text-xs text-ink-light border border-surface-border hover:border-coastal/50 hover:text-coastal bg-black py-3 transition-colors duration-200 tracking-wide uppercase"
                >
                    Copiar Link da Lista
                </button>
            </div>

        </div>
    </div>

    {{-- ============================================================
         BOTTOM SIGNATURE
         ============================================================ --}}
    <div class="mt-20 text-center">
        <div class="decorative-line w-16 mx-auto mb-6"></div>
        <p class="font-serif text-sm text-ink-muted tracking-widest">
            Laura &amp; Victor &nbsp;|&nbsp; Para Sempre Comeca Aqui
        </p>
    </div>

</div>
@endsection
