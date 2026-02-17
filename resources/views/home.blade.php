@extends('layouts.app')

@section('title', 'Ana & Lucas - Lista de Casamento')

@section('content')
{{-- Hero Section --}}
<section class="px-4 py-8 md:px-10 md:py-12">
    <div class="max-w-[1200px] mx-auto">
        <div class="relative min-h-[560px] flex flex-col items-center justify-center text-center rounded-xl overflow-hidden px-6 py-12" style='background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCvMtCWhcTbVkgVsBmhbzBaowe-yn9aKgha_PWQSrK_cpPt4RpBgXU71rQcc9_MSVu2hv0nNIQ7jsI47fzze2vGjESbjJaSf10oG4jdiFyC1aRZ5SlPhKwSHISTuaooCl4ryfYg5AvrGkI4HjUXXTzuhr0I2-A54aaNQXL4JfwSZyll1_C7H-vRknRKsOVIiuIr2nMVSZW-h0T7TBq2gkKqu1LzorpQuajuEgkn8h7SIB7V3aeoT-0zc7jrZcGZBS0LPpgQCeSUlTS-"); background-size: cover; background-position: center;'>
            <div class="max-w-3xl space-y-6">
                <h1 class="text-white text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
                    Nossa Jornada Comeca Aqui
                </h1>
                <div class="flex flex-col items-center gap-2">
                    <span class="inline-block px-4 py-1 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-medium uppercase tracking-widest">
                        12 de Outubro de 2024
                    </span>
                    <p class="text-white/90 text-lg md:text-xl font-light">
                        Celebre conosco este momento especial e ajude-nos a construir nosso lar.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-6">
                    <a href="/doar" class="bg-primary hover:bg-[#b88d12] text-white px-8 py-4 rounded-xl font-bold text-lg transition-all shadow-lg flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">redeem</span>
                        Fazer uma doacao
                    </a>
                    <a href="/mensagens" class="bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">chat_bubble</span>
                        Deixar uma mensagem
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- How it Works Section --}}
<section class="py-20 bg-white dark:bg-[#1a170e]" id="como-funciona">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-4">
            <h2 class="text-3xl md:text-4xl font-bold tracking-tight">Como Funciona</h2>
            <p class="text-gray-600 dark:text-gray-400">Contribuir para o nosso sonho e simples, seguro e cheio de carinho.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="flex flex-col items-center text-center space-y-4 p-8 rounded-2xl border border-[#e5e3dc] dark:border-[#3a3526] bg-background-light dark:bg-background-dark/50">
                <div class="size-16 flex items-center justify-center bg-primary/10 text-primary rounded-full mb-2">
                    <span class="material-symbols-outlined text-3xl">card_giftcard</span>
                </div>
                <h3 class="text-xl font-bold">Escolha um Presente</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                    Navegue pela nossa lista de itens ou contribua com um valor livre para nossa lua de mel.
                </p>
            </div>
            <div class="flex flex-col items-center text-center space-y-4 p-8 rounded-2xl border border-[#e5e3dc] dark:border-[#3a3526] bg-background-light dark:bg-background-dark/50">
                <div class="size-16 flex items-center justify-center bg-primary/10 text-primary rounded-full mb-2">
                    <span class="material-symbols-outlined text-3xl">verified_user</span>
                </div>
                <h3 class="text-xl font-bold">Pagamento Seguro</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                    Utilize Pix ou Cartao com a seguranca e transparencia da plataforma de pagamentos Asaas.
                </p>
            </div>
            <div class="flex flex-col items-center text-center space-y-4 p-8 rounded-2xl border border-[#e5e3dc] dark:border-[#3a3526] bg-background-light dark:bg-background-dark/50">
                <div class="size-16 flex items-center justify-center bg-primary/10 text-primary rounded-full mb-2">
                    <span class="material-symbols-outlined text-3xl">volunteer_activism</span>
                </div>
                <h3 class="text-xl font-bold">Envie seu Carinho</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                    Sua contribuicao sera acompanhada de uma mensagem personalizada que guardaremos para sempre.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Gift Registry Grid --}}
