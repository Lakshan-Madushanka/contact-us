let selectBoxElements1 = document.querySelectorAll('.select-box');
let selectAllButton1 = document.querySelector('.select-all');
console.log('hwwwwwwwwwwwwwwwwwwww')
console.log(selectBoxElements)
let selectAll1 = function (event) {
    console.log('hello hello')
    for (let i = 0; i < selectBoxElements1.length; i++) {
        if (event.target.checked) {
            selectBoxElements1[i].checked = true;
            deleteButtonEnableStyle()
        } else {
            selectBoxElements1[i].checked = false;
            deleteButtonDisableStyle()
        }
    }
}

selectAllButton1.addEventListener('click', selectAll1)