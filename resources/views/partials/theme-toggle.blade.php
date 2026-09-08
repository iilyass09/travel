<button id="theme-toggle" type="button" aria-label="Ganti tema gelap / terang" class="fixed bottom-20 md:bottom-6 right-6 z-[200] w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-full shadow-lg shadow-orange-500/40 flex items-center justify-center transform hover:scale-110 transition-transform duration-200">
  <svg id="theme-icon-moon" class="hidden w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
  <svg id="theme-icon-sun" class="hidden w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
</button>

<script>
  (function () {
    var btn = document.getElementById('theme-toggle');
    if (!btn) return;
    var iconMoon = document.getElementById('theme-icon-moon');
    var iconSun = document.getElementById('theme-icon-sun');

    function applyThemeIcon() {
      var dark = document.documentElement.classList.contains('dark');
      iconMoon.classList.toggle('hidden', dark);
      iconSun.classList.toggle('hidden', !dark);
    }
    applyThemeIcon();

    btn.addEventListener('click', function () {
      var dark = document.documentElement.classList.toggle('dark');
      try { localStorage.setItem('theme', dark ? 'dark' : 'light'); } catch (e) {}
      applyThemeIcon();
    });
  })();
</script>