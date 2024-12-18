<?php

require("../function.php");

if(!authenticated()){
  redirect('../forms/signin.php');
}

if($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['age']) && isset($_POST['gender']) && isset($_POST['weight']) && isset($_POST['height']) && isset($_POST['exerceise'])){
  $errors = [];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $weight = $_POST['weight'];
  $height = $_POST['height'];
  $exerceise = $_POST['exerceise'];

  $fileName = $_SESSION['user']['id'];

  $infos = get_data('information/' . $fileName);

      // $user = login($users, $email, $password);

      if($user){
        $errors[] = "Email or password is incorrect";
      }else{

        $lastinfo = getLastPost($infos);
        $id = $lastUser['id'] + 1;
        $newinfo = [
          'id' => $id,
          'age' => $age,
          'gender' => $gender,
          'weight' => $weight,
          'height' => $height,
          'exerceise' => $exerceise,
      ];
      $users[] = $newUser;
      setData('users', $users);

      header("Location: ./signin.php");
      }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>