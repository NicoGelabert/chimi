import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
import {get, post} from "./http.js";
import 'flowbite';


// Carga de scripts según la página
document.addEventListener("DOMContentLoaded", () => {
  
  // 🚀 Progreso de carga (porcentaje)
  let percentage = 0;
  const progressBar = document.getElementById('progress-bar');
  const interval = setInterval(function() {
    if (percentage < 100) {
      percentage += 1;
      document.getElementById('loader-percentage').innerText = percentage + '%';
      progressBar.style.width = percentage + '%';
    } else {
      clearInterval(interval);
      document.getElementById('loader-wrapper').style.display = 'none';
      const content = document.getElementById('body-content');
      content.style.display = 'block';
      setTimeout(function() {
        content.classList.add('fade-in');
      }, 10);
    }
  })

  
  // Captura de nombre de la página
  const page = document.body.dataset.page;  
  // carga de archivos js por nombre de página
  if (page === 'welcome') {
    import('./home.js');
  } else if (page === 'project.view') {
    import('./project.js');
  } 
  if (page === 'service.view' || page === 'project.view'){
    import('./animation.js');
  }
  if(page === 'welcome' || page === 'service.view'){
    import('./portfolio-gallery.js');
  }
});
// Fin carga de scripts según la página

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

// dark mode
const toggleThemeButtons = document.querySelectorAll('.toggle-theme');
function toggleTheme() {
  document.documentElement.classList.toggle('dark');
  toggleThemeButtons.forEach(button => {
    button.classList.toggle('dark');
  });

  if (document.documentElement.classList.contains('dark')) {
    localStorage.setItem('theme', 'dark');
  } else {
    localStorage.setItem('theme', 'light');
  }

}
toggleThemeButtons.forEach(button => {
  button.addEventListener('click', toggleTheme);
});

document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme');

  if (savedTheme === 'dark') {
    document.documentElement.classList.add('dark');
    toggleThemeButtons.forEach(button => {
      button.classList.add('dark');
    });
  }
});
// dark mode
