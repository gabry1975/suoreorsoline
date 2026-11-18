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

    // Nel menu a hamburger "Il Collegio" si apre/chiude al tocco (sottovoci chiuse all'inizio).
    var dd = header.querySelector('.site-nav .dd');
    var ddLabel = dd ? dd.querySelector(':scope > div:first-child') : null;
    if (dd && ddLabel) {
      var isMobile = function () { return window.getComputedStyle(toggle).display !== 'none'; };
      ddLabel.setAttribute('role', 'button');
      ddLabel.setAttribute('aria-expanded', 'false');
      var flip = function () {
        if (!isMobile()) return;
        var open = dd.classList.toggle('is-open');
        ddLabel.setAttribute('aria-expanded', open ? 'true' : 'false');
      };
      ddLabel.addEventListener('click', flip);
      ddLabel.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); flip(); }
      });
      toggle.addEventListener('click', function () {
        if (!header.classList.contains('nav-open')) {
          dd.classList.remove('is-open');
          ddLabel.setAttribute('aria-expanded', 'false');
        }
      });
    }
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
        c.style.background = on ? '#b04a5a' : '#fff';
        c.style.color = on ? '#fff' : '#2a1a22';
        c.style.borderColor = on ? '#b04a5a' : '#e6d6da';
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

  // Home, "Dove siamo": le etichette Metropolitane / Mezzi di superficie / Stazione Centrale
  // cambiano la vista della mappa; un secondo clic torna al Collegio.
  // "Apri in Maps" apre Google Maps sulla vista selezionata.
  // Classi assegnate ai widget in Elementor: o-map-metro, o-map-bus, o-map-centrale, o-map-apri.
  var mapFrame = document.querySelector('.o-mappa-home iframe');
  if (mapFrame) {
    var enc = encodeURIComponent;
    var baseSrc = mapFrame.getAttribute('src');
    var addr = 'Via Adele Martignoni 8, 20124 Milano';
    try { addr = new URL(baseSrc, window.location.href).searchParams.get('q') || addr; } catch (e) {}
    var openLink = document.querySelector('.o-map-apri a.elementor-button');
    var baseHref = openLink ? openLink.getAttribute('href') : '';
    var views = {
      'o-map-metro': {
        embed: 'q=' + enc('metropolitana near ' + addr),
        open: 'https://www.google.com/maps/search/?api=1&query=' + enc('metropolitana vicino a ' + addr)
      },
      'o-map-bus': {
        embed: 'q=' + enc('fermata tram autobus near ' + addr),
        open: 'https://www.google.com/maps/search/?api=1&query=' + enc('fermata tram autobus vicino a ' + addr)
      },
      'o-map-centrale': {
        embed: 'saddr=' + enc(addr) + '&daddr=' + enc('Milano Centrale') + '&dirflg=w',
        open: 'https://www.google.com/maps/dir/?api=1&origin=' + enc(addr) + '&destination=' + enc('Milano Centrale') + '&travelmode=walking'
      }
    };
    var chips = [];
    var setView = function (cls) {
      var v = cls ? views[cls] : null;
      mapFrame.setAttribute('src', v ? 'https://maps.google.com/maps?' + v.embed + '&t=m&output=embed' : baseSrc);
      if (openLink) openLink.setAttribute('href', v ? v.open : baseHref);
      chips.forEach(function (c) {
        var on = c.cls === cls;
        c.el.classList.toggle('is-on', on);
        c.el.setAttribute('aria-pressed', on ? 'true' : 'false');
      });
    };
    Object.keys(views).forEach(function (cls) {
      var el = document.querySelector('.' + cls + ' .elementor-heading-title');
      if (!el) return;
      var chip = { cls: cls, el: el };
      chips.push(chip);
      el.setAttribute('role', 'button');
      el.setAttribute('tabindex', '0');
      el.setAttribute('aria-pressed', 'false');
      var toggle = function () { setView(el.classList.contains('is-on') ? null : cls); };
      el.addEventListener('click', toggle);
      el.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }
      });
    });
  }

  // Slider (Home, "Dicono di noi"): contenitore Elementor con classe o-slider, schede con classe o-slide.
  // Frecce e pallini sotto; rotazione automatica ogni 5 s, in pausa con mouse/tocco/focus
  // e disattivata se l'utente ha chiesto di ridurre le animazioni.
  document.querySelectorAll('.o-slider').forEach(function (sl) {
    var slides = Array.prototype.filter.call(sl.children, function (c) { return c.classList.contains('o-slide'); });
    if (slides.length < 2) return;
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var nav = document.createElement('div');
    nav.className = 'o-slider-nav';
    var prev = document.createElement('button');
    var next = document.createElement('button');
    var dots = document.createElement('div');
    prev.type = next.type = 'button';
    prev.setAttribute('aria-label', 'Recensione precedente'); prev.textContent = '←';
    next.setAttribute('aria-label', 'Recensione successiva'); next.textContent = '→';
    dots.className = 'o-slider-dots';
    nav.appendChild(prev); nav.appendChild(dots); nav.appendChild(next);
    sl.parentNode.insertBefore(nav, sl.nextSibling);

    var step = function () { return (slides[1].offsetLeft - slides[0].offsetLeft) || sl.clientWidth; };
    var maxIdx = function () { return Math.max(0, Math.round((sl.scrollWidth - sl.clientWidth) / step())); };
    var idx = function () { return Math.round(sl.scrollLeft / step()); };
    var go = function (i) {
      var m = maxIdx();
      if (i > m) i = 0;
      if (i < 0) i = m;
      sl.scrollTo({ left: i * step(), behavior: reduce ? 'auto' : 'smooth' });
      mark(i);
    };
    var buildDots = function () {
      dots.innerHTML = '';
      for (var i = 0; i <= maxIdx(); i++) {
        var b = document.createElement('button');
        b.type = 'button';
        b.setAttribute('aria-label', 'Vai alla recensione ' + (i + 1));
        (function (n) { b.addEventListener('click', function () { go(n); }); })(i);
        dots.appendChild(b);
      }
      mark();
    };
    var mark = function (target) {
      var cur = typeof target === 'number' ? target : idx();
      Array.prototype.forEach.call(dots.children, function (b, i) { b.classList.toggle('is-on', i === cur); });
    };
    prev.addEventListener('click', function () { go(idx() - 1); });
    next.addEventListener('click', function () { go(idx() + 1); });
    var t;
    sl.addEventListener('scroll', function () { clearTimeout(t); t = setTimeout(function () { mark(); }, 80); }, { passive: true });
    window.addEventListener('resize', buildDots);
    buildDots();

    if (!reduce) {
      var paused = false;
      var pause = function () { paused = true; };
      var resume = function () { paused = false; };
      [sl, nav].forEach(function (el) {
        el.addEventListener('mouseenter', pause);
        el.addEventListener('mouseleave', resume);
        el.addEventListener('focusin', pause);
        el.addEventListener('focusout', resume);
      });
      sl.addEventListener('touchstart', pause, { passive: true });
      setInterval(function () {
        if (!paused && !document.hidden) go(idx() + 1);
      }, 5000);
    }
  });
})();
