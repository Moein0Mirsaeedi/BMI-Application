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
            chooseBox.style.height = "620px";
        }
    }else if(helpButtonStatus == 1){
        helpButtonStatus = 0

        helpIcon.style.transform = "rotate(0deg)"
        if(window.innerWidth > 850){
            chooseBox.style.height = "400px";
        }
        if(window.innerWidth <= 850){
            chooseBox.style.height = "340px";
        }
    }
})


let changeTheme = document.getElementById("changeTheme");
let spanTheme = document.getElementById("spanTheme");
let body = document.body;
let theme = "light"

function setTheme(theme){
    if(theme == "dark"){
        body.classList.toggle("dark");
    }else if(theme == "light"){
        body.classList.toggle("dark");
    }
}

changeTheme.addEventListener("click", function(){
    if(theme == "light"){
        theme = "dark"
        setTheme("dark");
    }else if(theme == "dark"){
        theme = "light"
        setTheme("light");

    }
})