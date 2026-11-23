/**
 * Brutheme — scroll animations (vanilla, no jQuery).
 *
 * Adds `.is-in-view` to `.br-timeline` and its `.br-timeline__item`
 * children as they enter the viewport, driving the animated spine and
 * staggered card reveal in brutheme.css.
 */
(function () {
	'use strict';

	if (!('IntersectionObserver' in window)) {
		// No observer support: show everything immediately.
		document.querySelectorAll('.br-timeline, .br-timeline__item').forEach(function (el) {
			el.classList.add('is-in-view');
		});
		return;
	}

	var root = document.getElementById('content') || document.body;

	var observer = new IntersectionObserver(
		function (entries) {
			entries.forEach(function (entry) {
				if (!entry.isIntersecting) {
					return;
				}
				entry.target.classList.add('is-in-view');
				observer.unobserve(entry.target);
			});
		},
		{ root: root, rootMargin: '0px 0px -60px 0px', threshold: 0.1 }
	);

	var timeline = document.querySelectorAll('.br-timeline, .br-timeline__item');
	Array.prototype.forEach.call(timeline, function (el) {
		observer.observe(el);
	});
})();
