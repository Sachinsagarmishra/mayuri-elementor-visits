(function ($) {
	'use strict';

	console.log("MEV Frontend JS file loaded.");

	var TestimonialSliderHandler = function ($element) {
		console.log("MEV Testimonial Slider Handler triggered.");
		
		var $wrapper = $element.find('.mev-testimonial-section');
		if (!$wrapper.length) {
			$wrapper = $element.hasClass('mev-testimonial-section') ? $element : $element.closest('.mev-testimonial-section');
		}
		if (!$wrapper.length) {
			console.log("MEV Testimonial wrapper not found.");
			return;
		}

		// Prevent double initialization
		if ($wrapper.data('mev-slider-initialized')) {
			console.log("MEV Slider already initialized on this element.");
			return;
		}
		$wrapper.data('mev-slider-initialized', true);

		var $track = $wrapper.find('.mev-testimonial-slides-track');
		var $slides = $wrapper.find('.mev-testimonial-slide');
		var $dots = $wrapper.find('.mev-slider-dot');
		
		console.log("MEV Slider Elements found:", $slides.length, "slides,", $dots.length, "dots.");

		if ($slides.length <= 1) return;

		var autoplay = $wrapper.attr('data-autoplay') === 'true' || $wrapper.data('autoplay') === true || $wrapper.data('autoplay') === 'true';
		var autoplaySpeed = parseInt($wrapper.attr('data-autoplay-speed') || $wrapper.data('autoplay-speed'), 10) || 5000;
		var transitionSpeed = parseInt($wrapper.attr('data-transition-speed') || $wrapper.data('transition-speed'), 10) || 500;
		var pauseOnHover = $wrapper.attr('data-pause-on-hover') === 'true' || $wrapper.data('pause-on-hover') === true || $wrapper.data('pause-on-hover') === 'true';

		console.log("MEV Settings:", { autoplay: autoplay, autoplaySpeed: autoplaySpeed, transitionSpeed: transitionSpeed, pauseOnHover: pauseOnHover });

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

			console.log("MEV Sliding to index:", currentIndex);

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

	// Run on document ready for static rendering fallback
	$(document).ready(function () {
		console.log("MEV Document Ready: Initializing sliders.");
		$('.mev-testimonial-section').each(function () {
			TestimonialSliderHandler($(this));
		});
	});

	// Register with Elementor Frontend
	$(window).on('elementor/frontend/init', function () {
		console.log("MEV Elementor Frontend Init: Registering hooks.");
		elementorFrontend.hooks.addAction('frontend/element_ready/mev_testimonials_visit.default', function ($scope) {
			TestimonialSliderHandler($scope);
		});
	});
})(jQuery);
