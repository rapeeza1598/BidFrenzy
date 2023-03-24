// // Define global variables
// var items = [] // array to store item objects
// var currentItemIndex = -1 // index of currently selected item

// // Define DOM elements
// var itemTable = document.getElementById("item-table")
// var addItemButton = document.getElementById("add-item-button")
// var editItemModal = document.getElementById("edit-item-modal")
// var editItemForm = document.getElementById("edit-item-form")
// var itemNameInput = document.getElementById("item-name-input")
// var itemDescriptionInput = document.getElementById("item-description-input")
// var itemStartingBidInput = document.getElementById("item-starting-bid-input")
// var saveItemButton = document.getElementById("save-item-button")

// // Load items from localStorage on page load
// window.addEventListener("load", function () {
//     if (localStorage.getItem("items") !== null) {
//         items = JSON.parse(localStorage.getItem("items"))
//     }
//     renderItems()
// })

// // Save items to localStorage on page unload
// window.addEventListener("unload", function () {
//     localStorage.setItem("items", JSON.stringify(items))
// })

// // Add event listeners to DOM elements
// addItemButton.addEventListener("click", function () {
//     currentItemIndex = -1
//     editItemForm.reset()
//     editItemModal.style.display = "block"
// })

// itemTable.addEventListener("click", function (event) {
//     var target = event.target
//     if (target.classList.contains("edit-btn")) {
//         currentItemIndex = parseInt(target.getAttribute("data-index"))
//         var currentItem = items[currentItemIndex]
//         itemNameInput.value = currentItem.name
//         itemDescriptionInput.value = currentItem.description
//         itemStartingBidInput.value = currentItem.startingBid
//         editItemModal.style.display = "block"
//     } else if (target.classList.contains("delete-btn")) {
//         var index = parseInt(target.getAttribute("data-index"))
//         items.splice(index, 1)
//         renderItems()
//     }
// })

// editItemForm.addEventListener("submit", function (event) {
//     event.preventDefault()
//     var name = itemNameInput.value.trim()
//     var description = itemDescriptionInput.value.trim()
//     var startingBid = parseFloat(itemStartingBidInput.value.trim())
//     if (name === "" || isNaN(startingBid)) {
//         return
//     }
//     if (currentItemIndex === -1) {
//         // Add new item
//         items.push({
//             name: name,
//             description: description,
//             startingBid: startingBid,
//         })
//     } else {
//         // Edit existing item
//         items[currentItemIndex].name = name
//         items[currentItemIndex].description = description
//         items[currentItemIndex].startingBid = startingBid
//     }
//     renderItems()
//     editItemModal.style.display = "none"
// })

// saveItemButton.addEventListener("click", function () {
//     editItemForm.dispatchEvent(new Event("submit"))
// })

// Render items in table
// function renderItems(myItem) {
//     itemTable.innerHTML = ""
//     for (var i = 0; i < myItem.length; i++) {
//         var item = myItem[i]
//         var row = document.createElement("tr")
//         var nameCell = document.createElement("td")
//         var descriptionCell = document.createElement("td")
//         var startingBidCell = document.createElement("td")
//         var actionsCell = document.createElement("td")
//         var editButton = document.createElement("button")
//         var deleteButton = document.createElement("button")
//         nameCell.textContent = item.name
//         descriptionCell.textContent = item.description
//         startingBidCell.textContent = "$" + item.startingBid.toFixed(2)
//         editButton.textContent = "Edit"
//         editButton.setAttribute("class", "edit-btn")
//         editButton.setAttribute("data-index", i)

//         deleteButton.textContent = "Delete"
//         deleteButton.setAttribute("class", "delete-btn")
//         deleteButton.setAttribute("data-index", i)
//         actionsCell.appendChild(editButton)
//         actionsCell.appendChild(deleteButton)
//         row.appendChild(nameCell)
//         row.appendChild(descriptionCell)
//         row.appendChild(startingBidCell)
//         row.appendChild(actionsCell)
//         itemTable.appendChild(row)
//     }
// }