<section class="py-20" id="lista">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="flex items-end justify-between mb-12">
            <div class="space-y-2">
                <h2 class="text-3xl md:text-4xl font-bold tracking-tight">Lista de Presentes</h2>
                <p class="text-gray-600 dark:text-gray-400">Alguns itens que nos ajudarao a comecar nossa nova vida.</p>
            </div>
            <a href="/presentes" class="hidden md:flex items-center gap-2 text-primary font-bold hover:underline">
                Ver lista completa <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <x-gift-card
                name="Jogo de Louca Classico"
                price="450,00"
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuAwie-iX_a55IAmOq-Xa7m89Tv4f2lWkM1c4-Y6rIjwoyWPQBbG0XzAvWeFpRu8depA_P7YElZgxrj0i9RmrBD7atkvJd_bUkeoqPpDvD6Xoq49-WAB9FFG-DCQQy6P9AD-qEULahlauRisnOREewKiz931WV1OLC3eCJ_IaY8q6S36ja9kPMCW95Q61qpZqv6BQPnqXzOz1Igz2P3KHF99X7abOC-WTLkkTGt1XECwUq8z6bHLdWc7TaU0qBoyhzKkTaokjZOMrnIr"
                :percentage="75"
                amountRaised="337,50"
            />
            <x-gift-card
                name="Jantar Romantico em Paris"
                price="800,00"
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuBm_FETkaVVismtxSiXhamvu9II4GE8zLxzLiU_C4qaOv0E2tz8sVBgZcd4CxBDUH73EKq_RJGgvX5xpcNUdlNhcX0y6HkdATt2qpu4gLnXR6M5Ey1GfajIWDWESXZfEvmvi76evsXRgbH_SGLlzRTKye2nlfY-WIkEb9Yl2t43x-mP-VD2m_dGUdv3sM36wzZItZzMHyJYQy6X7yc-f0M_JivyDGraeOInKPZUVORD2ejRPb-JKgBBI3m_0OUVF-0ns13xmpJyJSkQ"
                :percentage="40"
                amountRaised="320,00"
            />
            <x-gift-card
                name="Maquina de Cafe Espresso"
                price="1.200,00"
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuDKIUyT2uQjg2UnnJfvn9ohkLQtl_RDnP0U-YfjOHPVp5jfuQChfvkwhjq_F6FfPmWZ0q4B56q_SglqC9r-Wfv-lpCITM_y13E2SH90KkLggh9PVY84W5-cnpQ6Ius9u1XVxwntlNh-Q5ZxmBw9bs4hyjU4VdGMVuQvRSrb6-bjedvv5Nvbq75Eb_JFuncgMa8rxjDKlJLXwXesSKbLiGjqMRbG_otzL7z8EFTRr1l34Rlf7EobyoIhSVF-RDRtFNEVzFLr6J9wsKYt"
                :percentage="15"
                amountRaised="180,00"
            />
            <x-gift-card
                name="Enxoval de Cama Luxury"
                price="600,00"
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuC6F1SUPwYR4goMSrzIIDpd69Od4MB2v-lcTppjUripRtGzXGcNu50-1t6a0q97tubc7FtC0gs2P_PGYyA1JTrX4ziAm_DM_nFHusoUi4U0Arv3oJws1OAagLy3cR7q8_G0hnSKSErrJl_tawo6F8huPLKQl_V3WQ9ujB-QC6vOYFxILC1qXGsZ3HQJvUvZpyA3dVdfzX3cFim9MMoZZ8GxmBQTg1WW7t5ffcoVw2o3ojotIB1ke-gZQRVqbd_eqHVJncYvgwMaXj63"
                :percentage="90"
                amountRaised="540,00"
            />
            <x-gift-card
                name="Fundo para o Sofa Novo"
                price="3.500,00"
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuDnxH7VGy2ZmUUOiYLYsTfwRSJhkUSEYbidoxcH8yOnB--_kZKc20kLWB96OSe2eN7VQt4-OSdGLpV1Efsu_5xm5USP6nhCOsQr1CPwc1d_SEMpwFHsnj6KmuSlYb5u_eWBZm7kiLt6OQwhmo6VVOxITTyzxx8z95BvwMKjyojaoYrvXqKVIw7e3T7zVbrLZ_PtCIm-FqNjttVZ_7I2lMPksigjbVfPWbjZAb8ZrAnR5ldl5KflsHoGLzHa52oqsEtnyzdsDIS5Lu2q"
                :percentage="30"
                amountRaised="1.050,00"
            />
            <x-gift-card
                name="Passagens Lua de Mel"
                price="5.000,00"
                image="https://lh3.googleusercontent.com/aida-public/AB6AXuARLZjUFovOkPvWyos2ZgaHWT8JFs1DMB8BMjv37lmmRfEwPkARXBUnrtyj7II28lphuyZDBEessZ29DBRpNAw-q0Kbg6d8ChNuO3JOPSXRfipBtQnvXWHXwFdA9kT9dph7s01bhMhFkB3LLbH4yZMpf59yCiEcqGaPaCI46d0xdW_0MaquI64pFYfehLMhbZANoxqSHWiZkQHa7r9GMQ_CgSN5NbWjkK8IYbHYm5sStgdylnlsHbc_0256TMdOi33KvlDqMkV0eSAT"
                :percentage="55"
                amountRaised="2.750,00"
            />
        </div>
        <div class="mt-12 text-center md:hidden">
            <a href="/presentes" class="inline-block bg-primary/10 text-primary px-8 py-3 rounded-xl font-bold">Ver lista completa</a>
        </div>
    </div>
