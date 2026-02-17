<header x-data="{ mobileOpen: false }" class="fixed top-0 left-0 right-0 z-50 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-[#e5e3dc] dark:border-[#3a3526]">
    <div class="max-w-[1200px] mx-auto flex items-center justify-between px-6 py-4">
        <a href="/" class="flex items-center gap-3">
            <div class="text-primary">
                <span class="material-symbols-outlined text-3xl">favorite</span>
            </div>
            <h2 class="text-lg font-bold leading-tight tracking-tight uppercase">Ana & Lucas</h2>
        </a>
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-sm font-medium hover:text-primary transition-colors" href="/">Inicio</a>
            <a class="text-sm font-medium hover:text-primary transition-colors" href="/como-doar">Como Funciona</a>
            <a class="text-sm font-medium hover:text-primary transition-colors" href="/presentes">Lista de Presentes</a>
            <a class="text-sm font-medium hover:text-primary transition-colors" href="/mensagens">Mensagens</a>
            <a href="/doar" class="bg-primary hover:bg-[#b88d12] text-white px-5 py-2 rounded-lg text-sm font-bold transition-all shadow-sm">
                Fazer Doacao
            </a>
        </nav>
        <button @click="mobileOpen = !mobileOpen" class="md:hidden text-text-dark dark:text-white">
            <span x-show="!mobileOpen" class="material-symbols-outlined">menu</span>
            <span x-show="mobileOpen" x-cloak class="material-symbols-outlined">close</span>
        </button>
    </div>
    {{-- Mobile menu --}}
    <div x-show="mobileOpen" x-cloak x-transition class="md:hidden bg-background-light dark:bg-background-dark border-t border-[#e5e3dc] dark:border-[#3a3526] px-6 py-4 space-y-4">
        <a class="block text-sm font-medium hover:text-primary transition-colors" href="/">Inicio</a>
        <a class="block text-sm font-medium hover:text-primary transition-colors" href="/como-doar">Como Funciona</a>
        <a class="block text-sm font-medium hover:text-primary transition-colors" href="/presentes">Lista de Presentes</a>
        <a class="block text-sm font-medium hover:text-primary transition-colors" href="/mensagens">Mensagens</a>
        <a href="/doar" class="block text-center bg-primary hover:bg-[#b88d12] text-white px-5 py-3 rounded-lg text-sm font-bold transition-all shadow-sm">
            Fazer Doacao
        </a>
    </div>
</header>
