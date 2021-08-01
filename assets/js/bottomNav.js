const bottomNav = document.getElementById('bottomNav');

function bottomNav($nav, className) {
    $nav.addEventListener('click', evt => {
        const $element = evt.target.closest('a');

        if ($element && !$element.classList.contains(className)) {
            $nav.querySelector(`.${className}`)?.classList.remove(className);
            $element.classList.add(className);
        }
    });
}

if (bottomNav) {
    bottomNav(bottomNav, 'bottomNav_listLink-active');
}