carousels = document.querySelectorAll('[id^=carousel_]');

if (carousels) {
	carousels.forEach(carousel => {

		const glider = document.querySelector(`#${carousel.id} .carousel__lista`);
		const gliderPrev = document.querySelector(`#${carousel.id} .carousel__anterior`);
		const gliderNext = document.querySelector(`#${carousel.id} .carousel__siguiente`);
		const gliderDots = document.querySelector(`#${carousel.id} ~ .carousel__indicadores`);

		window.addEventListener('load', e => {
			new Glider(glider, {
				slidesToShow: 1,
				slidesToScroll: 1,
				//Para indicar si se puee arrastrar
				// draggable: true,
				// Los indicadores de drag
				dots: gliderDots,
				arrows: {
					prev: gliderPrev,
					next: gliderNext
				},
				// Opciones para hacerlo responsive
				responsive: [
					{
						// screens greater than >= 775px
						breakpoint: 450,
						settings: {
							// Set to `auto` and provide item width to adjust to viewport
							slidesToShow: 2,
							slidesToScroll: 2,
							draggable: true
						}
					}, {
						// screens greater than >= 1024px
						breakpoint: 800,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 5
						}
					}
				]
			});
		});
	});
}
