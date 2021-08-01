const activeSearch = () => {
    const openSearchButton = document.getElementById('search-button')
    const closeSearchButton = document.getElementById('close-search-button')
    const mainSearch = document.getElementById('search-movile')

    if (openSearchButton && mainSearch && closeSearchButton) {
        openSearchButton.addEventListener('click', () => {
            mainSearch.classList.add('active')
        })
        closeSearchButton.addEventListener('click', () => {
            mainSearch.classList.remove('active')
        })
    }
}

activeSearch()

// Focus a inputs de busqueda
iconM = document.getElementById('search-button-movil');
iconM.addEventListener('click', () => {
    document.getElementById('search-input-movil').focus();
})

iconD = document.getElementById('search-button');

iconD.addEventListener('click', () => {
    // No se porque funciono xD
    if (window.screen.width > 640) {
        document.getElementById('search-input-movil').focus();
    }
    if (window.screen.width > 1200) {
        document.getElementById('search-input').focus();
    }
})

