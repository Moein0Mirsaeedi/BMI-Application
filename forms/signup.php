<?php

require("../function.php");

if(authenticated()){
  redirect('../dashboard/index.php');
}

// setData("test", $reza);

if($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm-password'])){
  $errors = [];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordC = $_POST['confirm-password'];

  $email = strtolower($email);

      $users = get_data('users');
      $user = login($users, $email, $password);

      if($user){
        $errors[] = "Email or password is incorrect";
      }else{

        $lastUser = getLastPost($users);
        $id = $lastUser['id'] + 1;
        $newUser = [
          'id' => $id,
          'email' => $email,
          'password' => $password,
      ];
      $users[] = $newUser;
      setData('users', $users);
      setData($id, []);

      header("Location: ./signin.php");
      }
}

?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
      <script src="https://moein0mirsaeedi.github.io/BMI-Application/3.4.16"></script>
      <link rel="stylesheet" href="/forms/signup.css">
</head>
<body>
    <div id="changeTheme" class="change-theme">
        <div class="back-btn">
            <span id="spanTheme"></span>
            <ion-icon class="dark" name="moon-outline"></ion-icon>
            <ion-icon class="light" name="sunny-outline"></ion-icon>
        </div>
    </div>

    <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm form-box">
        <div class="p-4 sm:p-7">
          <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800">ثبت نام</h1>
            <p class="mt-2 text-sm text-gray-600">
              حساب کاربری دارید؟
              <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="signin.php">
                از اینجا وارد شوید
              </a>
            </p>
          </div>
      
          <div class="mt-5">
      
            <!-- Form -->
             <form method="POST" action="">
              <div class="grid gap-y-4">
                <!-- Form Group -->
                <div>
                  <label for="email" class="block text-sm mb-2">ادرس ایمیل</label>
                  <div class="relative">
                    <input type="email" id="email" name="email" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="email-error">
                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                      <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                      </svg>
                    </div>
                  </div>
                  <p class="hidden text-xs text-red-600 mt-2" id="email-error">لطفا یک آدرس ایمیل صحیح وارد کنید</p>
                </div>
                <!-- End Form Group -->
      
                <!-- Form Group -->
                <div>
                  <label for="password" class="block text-sm mb-2">رمز عبور</label>
                  <div class="relative">
                    <input type="password" id="password" name="password" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="password-error">
                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                      <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                      </svg>
                    </div>
                  </div>
                  <p class="hidden text-xs text-red-600 mt-2" id="password-error">رمز عبور باید بیش از 8 کارکتر باشد</p>
                </div>
                <!-- End Form Group -->
      
                <!-- Form Group -->
                <div>
                  <label for="confirm-password" class="block text-sm mb-2">تایید رمز عبور</label>
                  <div class="relative">
                    <input type="password" id="confirm-password" name="confirm-password" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="confirm-password-error">
                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                      <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                      </svg>
                    </div>
                  </div>
                  <p class="hidden text-xs text-red-600 mt-2" id="confirm-password-error">پسورد ها یکسان نیستند</p>
                </div>
                <!-- End Form Group -->
      
                <!-- Checkbox -->
                <div class="flex items-center">
                  <div class="flex">
                    <input id="remember-me" name="remember-me" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
                  </div>
                  <div class="ms-3">
                    <label for="remember-me" class="text-sm">من تمامی <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="#">شرایط و قوانین</a> استفاده از اپلیکیشن را تایید میکنم</label>
                  </div>
                </div>
                <!-- End Checkbox -->
      
                <a><button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" style="font-weight: bold;">ثبت نام</button></a>
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
      </div>g

      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="/forms/signup.js"></script>
</body>
</html>