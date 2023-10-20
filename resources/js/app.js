import './bootstrap';
window.addEventListener('load', init);

let form;
function init(){
    let checkboxes = document.querySelectorAll('.checkbox');
    form = document.querySelector('#form');

    let deleteButtons = document.querySelectorAll('.btn-danger');

    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener('click', confirmDeleteHandler);
    })

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', submitOnChange);
    })
}

function submitOnChange(){
        form.submit();
}

function confirmDeleteHandler (e)
{
    if (confirm('Are you sure you want to delete this exercise?') === false)
    {
        e.preventDefault();
    }
}
