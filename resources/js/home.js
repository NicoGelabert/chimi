import Splide from '@splidejs/splide';
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';

// SPLIDE
// Portfolio
// var main = new Splide( '#main-carousel', {
//   type      : 'fade',
//   rewind    : true,
//   pagination: true,
//   arrows    : true,
// });

// var thumbnails = new Splide( '#thumbnail-carousel', {
//   type        : 'loop',
//   perPage     : 3,
//   gap         : 10,
//   rewind      : true,
//   pagination  : true,
//   arrows      : false,
//   isNavigation: true,
// });

// main.sync( thumbnails );
// main.mount();
// thumbnails.mount();

// thumbnails.on('mounted', function(){
//   limitPaginationDots(thumbnails);
// })

function limitPaginationDots(thumbnails) {
  const maxDots = 5;
  const pagination = thumbnails.Components.Pagination;
  const dots = pagination.data.list.childNodes;

  if (dots.length > maxDots) {
    const step = Math.ceil(dots.length / maxDots);
    const newDots = [];

    for (let i = 0; i < maxDots; i++) {
      const dotIndex = i * step;
      newDots.push(dots[dotIndex]);
    }

    // Clear existing dots
    pagination.data.list.innerHTML = '';

    // Append limited dots
    newDots.forEach(dot => {
      pagination.data.list.appendChild(dot);
    });
  }
}
// Fin Portfolio

  // Home Hero Banner
  var homeHeroBanner = new Splide('.home-hero-banner', {
      type        : 'fade',
      rewind      : true,
      pagination  : false,
      isNavigation: false,
      arrows      : false,
      focus       : 'center',
      autoplay    : 'play',
      interval    : '7000'
  });

  homeHeroBanner.on('mounted move', function() {
    var activeSlide = homeHeroBanner.Components.Slides.getAt(homeHeroBanner.index).slide;
    var previousSlide = homeHeroBanner.Components.Slides.getAt(homeHeroBanner.index - 1);
    if (previousSlide) {
      animateSlideOutElements(previousSlide.slide);
    }
    animateSlideElements(activeSlide);
  });

  homeHeroBanner.mount();

  function animateElement(element, delay) {
    setTimeout(() => {
      element.classList.add('active');
    }, delay);
  }

  function animateSlideElements(slide) {
    var h3 = slide.querySelector('.animate-h3');
    var h1 = slide.querySelector('.animate-h1');
    var p = slide.querySelector('.animate-p');
    var img = slide.querySelector('.animate-img');
    var caption = slide.querySelector('.animate-caption');
    var h5 = slide.querySelector('.animate-h5');
    var button = slide.querySelector('.animate-button');
    var border = slide.querySelector('.animate-border');
    var arrow = slide.querySelector('.animate-arrow');

    animateElement(h3, 500); // 0.5 segundos después
    animateElement(h1, 750); // 0.75 segundos después
    animateElement(p, 1000); // 1 segundo después
    animateElement(img, 1250); // 1.25 segundos después
    animateElement(caption, 1500); // 1.5 segundos después
    animateElement(border, 1750); // 1.75 segundos después (borde)
    animateElement(h5, 2000); // 2 segundos después (texto dentro del borde)
    animateElement(button, 2250); // 2.25 segundos después
    animateElement(arrow, 2500); // 2.5 segundos después (flecha)
  }

  function animateSlideOutElements(slide) {
    var elements = slide.querySelectorAll('.active');
    elements.forEach(function(element) {
      element.classList.remove('active');
    });
  }
  // Fin Home Hero Banner
  // Services home
  var homeServices = new Splide('#home-services', {
    perPage   : 3,
    gap       : '2rem',
    arrows    : false,
    breakpoints: {
      1024:{
        perPage:2,
        type   :'loop',
      },
      640: {
        perPage: 1,
      },
      480: {
        perPage: 1,
      },
    }
  });
  homeServices.mount();
// Fin Services Home

// Portfolio
var portfoliogallery = new Splide('#portfolio_gallery', {
    type        : 'loop',
    drag        : 'free',
    focus       : 'center',
    arrows      : false,
    pagination  : false,
    fixedWidth  : 300,
    autoScroll  : {
        speed     : 1,
    },
});

portfoliogallery.mount({ AutoScroll });
// Fin Portfolio
