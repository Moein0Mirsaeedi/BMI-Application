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

  $infos = get_data($fileName);

      $lastUser = getLastPost($infos);
    if(isset($lastUser)){
      $id = $lastUser['id'] + 1;
    }else{
      $id = 1;
    }

    $newUser = [
          'id' => $id,
          'age' => $age,
          'gender' => $gender,
          'weight' => $weight,
          'height' => $height,
          'exerceise' => $exerceise,
  ];
  $infos[] = $newUser;
  setData($fileName, $infos);
  redirect('../result/result.php?id=' . $id);
}


?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت رکورد جدید</title>
      <script src="https://moein0mirsaeedi.github.io/BMI-Application/3.4.16"></script>
</head>
<body>
    <div id="changeTheme" class="change-theme">
        <div class="back-btn">
            <span id="spanTheme"></span>
            <ion-icon class="dark" name="moon-outline"></ion-icon>
            <ion-icon class="light" name="sunny-outline"></ion-icon>
        </div>
    </div>

    <div class="mt-40 bg-white border border-gray-200 rounded-xl shadow-sm form-box">
        <div class="p-4 sm:p-7">
          <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800">فرم ثبت اطلاعات</h1>
            <p class="mt-2 text-sm text-gray-600">
              در زیر اطلاعات خودتون رو به صورت کامل و صحیح وارد کنید
              <!-- <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="signin.html">
                از اینجا وارد شوید
              </a> -->
            </p>
          </div>
      
          <div class="mt-5">
            <!-- Form -->
            <form method="POST" action="">
            <!-- <form> -->
              <div class="grid gap-y-4">
                <!-- Form Group -->
                <div>
                  <label class="block text-sm mb-2">سن</label>
                  <div class="relative">
                    <input type="number" value="0" min="0" max="120" id="age" name="age" class="py-3 w-full block px-4 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="email-error">
                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                      <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                      </svg>
                    </div>
                    
                    
                  </div>
                </div>
                <!-- End Form Group -->

                <!-- Form Group -->
                <div>
                  <label class="block text-sm mb-2">جنسیت</label>
                <select id="exampleSelect" name="gender" class="block appearance-none w-full bg-white border border-gray-200 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline ">
                  <option name="men" value="men">مرد</option>
                  <option name="women" value="women">زن</option>
                </select>
                </div>
                <!-- End Form Group -->
      
                <!-- Form Group -->
                <div>
                  <label class="block text-sm mb-2">وزن</label>
                  <div class="relative">
                    <input type="number" value="0" min="0" max="350" id="weight" name="weight" class="py-3 w-full block px-4 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="email-error">
                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                      <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                      </svg>
                    </div>
                    
                    
                  </div>
                </div>
                <!-- End Form Group -->
      
                <!-- Form Group -->
                <div>
                  <label class="block text-sm mb-2">قد</label>
                  <div class="relative">
                    <input type="number" value="0" min="0" max="250" id="height" name="height" class="py-3 w-full block px-4 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" required aria-describedby="email-error">
                    <div class="hidden absolute inset-y-0 end-0 pointer-events-none pe-3">
                      <svg class="size-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                      </svg>
                    </div>
                    
                    
                  </div>
                </div>
                <!-- End Form Group -->
      
                <!-- Checkbox -->
                <!-- <div class="flex items-center">
                  <div class="flex">
                    <input id="remember-me" name="remember-me" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500">
                  </div>
                  <div class="ms-3">
                    <label for="remember-me" class="text-sm">من تمامی <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium" href="#">شرایط و قوانین</a> استفاده از اپلیکیشن را تایید میکنم</label>
                  </div>
                </div> -->
                <!-- End Checkbox -->
      
                <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">دریافت وزن و قد از دستگاه</a>
                <div>
                  <label class="block text-sm mb-2">میزان فعالیت خود را انتخاب کنید</label>
                  <select id="exampleSelect" name="exerceise" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                    <option value="1">نشسته (بدون ورزش و ورزش خیلی کم)</option>
                    <option value="2">فعالیت کم (1 الی 3 ساعت در هفته)</option>
                    <option value="3">فعالیت متوسط (3 الی 5 ساعت در هفته)</option>
                    <option value="4">بسیار فعال (6 الی 7 ساعت در هفته)</option>
                    <option value="5">فعالیت بسیار بالا (فعالیت سخت ورزشی و کاری)</option>
                  </select>
                </div>

                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" style="font-weight: bold;">ثبت نهایی اطلاعات</button>
              </div>
            <!-- </form> -->
          </form>
          <a href="../dashboard/dashboard.php"><button class="w-full mt-4 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg text-blue border border-gray-300 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" style="font-weight: bold;">انصراف</button></a>
            <!-- End Form -->
          </div>
        </div>
      </div>

      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
      <link rel="stylesheet" href="record.css">
    <script src="record.js"></script>
</body>
</html>