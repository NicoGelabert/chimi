import Splide from '@splidejs/splide';
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';

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
