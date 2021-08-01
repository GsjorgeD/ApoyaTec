const avatarImg = document.querySelector('.avatar-img');
const avatarMenu = document.getElementById('avatar-menu-desktop');

avatarImg.addEventListener('click', e => {
    if (window.screen.width > 1024) {
        avatarMenu.classList.toggle('active');
    }
})

document.addEventListener("click", (evt) => {
    // const flyoutElement = document.getElementById("flyout-example");
    let targetElement = evt.target; // clicked element

    do {
        if (targetElement == avatarMenu || targetElement == avatarImg) {
            // This is a click inside. Do nothing, just return.
            // document.getElementById("flyout-debug").textContent = "Clicked inside!";
            return;
            // console.log('click en el menu')
        }
        // Go up the DOM
        targetElement = targetElement.parentNode;
    } while (targetElement);

    // This is a click outside.
    // document.getElementById("flyout-debug").textContent = "Clicked outside!";
    avatarMenu.classList.remove('active');
    // console.log('deberia remover el menu');
});