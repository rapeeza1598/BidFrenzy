// const form = document.querySelector("form")
const API = "http://localhost:3000/controller/api.php"
// form.addEventListener("submit", async (event) => {
//     event.preventDefault()

//     const username = form.elements["username"].value
//     const password = form.elements["password"].value
//     console.log(JSON.stringify({ username, password }))
//     const response = await fetch(API, {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json",
//         },
//         body: JSON.stringify({ username, password }),
//     })

//     const data = await response.json()

//     if (data.success) {
//         window.location.href = "dashboard.html"
//     } else {
//         alert("Invalid username or password")
//     }
// })
async function userLogin(form) {
    const username = form.username.value
    const password = form.password.value
    console.log(JSON.stringify({ username, password }))
    const response = await fetch(API, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ username, password }),
    })

    const data = await response.json()

    if (data.success) {
        window.location.href = "dashboard.html"
    } else {
        alert("Invalid username or password")
    }
}

async function checkPasswordAndRegister(form) {
    const pass1 = form.password.value
    const pass2 = form.repassword.value
    if (pass1 != pass2) {
        alert("Not Pass Check Password again")
        return true
    } else {
        const username = form.elements["username"].value
        const email = form.elements["email"].value
        const password = form.elements["password"].value
        const firstName = form.elements["firstName"].value
        const lastName = form.elements["lastName"].value
        // console.log(JSON.stringify({ username, password }))
        const response = await fetch(
            "http://localhost:3000/controller/register.php",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    username,
                    email,
                    password,
                    firstName,
                    lastName,
                }),
            }
        )

        const data = await response.json()

        if (data.success) {
            alert("Register Susses!!!")
            window.location.href = "index.html"
        } else {
            alert("Invalid username or password")
            return false
        }
    }
}

