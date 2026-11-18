/* Interazioni del mockup: cookie, note UX, chip del form, salti nella pagina Chi Siamo. */
(function () {
  'use strict';

  function store(get, key, val) {
    try {
      if (get) return window.localStorage.getItem(key);
      window.localStorage.setItem(key, val);
    } catch (e) { return null; }
    return null;
  }

  // Menu a hamburger (sotto i 1100px).
  var header = document.querySelector('.site-header');
  var toggle = document.querySelector('.nav-toggle');
  if (header && toggle) {
    toggle.addEventListener('click', function () {
      var open = header.classList.toggle('nav-open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      toggle.setAttribute('aria-label', open ? 'Chiudi il menu' : 'Apri il menu');
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && header.classList.contains('nav-open')) toggle.click();
    });
  }

  // Banner cookie: visibile finché non si preme "Ok".
  var cookie = document.getElementById('orsoline-cookie');
  if (cookie) {
    if (store(true, 'orsoline_cookie_ok') !== '1') cookie.hidden = false;
    var ok = cookie.querySelector('[data-cookie-ok]');
    if (ok) ok.addEventListener('click', function () {
      cookie.hidden = true;
      store(false, 'orsoline_cookie_ok', '1');
      placeTop();
    });
  }

  // Bottone "Torna su": visibile dopo 500px di scorrimento.
  var top = document.getElementById('orsoline-top');
  function placeTop() {
    if (!top) return;
    // Se il banner cookie occupa l'angolo in basso a destra (mobile), il bottone sale sopra il banner.
    var off = 0;
    if (cookie && !cookie.hidden) {
      var c = cookie.getBoundingClientRect();
      if (c.right > window.innerWidth - 90) off = Math.round(window.innerHeight - c.top);
    }
    top.style.setProperty('--top-offset', off + 'px');
  }
  if (top) {
    var ticking = false;
    var update = function () {
      ticking = false;
      top.classList.toggle('is-visible', (window.pageYOffset || document.documentElement.scrollTop) > 500);
    };
    window.addEventListener('scroll', function () {
      if (!ticking) { ticking = true; window.requestAnimationFrame(update); }
    }, { passive: true });
    window.addEventListener('resize', placeTop);
    top.addEventListener('click', function () {
      var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
    });
    placeTop();
    update();
  }

  // Pannello "Note UX": aperto all'inizio, si chiude con × e si riapre con "NOTE UX".
  var notes = document.getElementById('orsoline-notes');
  var notesBtn = document.getElementById('orsoline-notes-btn');
  if (notes && notesBtn) {
    var hide = notes.querySelector('[data-notes-hide]');
    if (hide) hide.addEventListener('click', function () { notes.hidden = true; notesBtn.hidden = false; });
    notesBtn.addEventListener('click', function () { notes.hidden = false; notesBtn.hidden = true; });
  }

  // Chip del form Contatti: scelta singola per gruppo, come nel mockup.
  document.querySelectorAll('[data-chip]').forEach(function (chip) {
    chip.addEventListener('click', function () {
      var group = chip.getAttribute('data-chip');
      var form = chip.closest('form');
      if (!form) return;
      form.querySelectorAll('[data-chip="' + group + '"]').forEach(function (c) {
        var on = c === chip;
        c.style.background = on ? '#a0244a' : '#fff';
        c.style.color = on ? '#fff' : '#2a1a22';
        c.style.borderColor = on ? '#a0244a' : '#e6d6da';
      });
      var input = form.querySelector('input[name="' + group + '"]');
      if (input) input.value = chip.getAttribute('data-value');
    });
  });

  // Linea storica e "In questa pagina": scorrimento morbido con 120px di margine per l'header.
  document.querySelectorAll('a[data-jump]').forEach(function (a) {
    a.addEventListener('click', function (e) {
      var el = document.getElementById(a.getAttribute('href').slice(1));
      if (!el) return;
      e.preventDefault();
      window.scrollTo({ top: el.getBoundingClientRect().top + window.scrollY - 120, behavior: 'smooth' });
    });
  });
})();