</section>

{{-- Gallery Preview --}}
<section class="py-20 bg-white dark:bg-[#1a170e]" id="galeria">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-12 space-y-4">
            <h2 class="text-3xl md:text-4xl font-bold tracking-tight">Nossa Galeria</h2>
            <p class="text-gray-600 dark:text-gray-400">Um pouco da nossa historia em fotos.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[200px] md:auto-rows-[250px]">
            <div class="rounded-xl bg-cover bg-center md:row-span-2" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD7kxuIvKn-4_Q62KWNiILpuzw2UUptwZkf2QwQVgbFqdo_3dHkeApdQt3uxz88ohrsj4ij0YQT0q7jGKK-jLk0n9pR7YczOGCFZrk9vaBmtbGB5J5xAYp_gjruAkID73GyckW7KmRVvfOrO1_KkVyGCmqv-jpzDnSR4NyQCKFDElWODDp57-NzxB-rMx7q9_QNiHTZniqE7bheUyfUjG0oNrOi6d8f0BCEtPBNjxqhxkVQ2n2C9UEkxQtj0vC9M7fC_tS8k1MG0mTo");'></div>
            <div class="rounded-xl bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuATOqT3CBNJDTzgKK6MjUTYQ_sdRLDYCHwPPvm7CJcR-55Qz_hPSmnRF9Mv5XO5EKWAWzLQowwK91v24qFml85brs_gTJcRlNHvfTswbivEFxSSGZIbEca_I27aeBhia7Xb0_FuJn-1ObT3UeozIoBRQERNZpxPI3_PLk0XMGYw-G4vXyPD9WamcRZ5glRyucf8evUMnw4wLfbmU5slrdgBb1BpOf3S4y-e0kG0TcHApS7tx5-KeMZPQtu39D71oNfMbjabHJwXkvHC");'></div>
            <div class="rounded-xl bg-cover bg-center md:col-span-2" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDPkEdljjXKGz0cL_Bh1IAFs-uSSd0MXIVA6R1yn4CdH668osNiQ-8_9wSLLNHDaXf4XgEcl4dGme1mDQE3TRBV2TDNY18y8_tZARygC00vIfnNzYcpDivJhPuRvou76BeiTwjIAeYlnNOuNIXqrTl_hAWww-eBaccejBz2PSj79bzkUQmgD2JubbsW49QL2a3yrhyo4kspmxG7lh0oO8VxACGhol9S3mLMjfAGdwujpXRmmfCM3hsMfAz5Q7I6rIz0-KuVCH82VHRJ");'></div>
            <div class="rounded-xl bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC5S52o5ZrbXZFXozQC0ac2yjMnCB831ip97to5cbM6u2q6P0aom92iwYbPRN2orhWKYgLJCOrFcybWdE9ihqXlIlByxryw3Ho3anXL4FJWTEe4uyBb27uTSdvQc5FScoZUyodyXU5BUiCyXl2kXjZ6HMbOa_VyH1OX5UlDVqvH3EEmWEVyE9CahR1qFDKy8DEbpkSZtmiOmMPMQA2qRreAFBRVrT8d8o-MHiL-dFOgVFJQ9-fMhG76SSWqJbdLhL2r0wQq4rE7myVL");'></div>
            <div class="rounded-xl bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCTtESxf5vOkqsME1TNLb7OsxE94tCqRsk5FOC18b39koNVDU_tgEUXyg9cktunXIRuIjMLd3dYolBJ0JN63wFUbEDJf6xkXquwUs5j4pf2ZAAV1HKz79npPeCIqGlozXTsNMcUrn9aFb9K7qQKzBUDx7JeQy-j77P0FhAJhMur7Q0svJpcxs8kLq-4O_blHbTMyitS_W3zxlp5VdqaTN060Gw7pKQjoXHVf6WU7KOii7nRYSuLWbNdNQnd3ne9SFbzm2nfE5sOqway");'></div>
            <div class="rounded-xl bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuD0fY_pXDDuPpFaPqJSN1LgyzFcMEkUGacQmvAysl3gh4CrJA2W3DBvW-PETqiEuJ48DHbjMXR3yIsM3jreWVRy5DuLf2QkAkZ27GBxFfa_bEtWDnePK9OUyNP51-alHpgN7dloikbpKx3zWCdbfd9wyg1Y2kkFA_H0IguPVp354G_obaATAH-iS4i2hOgeqnHoRjnwR35Y5SJLQoG-zHqIXDjOCbnBFkulHLo_BNPuCfxd-Tk5qVAgM655gIL1uWi_f0anAO_Evaes");'></div>
        </div>
    </div>
