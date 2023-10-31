var contactBtn2 = document.querySelector(".modal-js");

// When the user clicks the eleme,t, open the modal 
function handleClickContact (e) {
  e.preventDefault()
  modal.style.display = "block";
  let input = document.querySelector('#refpre');
  let referenceText = document.querySelector('#reference').textContent;
      input.value = referenceText;
}

if(contactBtn2) {
  contactBtn2.onclick = (e) => handleClickContact(e);
}

// mouseover fleche navigation
let leftArrow = document.querySelector('.arrow_left')
let rightArrow  = document.querySelector('.arrow_right')
let previousImg = document.querySelector('.previous-img')
let nextImg = document.querySelector('.next-img')

if(leftArrow) {
leftArrow.addEventListener('mouseover', function() {
  if(!previousImg) return;
  previousImg.style.display = 'inline-block'
  nextImg.style.display = 'none';
})
}

if(rightArrow) {
rightArrow.addEventListener('mouseover', function() {
  if(!nextImg) return;
  nextImg.style.display = 'inline-block'
  previousImg.style.display = 'none';
})
}