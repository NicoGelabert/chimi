import Splide from '@splidejs/splide';
import { AutoScroll } from '@splidejs/splide-extension-auto-scroll';
// Service galery
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
// Fin Service galery