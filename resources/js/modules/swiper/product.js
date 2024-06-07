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
    }
  };

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
    let swiper = new Swiper('.js-swiper-product', {
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
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });  
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

