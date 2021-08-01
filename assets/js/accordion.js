function InitAccordion(accordionListEl) {

    function toogleItems(headerEl) {
        const parentItemEl = headerEl.parentElement;
        const contentEl = headerEl.nextElementSibling;

        if (contentEl.style.height) {
            contentEl.style.height = "";
            parentItemEl.classList.remove("show");
            return;
        }

        const contentOriginalHeight = contentEl.scrollHeight;
        contentEl.style.height = `${contentOriginalHeight}px`;
        parentItemEl.classList.add("show");
    }

    accordionListEl.forEach(e => {
        e.addEventListener("click", (e) => {
            const headerEl = e.target.closest(".accordion-header");
            if (!headerEl) return;

            toogleItems(headerEl);
        });
    });

}

InitAccordion(document.querySelectorAll(".accordion-list"));
