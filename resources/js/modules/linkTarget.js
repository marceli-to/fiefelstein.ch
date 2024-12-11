(function() {
  const links = document.querySelectorAll('a');
  links.forEach(link => {
    const href = link.href;
    if (!href.includes('fiefelstein.ch') && !href.includes('#') && !href.startsWith('javascript:')) {
      link.setAttribute('target', '_blank');
    }
  });
})();