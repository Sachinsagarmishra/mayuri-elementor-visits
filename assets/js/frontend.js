(function ($) {
	'use strict';

	var TestimonialSliderHandler = function ($element) {
		var $wrapper = $element.find('.mev-testimonial-section');
		if (!$wrapper.length) return;

		var $track = $wrapper.find('.mev-testimonial-slides-track');
		var $slides = $wrapper.find('.mev-testimonial-slide');
		var $dots = $wrapper.find('.mev-slider-dot');
		
		if ($slides.length <= 1) return;

		var autoplay = $wrapper.data('autoplay') === true;
		var autoplaySpeed = parseInt($wrapper.data('autoplay-speed'), 10) || 5000;
		var transitionSpeed = parseInt($wrapper.data('transition-speed'), 10) || 500;
		var pauseOnHover = $wrapper.data('pause-on-hover') === true;

		var currentIndex = 0;
		var intervalId = null;

		// Set transition speed dynamically
		$track.css('transition-duration', transitionSpeed + 'ms');
		$slides.css('transition-duration', transitionSpeed + 'ms');

		function goToSlide(index) {
			if (index < 0) {
				index = $slides.length - 1;
			} else if (index >= $slides.length) {
				index = 0;
			}
			currentIndex = index;

			// Slide transition
			$track.css('transform', 'translateX(-' + (currentIndex * 100) + '%)');

			// Update active class on slides
			$slides.removeClass('active');
			$slides.eq(currentIndex).addClass('active');

			// Update dots active class
			$dots.removeClass('active');
			$dots.eq(currentIndex).addClass('active');
		}

		function startAutoplay() {
			if (!autoplay) return;
			stopAutoplay();
			intervalId = setInterval(function () {
				goToSlide(currentIndex + 1);
			}, autoplaySpeed);
		}

		function stopAutoplay() {
			if (intervalId) {
				clearInterval(intervalId);
				intervalId = null;
			}
		}

		// Click events on dots
		$dots.on('click', function () {
			var index = $(this).data('slide-to');
			goToSlide(index);
			if (autoplay) {
				startAutoplay(); // Reset timer on user interaction
			}
		});

		// Hover events for pause-on-hover
		if (autoplay && pauseOnHover) {
			$wrapper.on('mouseenter', stopAutoplay);
			$wrapper.on('mouseleave', startAutoplay);
		}

		// Initialize slider
		goToSlide(0);
		if (autoplay) {
			startAutoplay();
		}
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/mev_testimonials_visit.default', TestimonialSliderHandler);
	});
})(jQuery);
