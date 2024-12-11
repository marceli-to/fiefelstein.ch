(function() {
  const links = document.querySelectorAll('a');
  links.forEach(link => {
    if (!link.href.includes('fiefelstein.ch')) {
      link.setAttribute('target', '_blank');
    }
  });
})();