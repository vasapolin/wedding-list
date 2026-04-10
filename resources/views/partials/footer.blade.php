<footer class="bg-black border-t border-surface-border pt-14 pb-10">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Couple name --}}
        <div class="text-center">
            <p class="font-serif text-2xl tracking-wide text-vanilla">
                Laura <span class="text-coastal italic">&</span> Victor
            </p>
        </div>

        {{-- Decorative separator --}}
        <div class="flex items-center justify-center gap-4 mt-6">
            <div class="h-px w-16 bg-coastal/30"></div>
            <svg class="size-3 text-coastal/50" viewBox="0 0 12 12" fill="currentColor" aria-hidden="true">
                <path d="M6 0C6 0 5 3 3 3C1 3 0 6 0 6C0 6 1 9 3 9C5 9 6 12 6 12C6 12 7 9 9 9C11 9 12 6 12 6C12 6 11 3 9 3C7 3 6 0 6 0Z"/>
            </svg>
            <div class="h-px w-16 bg-coastal/30"></div>
        </div>

        {{-- Nav links --}}
        <nav class="flex flex-wrap items-center justify-center gap-8 mt-8">
            <a class="font-sans text-sm tracking-wide text-ink-muted hover:text-coastal transition-colors" href="/">Início</a>
            <a class="font-sans text-sm tracking-wide text-ink-muted hover:text-coastal transition-colors" href="/presentes">Presentes</a>
            <a class="font-sans text-sm tracking-wide text-ink-muted hover:text-coastal transition-colors" href="/mensagens">Mensagens</a>
            <a class="font-sans text-sm tracking-wide text-ink-muted hover:text-coastal transition-colors" href="/como-doar">Como Funciona</a>
        </nav>

        {{-- Divider --}}
        <div class="decorative-line mt-10"></div>

        {{-- Wedding info --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-6 mt-8 font-sans text-xs tracking-widest uppercase text-ink-muted">
            <span>13 de Setembro &middot; 16:30</span>
            <span class="hidden sm:block text-surface-border">&middot;</span>
            <span>Joinville, SC</span>
        </div>

        {{-- Copyright --}}
        <p class="mt-8 text-center font-sans text-xs text-ink-muted/50">
            &copy; {{ date('Y') }} Laura &amp; Victor. Todos os direitos reservados.
        </p>

    </div>
</footer>
