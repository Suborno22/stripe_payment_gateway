function redirectTodoll() {
    var checkoutUrl = 'babydoll.html';
    window.location.href = checkoutUrl;
}
function scrollItems(direction) {
    const itemList = document.getElementById('item-list');

    if (direction === 'left') {
        itemList.scrollLeft -= 100; 
    } else if (direction === 'right') {
        itemList.scrollLeft += 100; 
    }
}
function openNav() {
    document.getElementById("mySidenav").style.width = "200px";
}
  
function closeNav() {
    document.getElementById("mySidenav").style.width = "0px";
}
document.addEventListener("DOMContentLoaded", function() {
    // Add event listeners to the navigation links
    document.querySelectorAll('#mySidenav a').forEach(function(navLink) {
        navLink.addEventListener('click', function(e) {
            e.preventDefault(); 
            var target = e.target.hash;
            document.querySelector(target).scrollIntoView({ behavior: 'smooth' });
        });
    });
 });