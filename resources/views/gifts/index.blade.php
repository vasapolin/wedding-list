@extends('layouts.app')

@section('title', 'Lista de Presentes - Ana & Lucas')

@section('content')
<div class="flex flex-col min-h-[calc(100vh-5rem)]">
    {{-- Content Area with Sidebar --}}
    <div class="flex-1 max-w-[1440px] mx-auto w-full flex">
        {{-- Items Registry Section --}}
        <div class="flex-1 px-6 lg:px-20 py-8 xl:border-r border-[#f4f3f0] dark:border-white/10">
            {{-- Title & Filters --}}
            <div class="mb-10" x-data="{ activeFilter: 'all' }">
                <h1 class="text-3xl font-black tracking-tight mb-2">Lista de Presentes Simbolicos</h1>
                <p class="text-muted max-w-2xl mb-8">Ajude-nos a construir nossa vida juntos contribuindo com experiencias e itens para nossa nova casa. Cada presente aqui e uma parte do nosso sonho.</p>
                <div class="flex flex-wrap gap-3 overflow-x-auto pb-2">
                    <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-primary text-white' : 'bg-white dark:bg-white/5 border border-[#f4f3f0] dark:border-white/10 hover:border-primary'" class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold whitespace-nowrap transition-all">
                        Todos os Itens
                    </button>
                    <button @click="activeFilter = '100'" :class="activeFilter === '100' ? 'bg-primary text-white' : 'bg-white dark:bg-white/5 border border-[#f4f3f0] dark:border-white/10 hover:border-primary'" class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium whitespace-nowrap transition-all">
                        Ate R$ 100
                    </button>
                    <button @click="activeFilter = '500'" :class="activeFilter === '500' ? 'bg-primary text-white' : 'bg-white dark:bg-white/5 border border-[#f4f3f0] dark:border-white/10 hover:border-primary'" class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium whitespace-nowrap transition-all">
                        R$ 100 - R$ 500
                    </button>
                    <button @click="activeFilter = 'premium'" :class="activeFilter === 'premium' ? 'bg-primary text-white' : 'bg-white dark:bg-white/5 border border-[#f4f3f0] dark:border-white/10 hover:border-primary'" class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium whitespace-nowrap transition-all">
                        Cotas Premium
                    </button>
                    <button @click="activeFilter = 'honeymoon'" :class="activeFilter === 'honeymoon' ? 'bg-primary text-white' : 'bg-white dark:bg-white/5 border border-[#f4f3f0] dark:border-white/10 hover:border-primary'" class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium whitespace-nowrap transition-all">
                        Lua de Mel
                    </button>
                </div>
            </div>

            {{-- Gift Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                {{-- Card 1 --}}
                <div class="group bg-white dark:bg-white/5 rounded-xl overflow-hidden border border-[#f4f3f0] dark:border-white/10 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="aspect-[4/3] bg-cover bg-center overflow-hidden relative" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC56CL6WHzMHq89c2ctX4XZarlrD2LE4-YoTXdNJN1tgilPCeRSqKIhba3BHVYPHu4ywe4pzMQkDSeUH-DgZH1amUziV6iMOvwcRcy02bLtaNtD8uCbQ28afxnK4pnh-HOmzoUDFM-y68hI9PZY5KmLe8ZcTU7v22ldz8Ui8D2gO1ab2mR7qDRyTew2YpTvaWZwWiSp9xujFbpNHkehosZB9pgfV-j2lPzX7VEPm6anN7FamuF_TvEBPE65k9mUtJUw2jkCaCfaAR2t')">
                        <div class="absolute top-3 right-3 bg-white/90 dark:bg-background-dark/90 px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase text-primary">Mais Pedido</div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-lg font-bold group-hover:text-primary transition-colors">Jantar Romantico em Paris</h3>
                        <p class="text-muted text-sm mt-1 mb-4 flex-1">Um jantar especial para celebrarmos nossa uniao na cidade luz.</p>
                        <div class="mb-4">
                            <div class="flex justify-between text-[11px] font-bold mb-1 uppercase tracking-wider">
                                <span class="text-primary">75% Presenteado</span>
                                <span class="text-muted">R$ 150 / R$ 200</span>
                            </div>
                            <div class="h-2 w-full bg-[#f4f3f0] dark:bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-[#f4f3f0] dark:border-white/10">
                            <div class="flex flex-col">
                                <span class="text-xl font-bold">R$ 50,00</span>
                                <span class="text-[10px] text-muted font-medium uppercase tracking-tighter">Ou 2x de R$ 25,00</span>
                            </div>
                            <a href="/doar" class="bg-primary hover:bg-primary/90 text-white size-10 rounded-xl flex items-center justify-center transition-all active:scale-95 shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Card 2 --}}
                <div class="group bg-white dark:bg-white/5 rounded-xl overflow-hidden border border-[#f4f3f0] dark:border-white/10 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="aspect-[4/3] bg-cover bg-center overflow-hidden" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDQCTQ877bsOkXEkkjZXwYxDAtDtvlnjd0KptqzfyedRvhOw-kQ1VDNs1jM05Tcqxp_LfYazo-vUpe9wXYxf4UKEtZM5s1wiZm3OHL0iqGTrzS-6jOEFAbJwEZchvHu0FUUuQJvbYdlx4TJHz6Iv-ihQyTR9Ry-1U31P_T2WeBMoM9O7O-FlQepMUB5xT0C4vkKECyf5xiXqetou4_aGCTc0ohz979qrzyF3SYCowvRpIcEVPIjAeusV_drOPkjjWTors7SCdYwQ0on')"></div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-lg font-bold group-hover:text-primary transition-colors">Passagens Aereas</h3>
                        <p class="text-muted text-sm mt-1 mb-4 flex-1">Contribuicao para as passagens da nossa viagem dos sonhos.</p>
                        <div class="mb-4">
                            <div class="flex justify-between text-[11px] font-bold mb-1 uppercase tracking-wider">
                                <span class="text-primary">30% Presenteado</span>
                                <span class="text-muted">R$ 600 / R$ 2.000</span>
                            </div>
                            <div class="h-2 w-full bg-[#f4f3f0] dark:bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: 30%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-[#f4f3f0] dark:border-white/10">
                            <div class="flex flex-col">
                                <span class="text-xl font-bold">R$ 200,00</span>
                                <span class="text-[10px] text-muted font-medium uppercase tracking-tighter">Cota unica</span>
                            </div>
                            <a href="/doar" class="bg-primary hover:bg-primary/90 text-white size-10 rounded-xl flex items-center justify-center transition-all active:scale-95 shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Card 3 --}}
                <div class="group bg-white dark:bg-white/5 rounded-xl overflow-hidden border border-[#f4f3f0] dark:border-white/10 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="aspect-[4/3] bg-cover bg-center overflow-hidden" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD4Y1FKcN9gT9-z-v0xdBiGinQ2G1UYCQm_830mLlcHuMU7oQHdga2GBRPHkz_c5oRRA8fGmV-iyYpoaRPUMwTKb5x9s01cpa8lTSFNHu_lnFr7P5nXX_A8ew59X_SMl2z_QTv5z6i2jpJH2F4epIoT3qF6D84MUiEKgUwqAIXaulqubTHuhB7tZVT92YFLK4IxQhMBr-ktJq4meU3WlSJgQW4-d_t_6scSvZBbCGlpwyEP9-KyrwcDLijnTMasVxyGi9-eUQYJ90ll')"></div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-lg font-bold group-hover:text-primary transition-colors">Kit Cozinha Premium</h3>
                        <p class="text-muted text-sm mt-1 mb-4 flex-1">Ajudando a equipar nosso novo lar com utensilios de qualidade.</p>
                        <div class="mb-4">
                            <div class="flex justify-between text-[11px] font-bold mb-1 uppercase tracking-wider">
                                <span class="text-primary">100% Presenteado</span>
                                <span class="text-green-500">CONCLUIDO</span>
                            </div>
                            <div class="h-2 w-full bg-[#f4f3f0] dark:bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500 rounded-full" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-[#f4f3f0] dark:border-white/10">
                            <div class="flex flex-col">
                                <span class="text-xl font-bold">R$ 120,00</span>
                                <span class="text-[10px] text-muted font-medium uppercase tracking-tighter">Ou 3x de R$ 40,00</span>
                            </div>
                            <button class="bg-[#f4f3f0] dark:bg-white/10 text-muted cursor-not-allowed size-10 rounded-xl flex items-center justify-center transition-all" disabled>
                                <span class="material-symbols-outlined">check</span>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Card 4 --}}
                <div class="group bg-white dark:bg-white/5 rounded-xl overflow-hidden border border-[#f4f3f0] dark:border-white/10 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="aspect-[4/3] bg-cover bg-center overflow-hidden" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAwEQlu9uq-3VeTvsTphnljdhisfwbxZLx1YNq2deoPuJgjkMs_f8RDHWk5PM_TsLZyLwZjeUgS9wxfDGGzRtCWY1c1Mivt5N7UdWICUcpTizBIAzUBHBmLdoFERP_zVGbH2tL2tLyUAu7p0bdWEysYHV0jcgd9uVwn5KFm8pZpaDnEpgMW_lMj4X7_7zSR5EbeNl-6g09wDJ-0ZQCWfVAaD70BCSWWRK-WhdZqZvy1iCrgpMiy_ErbiBKFMlOIsJ9sNplgnAolG5e4')"></div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-lg font-bold group-hover:text-primary transition-colors">Dia de Spa para o Casal</h3>
                        <p class="text-muted text-sm mt-1 mb-4 flex-1">Um momento de relaxamento pos-casamento para recarregarmos as energias.</p>
                        <div class="mb-4">
                            <div class="flex justify-between text-[11px] font-bold mb-1 uppercase tracking-wider">
                                <span class="text-primary">15% Presenteado</span>
                                <span class="text-muted">R$ 45 / R$ 300</span>
                            </div>
                            <div class="h-2 w-full bg-[#f4f3f0] dark:bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: 15%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-[#f4f3f0] dark:border-white/10">
                            <div class="flex flex-col">
                                <span class="text-xl font-bold">R$ 150,00</span>
                                <span class="text-[10px] text-muted font-medium uppercase tracking-tighter">Cota Unica</span>
                            </div>
                            <a href="/doar" class="bg-primary hover:bg-primary/90 text-white size-10 rounded-xl flex items-center justify-center transition-all active:scale-95 shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Card 5 --}}
                <div class="group bg-white dark:bg-white/5 rounded-xl overflow-hidden border border-[#f4f3f0] dark:border-white/10 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="aspect-[4/3] bg-cover bg-center overflow-hidden relative" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAM0XvT7a9-f2KSYpD0GAMi-bEzEtobUSwQ_vLQUFKqRKbYywq6I91peaXHtGJK_Xe1v3PDD8KlRLi2FaKbFk4I1jxLx7gMU1zFh2Y-1xn1F6DteMNBx0ZVnaeURykCGHSm8nQVGRM19oXvMqQMiC3QScWYyaCrkxQ0ADtXarWLHT8kzEeIn4w4w4xVDKRFaF-qSyleJ7nK2mw8JR4ZUjGlRT_3npsH770pF6T6o_7smo4iyfKsxDRj1aosaRNaIUXQOutj2fZrn5L_')">
                        <div class="absolute top-3 right-3 bg-primary text-white px-3 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase">Essencial</div>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-lg font-bold group-hover:text-primary transition-colors">Adega dos Noivos</h3>
                        <p class="text-muted text-sm mt-1 mb-4 flex-1">Ajude-nos a iniciar nossa colecao de vinhos para momentos especiais.</p>
                        <div class="mb-4">
                            <div class="flex justify-between text-[11px] font-bold mb-1 uppercase tracking-wider">
                                <span class="text-primary">50% Presenteado</span>
                                <span class="text-muted">R$ 250 / R$ 500</span>
                            </div>
                            <div class="h-2 w-full bg-[#f4f3f0] dark:bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: 50%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-[#f4f3f0] dark:border-white/10">
                            <div class="flex flex-col">
                                <span class="text-xl font-bold">R$ 80,00</span>
                                <span class="text-[10px] text-muted font-medium uppercase tracking-tighter">Ou 4x de R$ 20,00</span>
                            </div>
                            <a href="/doar" class="bg-primary hover:bg-primary/90 text-white size-10 rounded-xl flex items-center justify-center transition-all active:scale-95 shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Card 6 --}}
                <div class="group bg-white dark:bg-white/5 rounded-xl overflow-hidden border border-[#f4f3f0] dark:border-white/10 hover:shadow-xl transition-all duration-300 flex flex-col">
                    <div class="aspect-[4/3] bg-cover bg-center overflow-hidden" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDtFSFgEapZDsCOb0Q_2heZlSjxNbH-_iomx5Ww7JZotGSWsRb6HDiGs6bVjXQk7vpQG0Eq2bMvGMiakgEbh-mRGXT6rlNb_rPOjtbTjVPpsmV013VcrAn72r8dL9IxONDFqg2gp1PbvB0TXXxRddHO1BK-pmvwtNpP2xleM3iZ3lfgAEr61NCgLfsggD8hYEn_Y1wmPUT4t7Aw8VSt8Ij-QxeQhiTtxt0508iH66DMtFAsLs5xKIWighcljjzBChuFjRzgj5tKA90i')"></div>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-lg font-bold group-hover:text-primary transition-colors">Enxoval da Casa</h3>
                        <p class="text-muted text-sm mt-1 mb-4 flex-1">Roupas de cama, banho e detalhes que farao nossa casa mais aconchegante.</p>
                        <div class="mb-4">
                            <div class="flex justify-between text-[11px] font-bold mb-1 uppercase tracking-wider">
                                <span class="text-primary">85% Presenteado</span>
                                <span class="text-muted">R$ 850 / R$ 1.000</span>
                            </div>
                            <div class="h-2 w-full bg-[#f4f3f0] dark:bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-primary rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-[#f4f3f0] dark:border-white/10">
                            <div class="flex flex-col">
                                <span class="text-xl font-bold">R$ 100,00</span>
                                <span class="text-[10px] text-muted font-medium uppercase tracking-tighter">Cota Unica</span>
                            </div>
                            <a href="/doar" class="bg-primary hover:bg-primary/90 text-white size-10 rounded-xl flex items-center justify-center transition-all active:scale-95 shadow-lg shadow-primary/20">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Side Cart Drawer --}}
        <aside class="w-[380px] hidden xl:flex flex-col bg-white dark:bg-background-dark/50 sticky top-20 h-[calc(100vh-5rem)] border-l border-[#f4f3f0] dark:border-white/10">
            <div class="p-6 border-b border-[#f4f3f0] dark:border-white/10 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">shopping_bag</span>
                    <h2 class="font-bold text-lg">Seu Carrinho</h2>
                </div>
                <span class="bg-primary/10 text-primary px-2 py-0.5 rounded-full text-xs font-bold">2 Itens</span>
            </div>
            <div class="flex-1 overflow-y-auto p-6 space-y-6 custom-scrollbar">
                {{-- Cart Item 1 --}}
                <div class="flex gap-4">
                    <div class="size-20 rounded-lg bg-cover bg-center shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBdNs9P4nc2clzWbxc4qC44QUu4cFG__ki38fFqVRZfAtq0x5Z4_1sLZvFnYurTyYGNbYNWOa7mtpLyLHnFjCcORT6Gsdt5lVbhTkl2STBfMljpV0NQfOtYYn_QMn_BF_fwwheLYbyUBS_5S2APF45t5De8odrRkx7qZ4uVanf1AoTQg4FEYhe1D74f-mc2aCaXUR4tNn3lp7RwtI_rhpJzZ2ZNZ0Q6Ak8klwVeeTWk8b3VYhnL9zJT5Siu8H0ukx1kmUxv8B0jFGCu')"></div>
                    <div class="flex-1 flex flex-col justify-between py-1">
                        <div>
                            <h4 class="text-sm font-bold leading-none">Jantar em Paris</h4>
                            <p class="text-xs text-muted mt-1">1x R$ 50,00</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-primary">R$ 50,00</span>
                            <button class="text-muted hover:text-red-500 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Cart Item 2 --}}
                <div class="flex gap-4">
                    <div class="size-20 rounded-lg bg-cover bg-center shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBZDXpPl0Vrx_3YvzTivAARS-WNJnhWFs09tw7UgM4OlAEb78TarEtJ_QnJ0En1G7nGUVPEpbi1QkitLhm1y9Z6oKDVEo_hpS1b5sV_qsY05QC0V48SX4v-wc-bqc2duT5_1a8bl5f7w57iJjTvm_WiV2Wz6WZIYg7P_wQCCbgAggWESyRUV0Q_HOZssxDMilfDq3yZooZUIAj4weTTT7xKAkNwTSE1JMM_mJo4fLbBY-Cx_efpXoZpbqwMUXER_sA_AZ4VYPePILFn')"></div>
                    <div class="flex-1 flex flex-col justify-between py-1">
                        <div>
                            <h4 class="text-sm font-bold leading-none">Passagens Aereas</h4>
                            <p class="text-xs text-muted mt-1">1x R$ 200,00</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-primary">R$ 200,00</span>
                            <button class="text-muted hover:text-red-500 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- Message to couple --}}
                <div class="p-4 bg-primary/5 rounded-xl border border-primary/10">
                    <p class="text-[11px] font-bold text-primary uppercase tracking-wider mb-2">Mensagem aos noivos</p>
                    <textarea class="w-full bg-white dark:bg-white/5 border-none rounded-lg text-xs placeholder:text-muted focus:ring-1 focus:ring-primary/50 resize-none h-20" placeholder="Deixe um recado carinhoso..."></textarea>
                </div>
            </div>
            {{-- Footer Summary --}}
            <div class="p-6 bg-white dark:bg-background-dark border-t border-[#f4f3f0] dark:border-white/10">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-muted text-sm">Subtotal</span>
                    <span class="font-medium text-sm">R$ 250,00</span>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <span class="text-lg font-bold">Total</span>
                    <span class="text-xl font-black text-primary">R$ 250,00</span>
                </div>
                <a href="/checkout" class="w-full bg-primary hover:bg-primary/90 text-white py-4 rounded-xl font-bold flex items-center justify-center gap-2 shadow-xl shadow-primary/20 transition-all active:scale-[0.98]">
                    <span>Continuar para pagamento</span>
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <div class="mt-4 flex items-center justify-center gap-2 text-muted">
                    <span class="material-symbols-outlined text-[16px]">lock</span>
                    <span class="text-[10px] font-medium uppercase tracking-widest">Pagamento seguro via ASAAS</span>
                </div>
            </div>
        </aside>
    </div>
</div>

{{-- Mobile Floating Cart Button --}}
<div class="xl:hidden fixed bottom-6 right-6 z-50">
    <button class="size-16 rounded-full bg-primary text-white shadow-2xl flex items-center justify-center relative">
        <span class="material-symbols-outlined text-[28px]">shopping_cart</span>
        <span class="absolute -top-1 -right-1 size-6 bg-red-500 rounded-full text-[10px] font-bold flex items-center justify-center border-2 border-white">2</span>
    </button>
</div>
@endsection
