const ProductFilter = (function() {

  const selectors = {
    btnCategory: '.js-filter-btn',
    btnReset: '.js-filter-reset-btn',
    product: '[data-product-category]',
  };

  const init = () => {
    const btns = document.querySelectorAll(selectors.btnCategory);
    btns.forEach(btn => {
      btn.addEventListener('click', apply);
    });

    const btnReset = document.querySelector(selectors.btnReset);
    btnReset.addEventListener('click', reset);
  };

  const apply = (e) => {

    // hide all products that don't match the category
    const products = document.querySelectorAll(selectors.product);
    products.forEach(product => {
      if (product.dataset.productCategory === e.target.dataset.category) {
        product.classList.remove('hidden');
      } else {
        product.classList.add('hidden');
      }
    });
  }

  const reset = () => {
    const products = document.querySelectorAll(selectors.product);
    products.forEach(product => {
      product.classList.remove('hidden');
    });
  }

  return {
    init: init,
  };

})();

ProductFilter.init();