// window.addEventListener("scroll", function () {
//     const navbar = document.querySelector('.navbar');
//     if (window.pageYOffset > 0) {
//         navbar.classList.add("nav-shadow");
//         navbar.classList.add("shadow-sm");
//     } else {
//         navbar.classList.remove("nav-shadow");
//         navbar.classList.remove("shadow-sm");
//     }
// });
// window.addEventListener("scroll", function () {
//     const navbar = document.querySelector('.navbar');
//     if (window.pageYOffset > 0) {
//         navbar.classList.add("nav-shadow");
//         navbar.classList.add("shadow-sm");
//     } else {
//         navbar.classList.remove("nav-shadow");
//         navbar.classList.remove("shadow-sm");
//     }
// });

const navbarNav = document.querySelector('.navbar-nav');
const content = document.querySelector('#content');
const btnSidebar = document.querySelector('#sidebarCollapse');
btnSidebar.addEventListener("click", function () {
    navbarNav.classList.toggle("on");
    content.classList.toggle("on");
});


const btnClose = document.querySelector('.btn-close');
btnClose.addEventListener("click", function (e) {
    navbarNav.classList.remove("on");
    content.classList.remove("on");
});
