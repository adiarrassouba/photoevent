// Get the modal
var modal = document.getElementById("myModal");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// Get the button that opens the modal
var contactBtn = document.getElementById("menu-item-29");
// When the user clicks the eleme,t, open the modal 
contactBtn.onclick = function(e) {
  e.preventDefault()
  modal.style.display = "block";
}

// menu burger 
navBtn = document.querySelector('.nav-btn');
navList = document.querySelector('.nav-list');

navBtn.addEventListener('click', function() {
  const hasClassBurger = navBtn.classList.contains('burger-menu-logo');
  navBtn.classList.remove('cross-menu-logo');
  navBtn.classList.remove('burger-menu-logo');
  navList.classList.remove('closed-nav-list');
  navList.classList.remove('opened-nav-list');
  if(hasClassBurger) {
    navBtn.classList.add('cross-menu-logo');
    navList.classList.add('opened-nav-list');
  }
  else { 
    navBtn.classList.add('burger-menu-logo');
    navList.classList.add('closed-nav-list');

}
})
