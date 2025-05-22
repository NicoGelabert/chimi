import Splide from '@splidejs/splide';

var projectGalleryElement = document.querySelector('.project_gallery_images');
if (projectGalleryElement) {
    var projectGallery = new Splide(projectGalleryElement, {
        arrows      : true,
        breakpoints: {
          480: {
            perPage     : 2,
            }
        },
        gap         : '1rem',
        lazyLoad    : 'nearby',
        pagination  : false,
        perMove     : 1,
        perPage     : 4,
        type        : 'slide',
});

projectGallery.mount();
};
