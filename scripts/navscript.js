
window.onscroll = function() {sticking()};

const navbar = document.querySelector(".stick-nav");
let stick = navbar.offsetTop;


function sticking(){
    navbar.style.height = navbar.offsetHeight;
    if(window.pageYOffset >= stick){
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
};