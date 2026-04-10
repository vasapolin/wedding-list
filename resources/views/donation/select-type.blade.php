@extends('layouts.app')

@section('title', 'Gesto de Carinho - Laura & Victor')

@section('content')
<div class="pt-28 pb-24 px-4 min-h-screen bg-black">
    <div class="max-w-3xl mx-auto flex flex-col items-center">

        {{-- Header --}}
        <div class="text-center mb-16">
            <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-4">Laura & Victor</p>
            <h1 class="font-serif text-5xl lg:text-6xl font-light text-ink mb-5">Gesto de Carinho</h1>
            <div class="decorative-line w-24 mx-auto mb-6"></div>
            <p class="font-sans text-base text-ink-muted max-w-sm mx-auto leading-relaxed">
                Escolha o que preferir. Sua presenca e carinho sao o que mais importam para nos.
            </p>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">

            {{-- Card: Escolher Itens --}}
            <a href="/presentes"
               class="group flex flex-col bg-surface border border-surface-border hover:border-coastal transition-colors duration-300 p-10 text-center">
                <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-6">Lista de Presentes</p>
                <h2 class="font-serif text-3xl font-light text-ink mb-4">Escolher Itens</h2>
                <p class="font-sans text-sm text-ink-muted leading-relaxed mb-10">
                    Navegue pela nossa lista e escolha algo especial que faca parte da nossa nova vida juntos.
                </p>
                <span class="mt-auto font-sans text-xs uppercase tracking-widest text-coastal group-hover:tracking-wider transition-all duration-300">
                    Ver lista completa &rarr;
                </span>
            </a>

            {{-- Card: Doacao Direta --}}
            <a href="/doar/direto"
               class="group flex flex-col bg-surface border border-surface-border hover:border-coastal transition-colors duration-300 p-10 text-center">
                <p class="font-sans text-xs uppercase tracking-widest text-coastal mb-6">Contribuicao</p>
                <h2 class="font-serif text-3xl font-light text-ink mb-4">Doacao Direta</h2>
                <p class="font-sans text-sm text-ink-muted leading-relaxed mb-10">
                    Contribua com qualquer valor de forma rapida e segura via Pix ou cartao de credito.
                </p>
                <span class="mt-auto font-sans text-xs uppercase tracking-widest text-coastal group-hover:tracking-wider transition-all duration-300">
                    Contribuir agora &rarr;
                </span>
            </a>

        </div>

        {{-- Trust Note --}}
        <div class="mt-16 text-center">
            <div class="decorative-line w-16 mx-auto mb-6"></div>
            <p class="font-sans text-xs text-ink-muted tracking-wide">
                Ambiente seguro &mdash; pagamento processado com criptografia SSL
            </p>
        </div>

    </div>
</div>
@endsection
