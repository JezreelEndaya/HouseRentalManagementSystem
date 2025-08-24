var modal = document.querySelector('.modal');
var modalBtn = document.querySelector('.modal-btn');
var closeModal = document.querySelector('.close-modal');

window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

closeModal.onclick = function(){

    modal.style.display = "none";

};

modalBtn.addEventListener('click',function(){
    modal.style.display = "block";
});
