<?php
require("../function.php");

if(!authenticated()){
    redirect("../forms/signin.php");
}

logout();

?>