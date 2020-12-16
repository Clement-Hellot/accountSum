var modal =document.getElementById("modal");
var modalContent;

document.getElementById('addIcon').addEventListener('click', function () {
    modalContent = document.getElementById('formLibCat');
    modalContent.style.display  ="block";
    modal.style.display = "block";
});

document.getElementById('addCat').addEventListener('click', function () {
  modalContent = document.getElementById('formCat');
  modalContent.style.display  ="block";
  modal.style.display = "block";
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    modalContent.style.display = "none";
  }
} 