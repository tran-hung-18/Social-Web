window.onload = function() {
    window.addEventListener('scroll', function() {
        let header = document.querySelector('.container-header');
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        scrollTop > 0 ? header.classList.add('header-scrolled') : header.classList.remove('header-scrolled');
    });
}
