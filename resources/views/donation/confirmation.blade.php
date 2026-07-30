@extends('layouts.app')

@section('title', 'Confirmação - Laura & Victor')

@section('content')
<div class="pt-28 pb-24 bg-black">

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
            Laura e Victor receberam sua contribuição com enorme gratidão e carinho. Você faz parte desta história.
        </p>
    </div>

    <div class="decorative-line w-48 mx-auto mb-14"></div>

    <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-8 items-start">

        <div class="md:col-span-7 flex flex-col gap-5">
            <div class="bg-surface border border-surface-border overflow-hidden">

                <div class="aspect-video w-full overflow-hidden">
                    <img
                        src="{{ $heroUrl ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80' }}"
                        alt="Laura e Victor"
                        class="w-full h-full object-cover opacity-80"
                    />
                </div>

                <div class="p-8">
                    <div class="mb-6">
                        @php
                            $statusColors = [
                                \App\Models\Donation::STATUS_PAID => 'bg-green-900/40 text-green-400 border-green-700/40',
                                \App\Models\Donation::STATUS_PENDING => 'bg-yellow-900/40 text-yellow-400 border-yellow-700/40',
                                \App\Models\Donation::STATUS_FAILED => 'bg-red-900/40 text-red-400 border-red-700/40',
                                \App\Models\Donation::STATUS_REFUNDED => 'bg-gray-900/40 text-gray-400 border-gray-700/40',
                            ];
                            $statusLabels = [
                                \App\Models\Donation::STATUS_PAID => 'Pagamento Confirmado',
                                \App\Models\Donation::STATUS_PENDING => 'Aguardando Confirmação',
                                \App\Models\Donation::STATUS_FAILED => 'Pagamento Falhou',
                                \App\Models\Donation::STATUS_REFUNDED => 'Pagamento Estornado',
                            ];
                        @endphp
                        <span class="inline-block px-3 py-1 text-[10px] font-sans font-medium border tracking-widest uppercase {{ $statusColors[$donation->status] }}">
                            {{ $statusLabels[$donation->status] }}
                        </span>
                    </div>

                    <div class="mb-8">
                        <p class="font-sans text-[10px] text-ink-muted uppercase tracking-[0.25em] mb-2">Valor total</p>
                        <p class="font-serif text-5xl font-light text-coastal">R$ {{ number_format($donation->amount_cents / 100, 2, ',', '.') }}</p>
                    </div>

                    <div class="border-t border-surface-border pt-6 flex flex-col gap-4">
                        @php
                            $contributions = $donation->items()->with('gift')->get();
                        @endphp
                        @forelse($contributions as $contribution)
                            <div class="flex items-baseline justify-between gap-4">
                                <span class="font-sans text-xs text-ink-muted shrink-0">
                                    {{ $loop->first ? 'Presentes' : '' }}
                                </span>
                                <span class="font-sans text-sm text-vanilla text-right">
                                    {{ $contribution->gift?->name ?? 'Presente removido' }}
                                    <span class="text-coastal">R$ {{ number_format($contribution->amount_cents / 100, 2, ',', '.') }}</span>
                                </span>
                            </div>
                        @empty
                            <div class="flex items-baseline justify-between gap-4">
                                <span class="font-sans text-xs text-ink-muted shrink-0">Item</span>
                                <span class="font-sans text-sm text-vanilla text-right">{{ $donation->gift?->name ?? 'Contribuição livre para Lua de Mel' }}</span>
                            </div>
                        @endforelse
                        @if($donation->asaas_payment_id)
                            <div class="flex items-baseline justify-between gap-4">
                                <span class="font-sans text-xs text-ink-muted shrink-0">ID do Pagamento</span>
                                <span class="font-mono text-xs bg-surface-border/60 px-2 py-1 text-ink-light">{{ $donation->asaas_payment_id }}</span>
                            </div>
                        @endif
                        <div class="flex items-baseline justify-between gap-4">
                            <span class="font-sans text-xs text-ink-muted shrink-0">Data</span>
                            <span class="font-sans text-sm text-vanilla">{{ optional($donation->paid_at ?? $donation->created_at)->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <span class="font-sans text-xs text-ink-muted shrink-0">Método</span>
                            <span class="font-sans text-sm text-vanilla">{{ $donation->payment_method === 'pix' ? 'Pix' : ($donation->payment_method === 'credit_card' ? 'Cartão' : 'Manual') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between px-1">
                <button
                    onclick="window.print()"
                    class="font-sans text-xs text-ink-muted hover:text-coastal transition-colors tracking-wide"
                >
                    Imprimir Recibo
                </button>
                <a
                    href="{{ route('gifts.index') }}"
                    class="font-sans text-xs text-ink-muted hover:text-coastal transition-colors tracking-wide"
                >
                    Voltar para Lista &rarr;
                </a>
            </div>
        </div>

        <div class="md:col-span-5 flex flex-col gap-5">

            <div class="bg-surface border border-surface-border p-7">
                <h3 class="font-serif text-xl font-light text-vanilla mb-1">Mensagem para o Casal</h3>
                <p class="font-sans text-xs text-ink-muted mb-5 leading-relaxed">
                    Deixe um recado carinhoso para Laura e Victor.
                </p>
                <form method="POST" action="{{ route('messages.store') }}" class="flex flex-col gap-3">
                    @csrf
                    <input
                        type="text"
                        name="author"
                        required
                        maxlength="80"
                        placeholder="Seu nome"
                        value="{{ $donation->is_anonymous ? '' : ($donation->donor_name ?? '') }}"
                        class="w-full font-sans text-sm text-vanilla bg-black border border-surface-border px-4 py-3 placeholder:text-ink-muted focus:outline-none focus:border-coastal/60 transition-colors"
                    />
                    <textarea
                        name="body"
                        rows="4"
                        required
                        maxlength="2000"
                        placeholder="Escreva algo especial aqui..."
                        class="w-full font-sans text-sm text-vanilla bg-black border border-surface-border px-4 py-3 placeholder:text-ink-muted focus:outline-none focus:border-coastal/60 resize-none transition-colors"
                    >{{ $donation->message }}</textarea>
                    <button class="w-full bg-coastal hover:bg-coastal/80 text-black font-sans text-xs font-medium uppercase tracking-widest py-3.5 transition-colors duration-200">
                        Publicar no mural
                    </button>
                </form>
            </div>

            <div class="bg-surface border border-surface-border p-7">
                <h3 class="font-serif text-lg font-light text-vanilla mb-1">Compartilhe com Amigos</h3>
                <p class="font-sans text-xs text-ink-muted mb-5 leading-relaxed">
                    Convide outros convidados a contribuir com nossa lista de presentes.
                </p>
                <button
                    type="button"
                    x-data="{ copied: false }"
                    @click="navigator.clipboard.writeText('{{ route('gifts.index') }}').then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
                    class="w-full font-sans text-xs text-ink-light border border-surface-border hover:border-coastal/50 hover:text-coastal bg-black py-3 transition-colors duration-200 tracking-wide uppercase"
                >
                    <span x-show="! copied">Copiar Link da Lista</span>
                    <span x-show="copied" x-cloak>Link Copiado!</span>
                </button>
            </div>

        </div>
    </div>

    <div class="mt-20 text-center">
        <div class="decorative-line w-16 mx-auto mb-6"></div>
        <p class="font-serif text-sm text-ink-muted tracking-widest">
            Laura &amp; Victor &nbsp;|&nbsp; Para Sempre Começa Aqui
        </p>
    </div>

</div>
@endsection
