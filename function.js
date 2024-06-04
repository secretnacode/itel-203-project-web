// for removing the modal
var modal = document.querySelector('.modal');
var close_modal = document.getElementById("close_modal");
var cancel = document.getElementById("cancel_modal");
console.log(cancel);

close_modal.addEventListener("click", hide_content);
cancel.addEventListener("click", hide_content);

window.addEventListener('click', function(event){
    if(event.target == modal){
        modal.style.display = 'none';
    }
});