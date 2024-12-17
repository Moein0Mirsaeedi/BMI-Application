let helpButton = document.getElementById("helpButton");
let chooseBox = document.getElementById("chooseBox");
let helpIcon = document.getElementById("helpIcon");
let helpButtonStatus = 0
let screenWidth = window.innerWidth

helpButton.addEventListener("click", function() 
{
    if(helpButtonStatus == 0){
        helpButtonStatus = 1
        helpIcon.style.transform = "rotate(-90deg)"
        if(window.innerWidth > 850){
            chooseBox.style.height = "550px";
        }
        if(window.innerWidth <= 850){
            chooseBox.style.height = "530px";
        }
    }else if(helpButtonStatus == 1){
        helpButtonStatus = 0

        helpIcon.style.transform = "rotate(0deg)"
        if(window.innerWidth > 850){
            chooseBox.style.height = "400px";
        }
        if(window.innerWidth <= 850){
            chooseBox.style.height = "250px";
        }
    }
})


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