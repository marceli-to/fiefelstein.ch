import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
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

  const init = () => {
    initSwiper();

    // Add event listener for variation.btn click
    document.querySelectorAll(selectors.variation.btn).forEach(btn => {
      btn.addEventListener('click', function(e) {
        toggleVariation(e.target.dataset.variationBtn);
      });
    });

  };

  const initSwiper = () => {
    swiper = new Swiper(selectors.swiper.container, {
      modules: [Navigation],
      direction: 'horizontal',
      slidesPerView: "1",
      centeredSlides: true,
      spaceBetween: "16",
      breakpoints: {
        1024: {
          slidesPerView: "2",
        },
      },
      navigation: {
        nextEl: selectors.swiper.btns.next,
        prevEl: selectors.swiper.btns.prev,
      },
    }); 
    
    const prevBtn = document.querySelector(selectors.swiper.btns.prev);
    const nextBtn = document.querySelector(selectors.swiper.btns.next);
    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        swiper.slidePrev();
      });
    }
    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        swiper.slideNext();
      });
    }

  };

  const toggleVariation = (uuid) => {

    // hide all variation wrappers
    document.querySelectorAll(selectors.variation.wrapper).forEach(wrapper => {
      wrapper.classList.add('hidden');
    });

    // show variation wrapper
    document.querySelector(`[data-variation-wrapper="${uuid}"]`).classList.remove('hidden');

  };

  return {
    init: init,
  };

})();

Product.init();

