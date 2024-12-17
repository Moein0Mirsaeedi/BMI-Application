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

let localLogin = JSON.parse(localStorage.getItem('isLogin'))
console.log(localLogin)

function getlocalLogin(){
    if(localLogin == "isLogin"){
        window.location.replace("/BMI-Application/dashboard/index.html");
    }else if(localLogin == "noLogin"){

    }else{
        localStorage.setItem('isLogin', JSON.stringify("noLogin"))
    }
}

getlocalLogin()

// const fs = require('node:fs');

// const content = 'Some content!';

// fs.writeFile('/Users/joe/test.txt', content, err => {
//   if (err) {
//     console.error(err);
//   } else {
//     // file written successfully
//   }
// });

// const data = 'Hello, this is the content of the text file!';
// const blob = new Blob([data], { type: 'text/plain' });