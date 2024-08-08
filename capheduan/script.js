function toggleMenu() {
    var sidebar = document.getElementById("sidebar");
    var content = document.getElementById("content");
    if (sidebar.style.left === "-200px") {
        sidebar.style.left = "0";
        content.style.marginLeft = "210px"; // Điều chỉnh khoảng cách của content khi sidebar hiển thị
    } else {
        sidebar.style.left = "-200px";
        content.style.marginLeft = "10px"; // Trở lại khoảng cách ban đầu khi sidebar ẩn
    }
}


let slider = document.querySelector('.slider .list');
let items = document.querySelectorAll('.slider .list .items');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let dots = document.querySelectorAll('.slider .dots li');

let lengthItems = items.length - 1;
let active = 0;
next.onclick = function(){
    active = active + 1 <= lengthItems ? active + 1 : 0;
    reloadSlider();
}
prev.onclick = function(){
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    reloadSlider();
}
let refreshInterval = setInterval(()=> {next.click()}, 4000);
function reloadSlider(){
    slider.style.left = -items[active].offsetLeft + 'px';
    // 
    let last_active_dot = document.querySelector('.slider .dots li.active');
    last_active_dot.classList.remove('active');
    dots[active].classList.add('active');

    clearInterval(refreshInterval);
    refreshInterval = setInterval(()=> {next.click()}, 4000);

    
}

dots.forEach((li, key) => {
    li.addEventListener('click', ()=>{
         active = key;
         reloadSlider();
    })
})
window.onresize = function(event) {
    reloadSlider();
};


