@extends('layouts.app')

@section('title', 'Confirmacao - Ana & Lucas')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12 md:py-20">
    {{-- Success Header --}}
    <div class="text-center mb-10">
        <div class="inline-flex items-center justify-center size-20 bg-primary/10 rounded-full mb-6">
            <span class="material-symbols-outlined text-primary text-5xl">check_circle</span>
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
            Obrigado pelo seu Presente!
        </h1>
        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-xl mx-auto">
            Sua contribuicao foi recebida com sucesso. Ana e Lucas ficam muito felizes em ter voce como parte dessa historia!
        </p>
    </div>

    <div class="decorative-line w-full mb-12"></div>

    {{-- Confirmation Card --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
        {{-- Left Side: Summary --}}
        <div class="md:col-span-7 space-y-6">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-xl shadow-primary/5 overflow-hidden border border-gray-100 dark:border-gray-800">
                <div class="p-1">
                    <div class="aspect-video w-full rounded-t-lg bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB3xsCOVDXFAbVXvSGezCwTGD7cRRDJyGP86HZjaJw5D8riVAMSAvvv4KpqbE8ge_6UuQZBOSqvpmv0SgFfCLbnJCRiUacXO7pJ7yIX5RgV1qnvdn8499QV3hqF2cFHhMeDHbQZK-O02moiA5DLiKInLKEEC7-453ot_5zlilnptKgYImkQwyH1-UNj6AMKgSRDqOwHLZbMj2yepEzqtMQJNesrw0o65l2-IjCDkcDWbouPA82TMwuGIkGSjW-wNHq3zKFH9sMopJ90");'></div>
                </div>
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-bold rounded-full uppercase tracking-wider">
                                Pagamento Confirmado
                            </span>
                            <h3 class="text-2xl font-bold mt-3">Resumo da Doacao</h3>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-500 text-sm uppercase tracking-widest">Valor</p>
                            <p class="text-3xl font-extrabold text-primary">R$ 250,00</p>
                        </div>
                    </div>
                    <div class="space-y-4 pt-6 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Item</span>
                            <span class="font-medium">Contribuicao Lua de Mel</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">ID do Pagamento</span>
                            <span class="font-mono text-xs bg-gray-50 dark:bg-gray-800 px-2 py-1 rounded">ASAAS_9283746501</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Data</span>
                            <span class="font-medium">12 de Outubro de 2024</span>
                        </div>
                    </div>
                    <div class="mt-8 flex items-center gap-2 justify-center text-xs text-gray-400">
                        <span class="material-symbols-outlined text-sm">shield</span>
                        Processado com seguranca via Asaas
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between px-2">
                <button class="flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-base">print</span>
                    Imprimir Recibo
                </button>
                <a href="/presentes" class="flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    Voltar para Lista
                </a>
            </div>
        </div>
        {{-- Right Side: Interaction --}}
        <div class="md:col-span-5 space-y-6">
            {{-- Message Box --}}
            <div class="bg-white dark:bg-gray-900 p-8 rounded-xl border border-gray-100 dark:border-gray-800 shadow-lg">
                <h4 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit_note</span>
                    Mensagem para o Casal
                </h4>
                <p class="text-sm text-gray-500 mb-4 leading-relaxed">
                    Deixe um recado carinhoso para Ana e Lucas. Eles poderao ler na area do casal.
                </p>
                <textarea class="w-full rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-800 focus:ring-primary focus:border-primary p-4 text-sm" placeholder="Escreva algo especial aqui..." rows="4"></textarea>
                <button class="w-full mt-4 bg-primary hover:bg-primary/90 text-white font-bold py-3 rounded-lg transition-all transform active:scale-[0.98]">
                    Enviar Mensagem
                </button>
            </div>
            {{-- Share Box --}}
            <div class="bg-primary/5 dark:bg-primary/10 p-8 rounded-xl border border-primary/10">
                <h4 class="text-lg font-bold mb-2">Compartilhe com amigos</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    Compartilhe o link da lista com outros convidados que queiram contribuir.
                </p>
                <div class="flex gap-3">
                    <button class="flex-1 flex items-center justify-center gap-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 py-3 rounded-lg text-sm font-bold hover:bg-gray-50 transition-colors">
                        <span class="material-symbols-outlined text-base">content_copy</span>
                        Copiar Link
                    </button>
                    <button class="px-4 flex items-center justify-center bg-[#25D366] text-white py-3 rounded-lg hover:opacity-90 transition-opacity">
                        <svg class="size-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Footer Decorative --}}
<div class="py-12 text-center overflow-hidden">
    <div class="flex justify-center gap-4 mb-6 opacity-20">
        <span class="material-symbols-outlined text-primary scale-150">favorite</span>
        <span class="material-symbols-outlined text-primary scale-150">star</span>
        <span class="material-symbols-outlined text-primary scale-150">favorite</span>
    </div>
    <p class="text-sm text-gray-400 font-medium">Ana & Lucas | Para Sempre Comeca Aqui</p>
</div>
@endsection
