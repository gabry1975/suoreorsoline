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

  // Banner cookie: visibile finché non si preme "Ok".
  var cookie = document.getElementById('orsoline-cookie');
  if (cookie) {
    if (store(true, 'orsoline_cookie_ok') !== '1') cookie.hidden = false;
    var ok = cookie.querySelector('[data-cookie-ok]');
    if (ok) ok.addEventListener('click', function () {
      cookie.hidden = true;
      store(false, 'orsoline_cookie_ok', '1');
    });
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