async function getItem() {
    const response = await fetch("http://localhost:3000/controller/item.php", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })

    const data = await response.json()
    for (let index = 0; index < data.length; index++) {
        let tr = document.createElement("tr")
        let td = document.createElement("td")
        let td2 = document.createElement("td")
        let td3 = document.createElement("td")
        let td4 = document.createElement("td")
        let td5 = document.createElement("td")
        let td6 = document.createElement("td")
        let btn_edit = document.createElement("button")
        let btn_delete = document.createElement("button")
        btn_edit.onclick = function () {
            editItem(data[index].id)
        }
        btn_delete.onclick = function () {
            deleteItem(data[index].id)
        }
        td.innerHTML = data[index].auction_id
        td2.innerHTML = data[index].title
        td3.innerHTML = data[index].description
        td4.innerHTML = data[index].starting_bid
        td5.innerHTML = data[index].end_time
        btn_edit.innerHTML = "Edit"
        btn_delete.innerHTML = "Delete"
        btn_edit.setAttribute("class", "edit-btn")
        btn_delete.setAttribute("class", "delete-btn")
        btn_edit.setAttribute("data-index", data.id)
        btn_delete.setAttribute("data-index", data.id)
        td6.appendChild(btn_edit)
        td6.appendChild(btn_delete)
        tr.appendChild(td)
        tr.appendChild(td2)
        tr.appendChild(td3)
        tr.appendChild(td4)
        tr.appendChild(td5)
        tr.appendChild(td6)
        document.getElementById("tItem").appendChild(tr)
    }
}
function editItem(id) {
    document.getElementById("edit-item-modal").style.display = "block"
    document
        .getElementById("edit-item-form")
        .addEventListener("submit", function (event) {
            event.preventDefault()
            const data = {
                auction_id: document.getElementById("auction_id").value,
                title: document.getElementById("title").value,
                description: document.getElementById("description").value,
                starting_bid: document.getElementById("starting_bid").value,
                end_time: document.getElementById("end_time").value,
            }
            fetch("http://localhost:3000/controller/item.php?id=" + id, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then((data) => {
                    alert("Success:", data)
                })
                .catch((error) => {
                    alert("Error:", error)
                })
        })
}
function deleteItem(id) {
    if (confirm(`You are deleting ${id}`)) {
        fetch("http://localhost:3000/controller/item.php?id=" + id, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                alert("Success:", data)
            })
            .catch((error) => {
                alert("Error:", error)
            })
    }
}
function addItem() {
    document.getElementById("edit-item-modal").style.display = "block"
    document
        .getElementById("edit-item-form")
        .addEventListener("submit", function (event) {
            event.preventDefault()
            const data = {
                auction_id: document.getElementById("auction_id").value,
                title: document.getElementById("title").value,
                description: document.getElementById("description").value,
                starting_bid: document.getElementById("starting_bid").value,
                end_time: document.getElementById("end_time").value,
            }
            fetch("http://localhost:3000/controller/item.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then((data) => {
                    alert("Success:", data)
                })
                .catch((error) => {
                    alert("Error:", error)
                })
        })
}

// Get the modal
var modal = document.getElementById("add-item-modal")

// Get the button that opens the modal
var btn = document.getElementById("add-item-btn")

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0]

// When the user clicks on the button, open the modal
btn.onclick = function () {
    modal.style.display = "block"
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none"
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none"
    }
}

// Validate the form and add the item to the list
var form = document.getElementById("add-item-form")
form.addEventListener("submit", function (event) {
    event.preventDefault()

    var name = document.getElementById("name").value.trim()
    var description = document.getElementById("description").value.trim()
    var startingBid = document.getElementById("starting-bid").value
    var imageUrl = document.getElementById("image-url").value.trim()
    var endTime = new Date(document.getElementById("end-time").value)

    var errors = []

    if (name === "") {
        errors.push("Name is required.")
    }

    if (description === "") {
        errors.push("Description is required.")
    }

    if (isNaN(startingBid) || startingBid < 0) {
        errors.push("Starting Bid must be a positive number.")
    }

    if (imageUrl === "") {
        errors.push("Image URL is required.")
    }

    if (endTime <= new Date()) {
        errors.push("End Time must be in the future.")
    }

    if (errors.length > 0) {
        var errorList = document.createElement("ul")
        errors.forEach(function (error) {
            var listItem = document.createElement("li")
            listItem.innerText = error
            errorList.appendChild(listItem)
        })

        var errorDiv = document.createElement("div")
        errorDiv.classList.add("error")
        errorDiv.appendChild(errorList)

        form.appendChild(errorDiv)
    } else {
        // Add the item to the list here
        console.log("Name: " + name)
        console.log("Description: " + description)
        console.log("Starting Bid: " + startingBid)
        console.log("Image URL: " + imageUrl)
        console.log("End Time: " + endTime)

        // Clear the form and close the modal
        form.reset()
        modal.style.display = "none"
    }
})

// Get the modal

// When the user clicks the button, open the modal
function openModal() {
    const modal = document.getElementById("add-item-modal")
    modal.style.display = "block"
}

// When the user clicks on <span> (x), close the modal
function closeModal() {
    const modal = document.getElementById("add-item-modal")
    modal.style.display = "none"
}

// When the user clicks on the "Add Item" button, add the item to the list
function addItem() {
    const modal = document.getElementById("add-item-modal")
    var title = document.getElementById("title").value
    var description = document.getElementById("description").value
    var startingBid = document.getElementById("starting-bid").value
    var imageUrl = document.getElementById("image-url").value
    var endTime = document.getElementById("end-time").value
    const formattedDate = (endTime.replace("T", " "))+ ":00"
    console.log(formattedDate)
    const data = {
        "title": title,
        "description": description,
        "starting_bid": startingBid,
        "image_url": imageUrl,
        "end_time": formattedDate,
    }
    fetch("http://localhost:3000/controller/item.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then((response) => response.json())
        .then((data) => {
            alert("Success:", data)
        })
        .catch((error) => {
            alert("Error:", error)
        })
    // console.log(name, description, startingBid, imageUrl, endTime)

    // Close the modal
    modal.style.display = "none"
}
