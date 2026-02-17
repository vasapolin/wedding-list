@extends('layouts.app')

@section('title', 'Checkout - Ana & Lucas')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ paymentMethod: 'pix' }">
    {{-- Progress Stepper --}}
    <div class="mb-10 max-w-2xl">
        <div class="flex items-center gap-4 mb-4">
            <div class="flex items-center gap-2 text-primary font-semibold">
                <span class="size-8 rounded-full bg-primary text-white flex items-center justify-center text-sm">1</span>
                <span>Selecao</span>
            </div>
            <div class="h-px bg-primary w-12"></div>
            <div class="flex items-center gap-2 text-primary font-semibold">
                <span class="size-8 rounded-full bg-primary text-white flex items-center justify-center text-sm">2</span>
                <span>Checkout</span>
            </div>
            <div class="h-px bg-zinc-200 dark:bg-zinc-700 w-12"></div>
            <div class="flex items-center gap-2 text-zinc-400 dark:text-zinc-500 font-medium">
                <span class="size-8 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-sm">3</span>
                <span>Confirmacao</span>
            </div>
        </div>
        <h1 class="text-4xl font-extrabold mb-2">Finalize seu presente</h1>
        <p class="text-zinc-600 dark:text-zinc-400">Complete os detalhes abaixo para enviar sua contribuicao ao casal.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Form Section --}}
        <div class="flex-1 space-y-8">
            {{-- Section 1: Donor Info --}}
            <section class="bg-white dark:bg-zinc-900 p-8 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary">person</span>
                    <h2 class="text-xl font-bold">1. Suas Informacoes</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Nome Completo</label>
                        <input class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:border-primary focus:ring-primary" placeholder="Seu nome" type="text"/>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">E-mail</label>
                        <input class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:border-primary focus:ring-primary" placeholder="seu@email.com" type="email"/>
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Mensagem para o Casal (Opcional)</label>
                        <textarea class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:border-primary focus:ring-primary" placeholder="Escreva algo especial..." rows="3"></textarea>
                    </div>
                </div>
            </section>

            {{-- Section 2: Payment Method --}}
            <section class="bg-white dark:bg-zinc-900 p-8 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary">payments</span>
                    <h2 class="text-xl font-bold">2. Metodo de Pagamento</h2>
                </div>
                {{-- Payment Tabs --}}
                <div class="flex p-1 bg-zinc-100 dark:bg-zinc-800 rounded-lg mb-8">
                    <button @click="paymentMethod = 'pix'" :class="paymentMethod === 'pix' ? 'bg-white dark:bg-zinc-700 shadow-sm text-primary' : 'text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300'" class="flex-1 flex items-center justify-center gap-2 py-3 px-4 rounded-md font-semibold transition-colors">
                        <span class="material-symbols-outlined">qr_code_2</span>
                        Pix
                    </button>
                    <button @click="paymentMethod = 'card'" :class="paymentMethod === 'card' ? 'bg-white dark:bg-zinc-700 shadow-sm text-primary' : 'text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300'" class="flex-1 flex items-center justify-center gap-2 py-3 px-4 rounded-md font-semibold transition-colors">
                        <span class="material-symbols-outlined">credit_card</span>
                        Cartao
                    </button>
                </div>
                {{-- Pix Content --}}
                <div x-show="paymentMethod === 'pix'" class="space-y-6">
                    <div class="flex flex-col md:flex-row items-center gap-8 p-6 bg-zinc-50 dark:bg-zinc-800/50 rounded-lg border border-zinc-100 dark:border-zinc-800">
                        <div class="size-48 bg-white p-3 rounded-lg border border-zinc-200 flex items-center justify-center">
                            <img alt="QR Code para pagamento Pix" class="size-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAcRNdx4p8BL4yPaDPYPnSBoeUY-uw39irGSdFm-PCl8Ab5FUPLbfaBtljZdK7hY2BQJhUofZoIhwY52Tc2NHpwE2a6EHTphlNUOaib8ZDKXnVxqD5CQ39ppp9wBGmZ7k0ZsUOzq0sd-S_cTjHyhVeLV6khZyTpKrpMP4KDWGRDP1hwX7haEF0R1EyMDlvT434U8YBBYngPbcQZ8nA1CCgxwtsn_1r2wenmloy_dCxVMr9uH0iiUcdhLy3lDxsNXkY4hKAyV9sQ2gmL"/>
                        </div>
                        <div class="flex-1 space-y-4 text-center md:text-left">
                            <h3 class="font-bold text-lg">Pague com Pix</h3>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                Escaneie o QR code com o app do seu banco ou copie o codigo abaixo. Pagamentos Pix sao processados instantaneamente.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <button class="flex-1 bg-primary text-white py-2 px-4 rounded-lg font-bold flex items-center justify-center gap-2 hover:brightness-110 transition-all">
                                    <span class="material-symbols-outlined text-lg">content_copy</span>
                                    Copiar Codigo Pix
                                </button>
                            </div>
                            <p class="text-xs text-zinc-500 italic">Este codigo expira em 30:00 minutos</p>
                        </div>
                    </div>
                </div>
                {{-- Card Content --}}
                <div x-show="paymentMethod === 'card'" x-cloak class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Numero do Cartao</label>
                            <input class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:border-primary focus:ring-primary" placeholder="0000 0000 0000 0000" type="text"/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">Validade</label>
                            <input class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:border-primary focus:ring-primary" placeholder="MM/AA" type="text"/>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">CVV</label>
                            <input class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:border-primary focus:ring-primary" placeholder="123" type="text"/>
                        </div>
                    </div>
                </div>
                {{-- Trust Badge --}}
                <div class="mt-10 pt-6 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-center gap-3 grayscale opacity-60">
                    <span class="material-symbols-outlined text-xl">verified_user</span>
                    <span class="text-sm font-medium">Pagamento seguro processado por</span>
                    <div class="font-bold text-lg tracking-tight">Asaas</div>
                </div>
            </section>
        </div>

        {{-- Sidebar Summary --}}
        <aside class="w-full lg:w-96">
            <div class="sticky top-24 space-y-6">
                <div class="bg-white dark:bg-zinc-900 p-6 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-lg">
                    <h3 class="text-lg font-bold mb-4">Resumo dos Presentes</h3>
                    <div class="space-y-4 mb-6">
                        <div class="flex gap-4">
                            <div class="size-16 rounded-lg bg-cover bg-center shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAQahgk9yCF9M487z-_9MEwfi3G0zGkpb1xXvYSl-upkFXeTukminWPo3lNLIepM-mtlaBtyXHmIkb5nLxPr_41KPvpmiaI-NROyiEpeW73iDJ_i7EoPL_K_Z83rPA5R6jtt3PpoFjMl_ciMXZhqB5truBRYFUH77tocpNwEFQQ06zWIuM0KddZaegEfXDCiaML8rajy03KzXpSurDkrq_82lv8g8RYkpAPX_s7ICQIMS-q2l86FExisuIrCWi3RoKdfJcSt4_rufUC')"></div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold truncate">Maquina de Cafe Espresso</p>
                                <p class="text-sm text-zinc-500">Item da Lista</p>
                                <p class="text-sm font-bold text-primary mt-1">R$ 450,00</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="size-16 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">savings</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold truncate">Fundo Lua de Mel</p>
                                <p class="text-sm text-zinc-500">Doacao Direta</p>
                                <p class="text-sm font-bold text-primary mt-1">R$ 100,00</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                        <div class="flex justify-between text-zinc-600 dark:text-zinc-400">
                            <span>Subtotal</span>
                            <span>R$ 550,00</span>
                        </div>
                        <div class="flex justify-between text-zinc-600 dark:text-zinc-400">
                            <span>Taxa</span>
                            <span class="text-green-600 font-medium">Gratis</span>
                        </div>
                        <div class="flex justify-between items-end pt-2">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-2xl font-black text-primary">R$ 550,00</span>
                        </div>
                    </div>
                    <a href="/pagamento/pix" class="block w-full text-center bg-primary text-white py-4 rounded-xl font-bold text-lg mt-8 hover:brightness-105 transition-all shadow-md active:scale-[0.98]">
                        Finalizar Doacao
                    </a>
                    <div class="mt-4 flex items-center justify-center gap-2 text-xs text-zinc-400">
                        <span class="material-symbols-outlined text-xs">lock</span>
                        Conexao SSL criptografada de 128 bits
                    </div>
                </div>
                {{-- Context Card --}}
                <div class="bg-primary/5 p-4 rounded-xl border border-primary/10 flex items-start gap-4">
                    <span class="material-symbols-outlined text-primary mt-1">celebration</span>
                    <div>
                        <p class="font-bold text-sm">Casamento Ana & Lucas</p>
                        <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">Sua contribuicao sera anunciada durante a recepcao em 12 de Outubro.</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