</section>

{{-- Contact Section --}}
<section class="py-20">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="bg-background-light dark:bg-[#1a170e] rounded-[2rem] border border-[#e5e3dc] dark:border-[#3a3526] p-8 md:p-16 flex flex-col md:flex-row gap-12 items-center">
            <div class="md:w-1/2 space-y-6">
                <h2 class="text-3xl md:text-5xl font-bold tracking-tight">Alguma duvida?</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    Estamos aqui para ajudar! Se voce tiver dificuldades com o site ou quiser nos enviar uma mensagem direta, use o formulario ao lado.
                </p>
                <div class="flex items-center gap-4 pt-4">
                    <div class="size-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">shield_with_heart</span>
                    </div>
                    <div class="space-y-1">
                        <p class="font-bold">Pagamentos 100% Seguros</p>
                        <p class="text-sm text-gray-500">Processado via Asaas com criptografia de ponta a ponta.</p>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2 w-full">
                <form class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <input class="bg-white dark:bg-background-dark border-[#e5e3dc] dark:border-[#3a3526] rounded-xl p-4 focus:ring-primary focus:border-primary transition-all" placeholder="Nome" type="text"/>
                        <input class="bg-white dark:bg-background-dark border-[#e5e3dc] dark:border-[#3a3526] rounded-xl p-4 focus:ring-primary focus:border-primary transition-all" placeholder="E-mail" type="email"/>
                    </div>
                    <textarea class="w-full bg-white dark:bg-background-dark border-[#e5e3dc] dark:border-[#3a3526] rounded-xl p-4 focus:ring-primary focus:border-primary transition-all" placeholder="Sua mensagem..." rows="4"></textarea>
                    <button class="w-full bg-primary hover:bg-[#b88d12] text-white py-4 rounded-xl font-bold text-lg transition-all shadow-lg" type="submit">Enviar Mensagem</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
