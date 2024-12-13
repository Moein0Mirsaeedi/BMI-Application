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
            chooseBox.style.height = "680px";
        }
    }else if(helpButtonStatus == 1){
        helpButtonStatus = 0
        chooseBox.style.height = "400px";
        helpIcon.style.transform = "rotate(0deg)"
    }
})
