@extends('layouts.app')

@section('title', 'Pagamento Pix - Ana & Lucas')

@section('content')
<div class="flex-1 flex flex-col items-center justify-center px-4 py-8 lg:py-12">
    <div class="max-w-[500px] w-full bg-white dark:bg-[#2a2517] rounded-xl shadow-xl border border-[#e5e3dc] dark:border-[#3d3725] overflow-hidden">
        {{-- Status Header --}}
        <div class="bg-primary/10 dark:bg-primary/5 p-6 text-center border-b border-[#e5e3dc] dark:border-[#3d3725]">
            <div class="flex flex-col items-center gap-2">
                <div class="flex items-center gap-2 text-primary font-bold">
                    <span class="material-symbols-outlined status-pulse">sync</span>
                    <span class="text-sm uppercase tracking-widest">Aguardando Pagamento</span>
                </div>
                <h1 class="text-4xl font-bold pt-2">R$ 250,00</h1>
                <p class="text-muted text-sm font-medium">Contribuicao para Lua de Mel em Paris</p>
            </div>
        </div>
        {{-- QR Code Section --}}
        <div class="p-8 flex flex-col items-center text-center">
            <p class="text-base mb-6">
                Abra o app do seu banco e escaneie o codigo abaixo:
            </p>
            <div class="relative p-4 bg-white rounded-lg border-2 border-primary/20 mb-8">
                <div class="w-64 h-64 bg-center bg-no-repeat bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD9sUXX8dPcIUp2kNNgd0s-F1GqSvtXehgY0TWou-jXeDg2jE_k2HRZ1syN833VJ9pmmT6uM-skYPLxC6nGiJm9Y04G96Ac-pTmQDjXeXRGaFEkHFK4crwjEKtyE4qsnZxH4llBsamn5x19qxfY1p77VtF4GMcGdWztgbeJiLayUDaombeFns9JNnOXeG1x12DGRCevvp3vKz02vAti0xVD8wDeP4HwY9_lior606ZZwgkSffaQsZMd6bIdPVvwNV9vIOgY7MIWItNM");'></div>
            </div>
            <div class="flex items-center gap-2 text-sm text-muted mb-8">
                <span class="material-symbols-outlined text-base">timer</span>
                <span>Este codigo expira em 30:00 minutos</span>
            </div>
            {{-- Copy Paste Section --}}
            <div class="w-full space-y-3">
                <p class="text-left text-sm font-semibold px-1">Ou use o Pix Copia e Cola</p>
                <div class="flex w-full items-stretch rounded-xl overflow-hidden border border-[#e5e3dc] dark:border-[#3d3725]">
                    <input class="flex-1 bg-[#fcfcfb] dark:bg-[#3d3725] text-sm px-4 h-12 outline-none border-none" readonly value="00020126580014br.gov.bcb.pix013697920374-9842-4b2a-89a3-c5b4d7f5a9f25204000053039865406250.005802BR5915ANA_LUCAS_CASAM6009SAO_PAULO62070503***6304E2D8"/>
                    <button class="bg-primary text-white flex items-center justify-center px-4 hover:bg-opacity-90 transition-colors">
                        <span class="material-symbols-outlined">content_copy</span>
                    </button>
                </div>
            </div>
        </div>
        {{-- Fallback Actions --}}
        <div class="px-8 pb-8 flex flex-col gap-4">
            <a href="/confirmacao" class="w-full bg-primary text-white font-bold h-12 rounded-xl flex items-center justify-center gap-2 hover:shadow-lg transition-all">
                <span>Ja paguei</span>
            </a>
            <div class="flex justify-between items-center px-2">
                <a class="text-xs text-primary font-semibold flex items-center gap-1 hover:underline" href="/como-doar">
                    <span class="material-symbols-outlined text-sm">support_agent</span>
                    Preciso de ajuda
                </a>
                <div class="flex items-center gap-1 opacity-50 grayscale">
                    <span class="text-[10px] uppercase font-bold">Powered by</span>
                    <span class="font-bold text-sm">Asaas</span>
                </div>
            </div>
        </div>
    </div>
    {{-- Footer Decorative --}}
    <div class="mt-8 flex items-center gap-4 text-muted text-sm">
        <span class="material-symbols-outlined">lock</span>
        <p>Pagamento 100% seguro processado pelo Asaas</p>
    </div>
</div>

{{-- Fixed Bottom Helper for Mobile --}}
<div class="lg:hidden fixed bottom-0 left-0 right-0 p-4 bg-white/80 backdrop-blur-md dark:bg-black/80 border-t border-[#e5e3dc] dark:border-[#3d3725]">
    <button class="w-full bg-primary text-white font-bold h-12 rounded-xl flex items-center justify-center gap-2">
        <span class="material-symbols-outlined">content_copy</span>
        Copiar codigo Pix
    </button>
</div>
@endsection
