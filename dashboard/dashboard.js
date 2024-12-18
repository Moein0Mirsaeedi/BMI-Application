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

let record = document.getElementsByClassName('countRecord');
let countRecord = document.getElementById('countRecord');
let count = 0;
for(const fruit of record){
    count++
};

countRecord.innerHTML = count

