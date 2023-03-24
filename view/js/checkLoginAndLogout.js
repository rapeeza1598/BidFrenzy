function checkLogin() {
    fetch("http://localhost:3000/controller/check_session.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.loggedIn) {
                console.log("User is logged in:", data.username)
                return true
            } else {
                console.log("User is not logged in")
                return false
            }
        })
        .catch((error) => console.error(error))
}
function Logout() {
    fetch("http://localhost:3000/controller/logout.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                console.log("User is logged out")
                window.location.href = "index.html"
            } else {
                console.log("User is not logged out")
            }
        })
        .catch((error) => console.error(error))
}

let dateString = "2023-03-25 20:23:10"
let isoDateString = dateString.replace(
    /(\d{4}-\d{2}-\d{2})\s(\d{2}:\d{2}:\d{2})/,
    "$1T$2Z"
)
console.log(new Date(isoDateString).getTime())

// Set the countdown dates for each item
var countDownDates = [
    new Date("2023-03-25T20:23:10Z").getTime(),
    new Date("2023-04-01T12:00:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
    new Date("2023-04-15T18:30:00Z").getTime(),
]

// Function to create a timer for a specific countdown date and element ID
function createTimer(countDownDate, elementId) {
    // Update the countdown every 1 second
    var x = setInterval(function () {
        // Get the current date and time
        var now = new Date().getTime()

        // Calculate the distance between now and the countdown date
        var distance = countDownDate - now

        // Calculate time remaining
        var days = Math.floor(distance / (1000 * 60 * 60 * 24))
        var hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        )
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
        var seconds = Math.floor((distance % (1000 * 60)) / 1000)

        // Display the countdown
        document.getElementById(elementId).innerHTML =
            days + "d " + hours + "h " + minutes + "m " + seconds + "s "

        // If the countdown is finished, display a message
        if (distance < 0) {
            clearInterval(x)
            document.getElementById(elementId).innerHTML = "EXPIRED"
        }
    }, 1000)
}

async function getItem() {
    const response = await fetch("http://localhost:3000/controller/item.php", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
    const data = await response.json()
    for (let index = 0; index < data.length; index++) {
        //     <div class="row">
        //     <div class="col">
        //         Product 1
        //         <div class="product">
        //             <img
        //                 src="https://f.ptcdn.info/890/056/000/p6iilgoaoA4UyWG2ain-o.jpg"
        //                 alt="Product Image"
        //             />
        //             <h2>Product Title</h2>
        //             <p>Description of the product goes here.</p>
        //             <p class="price">$19.99</p>
        //             <p id="countdown0"></p>
        //             <button>Bid</button>
        //         </div>
        //     </div>
        // </div>
        console.log(data[index])
        let col = document.createElement("div")
        col.className = "col-3"
        let product = document.createElement("div")
        product.className = "product"
        let img = document.createElement("img")
        img.src = data[index].image_url
        let h2 = document.createElement("h2")
        h2.innerHTML = data[index].title
        let p1 = document.createElement("p")
        p1.innerHTML = data[index].description
        let p2 = document.createElement("p")
        p2.className = "price"
        p2.innerHTML = data[index].current_bid
        let p3 = document.createElement("p")
        p3.id = "countdown" + index
        let button = document.createElement("button")
        button.innerHTML = "Bid"
        // button.onclick = function () {
        //     window.location.href = "bid.html"
        // }
        button.onclick = () => bidItem(index)
        product.appendChild(img)
        product.appendChild(h2)
        product.appendChild(p1)
        product.appendChild(p2)
        product.appendChild(p3)
        product.appendChild(button)
        col.appendChild(product)
        document.getElementById("product-layout").appendChild(col)
        let end_time = data[index].end_time
        let isoDateString = end_time.replace(
            /(\d{4}-\d{2}-\d{2})\s(\d{2}:\d{2}:\d{2})/,
            "$1T$2Z"
        )
        const date = new Date(isoDateString).getTime()
        createTimer(date, "countdown" + index)
    }
}

async function bidItem(id) {
    const response = await fetch("http://localhost:3000/controller/item.php", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
    const data = await response.json()
    let itemUpdate = {
        user_id: 2,
        title: data[id].title,
        description: data[id].description,
        image_url: data[id].image_url,
        current_bid: data[id].current_bid + 100,
        end_time: data[id].end_time,
    }
    const responseUpdate = await fetch(
        "http://localhost:3000/controller/item.php",
        {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(itemUpdate),
        }
    )
    const dataUpdate = await responseUpdate.json()
    windows.location.href = "../index.html"
    const now = new Date()
    const year = now.getFullYear()
    const month = String(now.getMonth() + 1).padStart(2, "0")
    const day = String(now.getDate()).padStart(2, "0")
    const hours = String(now.getHours()).padStart(2, "0")
    const minutes = String(now.getMinutes()).padStart(2, "0")
    const seconds = String(now.getSeconds()).padStart(2, "0")
    const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`
    console.log(formattedDate)
}
// Loop through the countdown dates and create timers for each item
// for (var i = 0; i < countDownDates.length; i++) {

// }
