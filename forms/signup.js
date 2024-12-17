let changeTheme = document.getElementById("changeTheme");
let spanTheme = document.getElementById("spanTheme");
let body = document.body;
let theme = "light"

let localTheme = JSON.parse(localStorage.getItem('theme'))
console.log(localTheme)

function getLocalTheme(){
    if (localTheme == "dark" || localTheme == "light"){
        theme = localTheme
        setTheme(theme)
    }else{
        theme = "light";
        localStorage.setItem('theme', JSON.stringify(theme))
        setTheme(theme)
    }
}
getLocalTheme()

function setLocalTheme(){
    localStorage.setItem('theme', JSON.stringify(theme))
}

function setTheme(theme){
    if(theme == "dark"){
        body.classList.add("dark");
    }else if(theme == "light"){
        body.classList.remove("dark");
    }
}

changeTheme.addEventListener("click", function(){
    if(theme == "light"){
        theme = "dark"
        setTheme("dark");
        setLocalTheme()
    }else if(theme == "dark"){
        theme = "light"
        setTheme("light");
        setLocalTheme()
    }
})

function getlocalLogin(){
    if(localLogin == "isLogin"){
        window.location.replace("/BMI-Application/dashboard/index.html");
    }else if(localLogin == "noLogin"){

    }else{
        localStorage.setItem('isLogin', JSON.stringify("noLogin"))
    }
}

getlocalLogin()
function submitForm() {

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;

    const user = {
        username: username,
        email: email
    };

    fetch('/saveUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}