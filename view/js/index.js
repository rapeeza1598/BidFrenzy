window.addEventListener("load", function () {
    // TODO: Fetch data from server and update the following values
    document.getElementById("total-items").textContent = "10"
    document.getElementById("total-revenue").textContent = "$1000.00"
    document.getElementById("total-bidders").textContent = "5"

    // Create chart
    var ctx = document.getElementById("revenue-chart").getContext("2d")
    var chart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            datasets: [
                {
                    label: "Revenue",
                    data: [
                        100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1100,
                        1200,
                    ],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 205, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(201, 203, 207, 0.2)",
                    ],
                    borderColor: [
                        "rgb(255, 99, 132)",
                        "rgb(255, 159, 64)",
                        "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)",
                        "rgb(54, 162, 235)",
                        "rgb(153, 102, 255)",
                        "rgb(201, 203, 207)",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                yAxes: [
                    {
                        ticks: {
                            beginAtZero: true,
                        },
                    },
                ],
            },
        },
    })
})

window.addEventListener("load", function () {
    // Add event listener to "Add User" button
    var addUserBtn = document.getElementById("add-user-btn")
    addUserBtn.addEventListener("click", function () {
        // Show modal dialog to add user
        var modal = document.getElementById("add-user-modal")
        modal.style.display = "block"

        // Add event listener to "Save" button in modal dialog
        var saveBtn = document.getElementById("save-user-btn")
        saveBtn.addEventListener("click", function () {
            // TODO: Save user data to server and update user table
            modal.style.display = "none"
        })

        // Add event listener to "Cancel" button in modal dialog
        var cancelBtn = document.getElementById("cancel-user-btn")
        cancelBtn.addEventListener("click", function () {
            modal.style.display = "none"
        })
    })

    // Add event listeners to "Edit" buttons in user table
    var editBtns = document.getElementsByClassName("edit-btn")
    for (var i = 0; i < editBtns.length; i++) {
        var editBtn = editBtns[i]
        editBtn.addEventListener("click", function () {
            // Show modal dialog to edit user
            var modal = document.getElementById("edit-user-modal")
            modal.style.display = "block"

            // Add event listener to "Save" button in modal dialog
            var saveBtn = document.getElementById("update-user-btn")
            saveBtn.addEventListener("click", function () {
                // TODO: Update user data on server and update user table
            })

            // Add event listener to "Cancel" button in modal dialog
            var cancelBtn = document.getElementById("cancel-edit-btn")
            cancelBtn.addEventListener("click", function () {
                modal.style.display = "none"
            })
        })
    }

    // Add event listeners to "Delete" buttons in user table
    var deleteBtns = document.getElementsByClassName("delete-btn")
    for (var i = 0; i < deleteBtns.length; i++) {
        var deleteBtn = deleteBtns[i]
        deleteBtn.addEventListener("click", function () {
            // TODO: Send delete request to server and remove user row from table
        })
    }
})
