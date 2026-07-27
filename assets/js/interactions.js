/* Neobrutheme — interactions (counters, bars, fade-in, stagger, tabs) */
(function() {
  'use strict';

  // ── Animated number counters ──
  function animateCount(el, target, opts) {
    opts = opts || {};
    var duration = opts.duration || 1200;
    var decimals = opts.decimals || 0;
    var prefix   = opts.prefix || '';
    var suffix   = opts.suffix || '';
    var start    = performance.now();

    function tick(now) {
      var t = Math.min((now - start) / duration, 1);
      t = 1 - Math.pow(1 - t, 3); // cubic ease-out
      var val = target * t;
      el.textContent = prefix + (decimals > 0 ? val.toFixed(decimals) : Math.floor(val)).toLocaleString() + suffix;
      if (t < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  function initCounters() {
    var counters = document.querySelectorAll('[data-count]');
    if (!counters.length || !('IntersectionObserver' in window)) return;
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting && !entry.target.dataset.counted) {
          entry.target.dataset.counted = '1';
          animateCount(entry.target, parseFloat(entry.target.dataset.count), {
            duration: 1200,
            decimals: parseInt(entry.target.dataset.decimals || 0, 10),
            prefix: entry.target.dataset.prefix || '',
            suffix: entry.target.dataset.suffix || '',
          });
        }
      });
    }, { threshold: 0.4 });
    counters.forEach(function(c) { observer.observe(c); });
  }

  // ── Animated progress bars ──
  function initBars() {
    var bars = document.querySelectorAll('[data-bar-value]');
    if (!bars.length || !('IntersectionObserver' in window)) return;
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting && !entry.target.dataset.animated) {
          entry.target.dataset.animated = '1';
          entry.target.style.width = entry.target.dataset.barValue + '%';
        }
      });
    }, { threshold: 0.3 });
    bars.forEach(function(b) {
      b.style.width = '0%';
      b.style.transition = 'width 1.2s cubic-bezier(0.16, 1, 0.3, 1)';
      observer.observe(b);
    });
  }

  // ── Fade-in on scroll ──
  function initFadeIn() {
    var fades = document.querySelectorAll('[data-fade-in]');
    if (!fades.length || !('IntersectionObserver' in window)) return;
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting && !entry.target.dataset.faded) {
          entry.target.dataset.faded = '1';
          entry.target.classList.add('fade-in-visible');
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
    fades.forEach(function(f) { observer.observe(f); });
  }

  // ── Stagger animations for groups ──
  function initStagger() {
    var groups = document.querySelectorAll('[data-stagger]');
    if (!groups.length || !('IntersectionObserver' in window)) return;
    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting && !entry.target.dataset.staggered) {
          entry.target.dataset.staggered = '1';
          var children = entry.target.children;
          for (var i = 0; i < children.length; i++) {
            (function(idx, el) {
              setTimeout(function() {
                el.classList.add('fade-in-visible');
              }, idx * 60);
            })(i, children[i]);
          }
        }
      });
    }, { threshold: 0.1 });
    groups.forEach(function(g) { observer.observe(g); });
  }

  // ── Tabs ──
  function initTabs() {
    document.querySelectorAll('[data-tab-group]').forEach(function(group) {
      var tabs = group.querySelectorAll('[data-tab]');
      var panels = group.querySelectorAll('[data-panel]');
      tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
          var target = tab.dataset.tab;
          tabs.forEach(function(t) {
            t.classList.remove('bg-[var(--color-red)]', 'text-white');
            t.classList.add('bg-white');
          });
          tab.classList.add('bg-[var(--color-red)]', 'text-white');
          tab.classList.remove('bg-white');
          panels.forEach(function(p) {
            p.classList.toggle('hidden', p.dataset.panel !== target);
          });
        });
      });
    });
  }

  // ── Init all ──
  function init() {
    initCounters();
    initBars();
    initFadeIn();
    initStagger();
    initTabs();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
