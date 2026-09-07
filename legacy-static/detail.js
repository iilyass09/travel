// ============================================================
// Interaksi khusus halaman detail paket wisata
// ============================================================
document.addEventListener('DOMContentLoaded', function () {
  // Inisialisasi AOS (script.js dilewati di halaman detail untuk menghindari double init)
  AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true,
    offset: 50,
    disable: window.innerWidth < 768 ? 'mobile' : false
  });

  // FAQ accordion
  document.querySelectorAll('.faq-item').forEach(function (item) {
    const btn = item.querySelector('.faq-question');
    if (!btn) return;
    btn.addEventListener('click', function () {
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item.open').forEach(function (i) {
        i.classList.remove('open');
      });
      if (!isOpen) item.classList.add('open');
    });
  });

  // Scroll spy untuk sub-nav halaman detail
  const subnavLinks = document.querySelectorAll('.subnav-link');
  const subnavSections = Array.from(subnavLinks)
    .map(function (l) { return document.querySelector(l.getAttribute('href')); })
    .filter(Boolean);

  function updateSubnavSpy() {
    const pos = window.scrollY + 200;
    let current = '';
    subnavSections.forEach(function (s) {
      if (pos >= s.offsetTop) current = '#' + s.getAttribute('id');
    });
    subnavLinks.forEach(function (l) {
      l.classList.toggle('active', l.getAttribute('href') === current);
    });
  }
  window.addEventListener('scroll', updateSubnavSpy, { passive: true });
  updateSubnavSpy();

  // Booking form -> buka WhatsApp dengan pesan terkomposisi
  const form = document.getElementById('booking-form');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const fd = new FormData(form);
      const nama = (fd.get('nama') || '').trim() || 'Saya';
      const tanggal = (fd.get('tanggal') || '').trim() || 'belum ditentukan';
      const pax = (fd.get('pax') || '').trim() || '-';
      const catatan = (fd.get('catatan') || '').trim() || '-';
      const paket = form.getAttribute('data-paket') || 'wisata';
      const msg = [
        'Halo Gaskeun Travel!',
        'Saya ' + nama + ' ingin memesan paket ' + paket + '.',
        'Tanggal wisata: ' + tanggal,
        'Jumlah orang: ' + pax + ' orang',
        'Catatan: ' + catatan,
        'Mohon konfirmasi ketersediaannya. Terima kasih!'
      ].join('\n');
      window.open('https://wa.me/6281234567890?text=' + encodeURIComponent(msg), '_blank');
    });
  }
});