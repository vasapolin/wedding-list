<header x-data="{ mobileOpen: false }" class="fixed top-0 left-0 right-0 z-50 bg-black/90 backdrop-blur-sm border-b border-surface-border">
    <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-5">
        <a href="/" class="flex items-center gap-3 font-serif text-2xl tracking-wide text-vanilla">
            <x-logo-icon class="size-8 text-coastal shrink-0"/>
            <span>Laura <span class="text-coastal italic">&</span> Victor</span>
        </a>
        <nav class="hidden md:flex items-center gap-10">
            <a class="text-sm font-sans tracking-wide text-ink-light hover:text-coastal transition-colors" href="/">Inicio</a>
            <a class="text-sm font-sans tracking-wide text-ink-light hover:text-coastal transition-colors" href="/como-doar">Como Funciona</a>
            <a class="text-sm font-sans tracking-wide text-ink-light hover:text-coastal transition-colors" href="/presentes">Presentes</a>
            <a class="text-sm font-sans tracking-wide text-ink-light hover:text-coastal transition-colors" href="/mensagens">Mensagens</a>
            <a href="/doar" class="border border-coastal text-coastal hover:bg-coastal hover:text-black px-6 py-2.5 text-sm font-sans tracking-wide transition-all">
                Presentear
            </a>
        </nav>
        <button @click="mobileOpen = !mobileOpen" class="md:hidden text-vanilla">
            <svg x-show="!mobileOpen" class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg x-show="mobileOpen" x-cloak class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    <div x-show="mobileOpen" x-cloak x-transition class="md:hidden bg-black border-t border-surface-border px-6 py-6 space-y-5">
        <a class="block text-sm font-sans tracking-wide text-ink-light hover:text-coastal transition-colors" href="/">Inicio</a>
        <a class="block text-sm font-sans tracking-wide text-ink-light hover:text-coastal transition-colors" href="/como-doar">Como Funciona</a>
        <a class="block text-sm font-sans tracking-wide text-ink-light hover:text-coastal transition-colors" href="/presentes">Presentes</a>
        <a class="block text-sm font-sans tracking-wide text-ink-light hover:text-coastal transition-colors" href="/mensagens">Mensagens</a>
        <a href="/doar" class="block text-center border border-coastal text-coastal hover:bg-coastal hover:text-black px-6 py-3 text-sm font-sans tracking-wide transition-all">
            Presentear
        </a>
    </div>
</header>
