let selectBoxElements = document.querySelectorAll('.select-box');
let deleteButton = document.querySelector('.delete-btn');
let selectAllButton = document.querySelector('.select-all');
let successElement = document.querySelector('.status__text');
let errorElement = document.querySelector('.error__text');
let searchErrorElement = document.querySelector('.search__error');

let csrfToken = document.querySelector("meta[name='csrf-token']").content

let deleteButtonEnableStyle = function () {
    deleteButton.style.cursor = 'pointer'
    deleteButton.style.opacity = 1
    deleteButton.removeAttribute('disabled');
}

let deleteButtonDisableStyle = function () {
    deleteButton.style.cursor = 'not-allowed'
    deleteButton.style.opacity = 0.6
    deleteButton.setAttribute('disabled', 'true');
}

let enableDeleteButton = function (selectBoxElements) {
    let counter = 0;

    for (let i = 0; i < selectBoxElements.length; i++) {
        if (selectBoxElements[i].checked) {
            counter++;
        }
        if (counter > 0) {
            deleteButtonEnableStyle()
        } else {
            deleteButtonDisableStyle()
        }
    }

}

let getSelectedValues = function (selectBoxElements) {
    let values = [];
    for (let i = 0; i < selectBoxElements.length; i++) {
        if (selectBoxElements[i].checked) {
            values.push(parseInt(selectBoxElements[i].value))
        }
    }
    return values;
}

let deleteSelected = function (route, selectBoxElements) {
    deleteButton.textContent = 'Deleting'
    let data = {
        'ids': getSelectedValues(selectBoxElements)
    }

    fetch(route, {
            headers: {
                "X-CSRF-Token": csrfToken,
                "Content-Type": 'application/json'
            },
            method: 'delete',
            //body: data
            body: JSON.stringify(data)

        }
    ).then(response => {
        console.log(response.status)
        if (response.status === 200) {
            deleteButton.textContent = 'Delete Selected'
            successElement.textContent = "Selected records deleted Successfully !"
            setTimeout(() => {
                window.location.reload();
            }, 1000)
        }

    }).catch(err => {
            console.log(err)
            deleteButton.textContent = 'Delete Selected'
            errorElement.textContent = "Error Occured !"
        })
}

let deleteButtonEnable = function (selectBoxElements) {
    for (let i = 0; i < selectBoxElements.length; i++) {
        selectBoxElements[i].addEventListener('click', () => {
            enableDeleteButton(selectBoxElements)
        })
    }
}

let selectAll = function (event, selectBoxElements) {
    for (let i = 0; i < selectBoxElements.length; i++) {
        if (event.target.checked) {
            selectBoxElements[i].checked = true;
            deleteButtonEnableStyle()
        } else {
            selectBoxElements[i].checked = false;
            deleteButtonDisableStyle()
        }
    }
}

selectAllButton.addEventListener('click', () => {
    selectAll(event, selectBoxElements)
})

deleteButtonEnable(selectBoxElements)

