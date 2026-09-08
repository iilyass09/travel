// Initialize AOS
document.addEventListener('DOMContentLoaded', function() {
  const isDetailPage = document.body.classList.contains('detail-page');
  if (!isDetailPage) {
    AOS.init({
      duration: 800,
      easing: 'ease-out-cubic',
      once: true,
      offset: 50,
      disable: window.innerWidth < 768 ? 'mobile' : false
    });
  }

  // Preloader
  const preloader = document.getElementById('preloader');
  setTimeout(() => {
    preloader.style.opacity = '0';
    setTimeout(() => { preloader.style.display = 'none'; }, 500);
  }, 1500);

  // Navbar scroll effect
  const navbar = document.getElementById('navbar');
  function handleScroll() {
    if (window.scrollY > 50) {
      navbar.classList.add('navbar-scrolled');
    } else {
      navbar.classList.remove('navbar-scrolled');
    }
  }
  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();

  // Active nav link
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link');
  
  function updateActiveNav() {
    const scrollPos = window.scrollY + 100;
    sections.forEach(section => {
      const top = section.offsetTop;
      const height = section.offsetHeight;
      const id = section.getAttribute('id');
      if (scrollPos >= top && scrollPos < top + height) {
        navLinks.forEach(link => {
          link.classList.remove('text-orange-400');
          if (link.getAttribute('href') === '#' + id) {
            link.classList.add('text-orange-400');
          }
        });
      }
    });
  }
  window.addEventListener('scroll', updateActiveNav, { passive: true });

  // Mobile menu toggle
  const mobileToggle = document.getElementById('mobile-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const hamburger = mobileToggle.querySelector('.hamburger');

  mobileToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('show');
    hamburger.classList.toggle('active');
  });

  // Close mobile menu on link click
  document.querySelectorAll('.mobile-nav-link').forEach(link => {
    link.addEventListener('click', () => {
      mobileMenu.classList.remove('show');
      hamburger.classList.remove('active');
    });
  });

  // Destination filter tabs
  const destTabs = document.querySelectorAll('.dest-tab');
  const destCards = document.querySelectorAll('.dest-card');

  destTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      destTabs.forEach(t => {
        t.classList.remove('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
        t.classList.add('bg-gray-100', 'text-gray-600');
      });
      tab.classList.add('active', 'bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-200');
      tab.classList.remove('bg-gray-100', 'text-gray-600');

      const filter = tab.getAttribute('data-filter');
      destCards.forEach(card => {
        if (filter === 'all' || card.getAttribute('data-category') === filter) {
          card.classList.remove('hidden-card');
          card.style.animation = 'fadeIn 0.4s ease forwards';
        } else {
          card.classList.add('hidden-card');
        }
      });
    });
  });

  // Counter animation
  const counters = document.querySelectorAll('.counter');
  let counterAnimated = false;

  function animateCounters() {
    if (counterAnimated) return;
    const heroSection = document.getElementById('beranda');
    const rect = heroSection.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom > 0) {
      counterAnimated = true;
      counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
          current += step;
          if (current < target) {
            counter.textContent = Math.ceil(current) + '+';
            requestAnimationFrame(updateCounter);
          } else {
            counter.textContent = target + '+';
          }
        };
        updateCounter();
      });
    }
  }

  window.addEventListener('scroll', animateCounters, { passive: true });
  setTimeout(animateCounters, 2000);

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // Add fadeIn keyframe
  const style = document.createElement('style');
  style.textContent = `
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  `;
  document.head.appendChild(style);

  // Back to top (diposisikan tepat di atas footer, tengah horizontal)
  const footerEl = document.querySelector('footer');
  const backToTop = document.createElement('button');
  backToTop.innerHTML = '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>';
  backToTop.className = 'back-to-top w-12 h-12 bg-blue-600 text-white rounded-full shadow-lg shadow-blue-300 flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300 hover:bg-blue-700 hover:scale-110';
  backToTop.id = 'back-to-top';
  backToTop.setAttribute('aria-label', 'Back to top');
  if (footerEl) {
    document.body.insertBefore(backToTop, footerEl);
  } else {
    document.body.appendChild(backToTop);
  }

  function positionBackToTop() {
    if (!footerEl) return;
    backToTop.style.top = (footerEl.offsetTop - backToTop.offsetHeight - 14) + 'px';
  }
  positionBackToTop();
  window.addEventListener('resize', positionBackToTop, { passive: true });

  window.addEventListener('scroll', () => {
    if (window.scrollY > 500) {
      backToTop.style.opacity = '1';
      backToTop.style.pointerEvents = 'auto';
    } else {
      backToTop.style.opacity = '0';
      backToTop.style.pointerEvents = 'none';
    }
  }, { passive: true });

  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
});
