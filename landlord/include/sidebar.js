var hasSubmenuItems = document.querySelectorAll('.dropdown');

hasSubmenuItems.forEach(function (button) {
    var SubmenuItem = button.querySelector('.sub-menu');
    var icon = button.querySelector('.caret');

    button.addEventListener('click', function () {
        SubmenuItem.classList.toggle('active');
        icon.classList.toggle('fa-caret-down');
        icon.classList.toggle('fa-caret-up');
    });

    // Add click event listener to links inside the submenu
    var submenuLinks = SubmenuItem.querySelectorAll('a');
    submenuLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            // Prevent the click event from reaching the parent container
            event.stopPropagation();
        });
    });
});

