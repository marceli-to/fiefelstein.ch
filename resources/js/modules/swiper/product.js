import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const Product = (function() {

  const selectors = {
    variation: {
      btn: '[data-variation-btn]',
      wrapper: '[data-variation-wrapper]',
    },
    swiper: {
      container: '.js-swiper-product',
      btns: {
        prev: '.js-swiper-prev',
        next: '.js-swiper-next',
      },
    },
  };

  let swiper = null;
  let currentProductUuid = null;

  const init = () => {
    initSwiper();

    document.querySelectorAll(selectors.variation.btn).forEach(btn => {
      btn.addEventListener('click', function(e) {
        const uuid = e.target.closest(selectors.variation.btn).dataset.variationBtn;
        toggleVariation(uuid);
      });
    });

    preselectVariationFromHash();

  };

  // When arriving via a variation card link (#variation-<slug>), preselect that
  // variation on load, reusing the same logic as the on-page switcher. The slug
  // is mapped back to the variation uuid via [data-variation-slug].
  const preselectVariationFromHash = () => {
    const match = window.location.hash.match(/^#variation-(.+)$/);
    if (!match) return;

    const slug = match[1];
    const wrapper = document.querySelector(`[data-variation-slug="${slug}"]`);
    if (wrapper) {
      toggleVariation(wrapper.dataset.variationWrapper);
    }
  };

  const initSwiper = () => {
    
    swiper = new Swiper(selectors.swiper.container, {
      modules: [Navigation],
      direction: 'horizontal',
      slidesPerView: "1",
      centeredSlides: true,
      spaceBetween: "16",
      breakpoints: {
        768: {
          slidesPerView: "1.2",
        },
        1024: {
          slidesPerView: "2",
        },
      },
      navigation: {
        nextEl: selectors.swiper.btns.next,
        prevEl: selectors.swiper.btns.prev,
      },
      on: {

        init: function () {
          const currentSlide = document.querySelector('.swiper-slide-active');
          currentProductUuid = currentSlide.dataset.productUuid;
        },

        slideChangeTransitionStart: function () {
          const currentSlide = document.querySelector('.swiper-slide-active');
          let nextProductUuid = currentSlide.dataset.productUuid;

          if (nextProductUuid && currentProductUuid !== nextProductUuid) {
            toggleVariation(nextProductUuid, false);
            currentProductUuid = nextProductUuid;
          }
        }
      },
    }); 
    
    const prevBtn = document.querySelector(selectors.swiper.btns.prev);
    const nextBtn = document.querySelector(selectors.swiper.btns.next);
    
    if (prevBtn) {
      prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        navigate('prev');
      });
    }
    
    if (nextBtn) {
      nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        navigate('next');
      });
    }
  };

  const navigate = (direction) => {
    const currentTranslate = swiper.translate;
    const slideWidth = swiper.slides[0].offsetWidth;
    const spaceBetween = swiper.params.spaceBetween;
    const moveAmount = slideWidth + spaceBetween;

    let targetTranslate;
    if (direction === 'prev') {
      targetTranslate = currentTranslate + moveAmount;
    } else {
      targetTranslate = currentTranslate;
    }
  
    swiper.translateTo(targetTranslate, 300);
  };

  const toggleVariation = (uuid, changeSlides = true) => {

    // hide all variation wrappers
    document.querySelectorAll(selectors.variation.wrapper).forEach(wrapper => {
      wrapper.classList.add('hidden');
    });

    // show variation wrapper
    document.querySelector(`[data-variation-wrapper="${uuid}"]`).classList.remove('hidden');

    // go to slide
    if (changeSlides) {
      goToSlide(uuid);
    }

  };

  const goToSlide = (uuid) => {
    const slide = document.querySelector(`[data-product-uuid="${uuid}"]`);
    if (!slide) return;
    const slides = document.querySelectorAll('.swiper-slide');
    const index = Array.from(slides).indexOf(slide);
    swiper.slideTo(index, 900);
  };

  return {
    init: init,
  };

})();

Product.init();

