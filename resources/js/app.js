import './bootstrap';
window.addEventListener('load', init);

function init(){
    let deleteButtons = document.querySelectorAll('.delete');

    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener('click', confirmDeleteHandler);
    })
}

function confirmDeleteHandler (e)
{
    if (confirm('Are you sure you want to delete this exercise?') === false)
    {
        e.preventDefault();
    }
}
