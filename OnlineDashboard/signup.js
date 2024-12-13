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