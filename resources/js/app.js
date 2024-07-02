import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
import {get, post} from "./http.js";
import 'flowbite';
import Splide from '@splidejs/splide';
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';

Alpine.plugin(collapse)

window.Alpine = Alpine;

document.addEventListener("alpine:init", async () => {

  Alpine.data("toast", () => ({
    visible: false,
    delay: 5000,
    percent: 0,
    interval: null,
    timeout: null,
    message: null,
    close() {
      this.visible = false;
      clearInterval(this.interval);
    },
    show(message) {
      this.visible = true;
      this.message = message;

      if (this.interval) {
        clearInterval(this.interval);
        this.interval = null;
      }
      if (this.timeout) {
        clearTimeout(this.timeout);
        this.timeout = null;
      }

      this.timeout = setTimeout(() => {
        this.visible = false;
        this.timeout = null;
      }, this.delay);
      const startDate = Date.now();
      const futureDate = Date.now() + this.delay;
      this.interval = setInterval(() => {
        const date = Date.now();
        this.percent = ((date - startDate) * 100) / (futureDate - startDate);
        if (this.percent >= 100) {
          clearInterval(this.interval);
          this.interval = null;
        }
      }, 30);
    },
  }));

  Alpine.data("productItem", (product) => {
    return {
      product,
      addToCart(quantity = 1) {
        post(this.product.addToCartUrl, {quantity})
          .then(result => {
            this.$dispatch('cart-change', {count: result.count})
            this.$dispatch("notify", {
              message: "The item was added into the cart",
            });
          })
          .catch(response => {
            console.log(response);
          })
      },
      removeItemFromCart() {
        post(this.product.removeUrl)
          .then(result => {
            this.$dispatch("notify", {
              message: "The item was removed from cart",
            });
            this.$dispatch('cart-change', {count: result.count})
            this.cartItems = this.cartItems.filter(p => p.id !== product.id)
          })
      },
      changeQuantity() {
        post(this.product.updateQuantityUrl, {quantity: product.quantity})
          .then(result => {
            this.$dispatch('cart-change', {count: result.count})
            this.$dispatch("notify", {
              message: "The item quantity was updated",
            });
          })
      },
    };
  });
  
  Alpine.data('lightbox', () => ({
    isOpen: false,
    imageUrl: '',
    openLightbox(url) {
        this.imageUrl = url;
        this.isOpen = true;
    }
  }))
  
});

Alpine.start();

document.getElementById('toggle-theme').addEventListener('click', function() {
  document.documentElement.classList.toggle('dark');
});

const toggleThemeButton = document.getElementById('toggle-theme');

toggleThemeButton.addEventListener('click', function() {
    toggleThemeButton.classList.toggle('dark');
});

// SPLIDE
document.addEventListener( 'DOMContentLoaded', function () {
  // Portfolio
var main = new Splide( '#main-carousel', {
  type      : 'fade',
  rewind    : true,
  pagination: false,
  arrows    : false,
  fixedWidth  : '100%',
  fixedHeight : '100vh',
});

var thumbnails = new Splide( '#thumbnail-carousel', {
  type        : 'loop',
  gap         : 10,
  rewind      : true,
  pagination  : false,
  isNavigation: true,
  focus       : 'center',
  fixedWidth  : '100%',
  fixedHeight : '100vh',
});

main.sync( thumbnails );
main.mount();
thumbnails.mount();
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
    var hr = slide.querySelector('.animate-hr');
    var h3 = slide.querySelector('.animate-h3');
    var h1 = slide.querySelector('.animate-h1');
    var p = slide.querySelector('.animate-p');
    var img = slide.querySelector('.animate-img');
    var caption = slide.querySelector('.animate-caption');
    var h5 = slide.querySelector('.animate-h5');
    var button = slide.querySelector('.animate-button');
    var border = slide.querySelector('.animate-border');
    var arrow = slide.querySelector('.animate-arrow');

    animateElement(hr, 200); // 0.2 segundos después
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
  
});

// Service galery
if (document.querySelector('#service_gallery')) {
  var servicegallery = new Splide('#service_gallery', {
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

  servicegallery.mount({ AutoScroll });
}
// Fin Service galery