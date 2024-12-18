<?php

require("../function.php");

if(!authenticated()){
  redirect('../forms/signin.php');
}

if(!isset($_GET['id'])){
    redirect('../dashboard/dashboard.php');
}
$idInfos = $_GET['id'];
$fileName = $_SESSION['user']['id'];
$infos = get_data($fileName);
$lastUser = $infos[$idInfos-1];
$infos = $infos[$lastUser['id']-1];
$age = $infos['age'];
$gender = $infos['gender'];
$weight = $infos['weight'];
$height = $infos['height'];
$exerceise = $infos['exerceise'];
$bmi = $infos['bmi'];

$bmiStatus = "none";
if($bmi < 18.5){
    $bmiStatus = "شما دچار کمبود وزن هستید.";
}else if($bmi >= 18.5 && $bmi <= 24.9){
    $bmiStatus = "وضعیت بدنی شما عالی است.";
}else if($bmi >= 25 && $bmi <= 29.9){
    $bmiStatus = "شما دچار چاقی و اضافه وزن هستید.";
}else if($bmi >= 30){
    $bmiStatus = "شما دچار چاقی و اضافه وزن شدید هستید.";
}

$ageStatus = "none";
if($age < 18){
    $ageStatus = "سن شما بسیار مناسب جهت فعالیت در رشته های ورزشی مختلف است.";
}else if($age >= 18 && $age <= 29){
    $ageStatus = "سن شما همچنان مناسب شروع ورزش و فعالیت های مختلف است.";
}else if($age >= 30 && $age <= 59){
    $ageStatus = "ورزش در این سن میتواند به بهبود روند زندگی شما کمک کند.";
}else if($age >= 60){
    $ageStatus = "بهتر است نرمز و پیاده روی را در برنامه خود داشته باشید.";
}

$weightStatus = "none";
if($bmi < 18.5){
    $weightStatus = "این وزن برای شما بسیار کم است.";
}else if($bmi >= 18.5 && $bmi <= 24.9){
    $weightStatus = "این وزن برای شما ایده آل است.";
}else if($bmi >= 25 && $bmi <= 29.9){
    $weightStatus = "شما نیاز دارید وزن تون رو کمتر کنید.";
}else if($bmi >= 30){
    $weightStatus = "این مقدار برای شما خیلی زیاد است، مراقب باشید.";
}

$heightStatus = "none";
if($height < 160){
    $heightStatus = "قد شما مقداری کم تر از حد نرمال است، شاید نیازمند حرکات اصلاحی و تمرینات خاص باشید.";
}else if($height >= 161 && $height <= 179){
    $heightStatus = "قد شما ایده آل است";
}else if($height >= 180 && $height <= 195){
    $heightStatus = "تبریک میگم، شما فرقی قد بلند هستید.";
}else if($bmi >= 196){
    $heightStatus = "این فوق العادس، قد شما خیلی زیاد است.";
}

$bmr = "none";
if($gender == "women"){
    $bmr = ($height*3.098) + ($weight*9.247) - ($age*4.330) + 447.593;
}else if($gender == "men"){
    $bmr = ($height*4.799) + ($weight*13.397) - ($age*5.677) + 88.362;
}
if($exerceise == 1){
    $bmr *= 1.2;
}else if($exerceise == 2){
    $bmr *= 1.3;
}else if($exerceise == 3){
    $bmr *= 1.4;
}else if($exerceise == 4){
    $bmr *= 1.5;
}else if($exerceise == 5){
    $bmr *= 1.7;
}
$bmr = round($bmr, 0);

?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتایج رکورد</title>
  <link rel="stylesheet" href="https://preline.co/assets/css/main.min.css">
  </head>
<body>
<!-- Hero -->
<div class="bg-gradient-to-b from-violet-600/10 via-transparent">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-8">

    <!-- Title -->
    <div class="max-w-3xl text-center mx-auto">
      <h1 class="block font-medium text-4xl sm:text-5xl md:text-6xl lg:text-7xl title-res">
        حالا بیاید نایج گزارش رو بررسی کنیم
      </h1>
    </div>
    <!-- End Title -->

    <div class="max-w-3xl text-center mx-auto">
      <p class="text-lg ">در پایین میتوانید آنالیز کلی گزارش خودتون رو مشاهده کنید.</p>
    </div>


  </div>
</div>
<!-- End Hero -->

<!-- Testimonials with Stats -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid -->
  <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center lg:justify-between">
    <div class="lg:col-span-5 lg:col-start-1">
      <!-- Title -->
      <div class="mb-8">
        <h2 class="mb-2 text-3xl text-gray-800 font-bold lg:text-4xl">
          <?= $bmiStatus ?>
        </h2>
        <p class="text-gray-600">
        <?= $bmiStatus ?> بی ام آی نشان دهنده شاخص توده بدنی شماست و بهتر است بین 18.5 تا 25 باشد.
        </p>
      </div>
      <!-- End Title -->

      <!-- Blockquote -->
      <blockquote class="relative">
        <!-- <svg class="absolute top-0 start-0 transform -translate-x-6 -translate-y-8 size-16 text-gray-200" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z" fill="currentColor"/>
        </svg> -->

        <div class="relative z-10">
          <p class="text-xl italic text-gray-800">
            در مقابل میتوانید تمامی اطلاعات خودتان را آنالیز کنید.
          </p>
        </div>

      </blockquote>
      <!-- End Blockquote -->
    </div>
    <!-- End Col -->

    <div class="mt-10 lg:mt-0 lg:col-span-6 lg:col-end-13">
      <div class="space-y-6 sm:space-y-8">
        <!-- List -->
        <ul class="grid grid-cols-2 divide-y divide-y-2 divide-x divide-x-2 divide-gray-200 overflow-hidden">
          <li class="flex flex-col -m-0.5 p-4 sm:p-8">
            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2">
              <?= $age ?>
            </div>
            <p class="text-sm sm:text-base text-gray-600">
            <?= $ageStatus ?>
            </p>
          </li>

          <li class="flex flex-col -m-0.5 p-4 sm:p-8">
            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2">
            <?= $bmi ?>
            </div>
            <p class="text-sm sm:text-base text-gray-600">
            <?= $bmiStatus ?>
            </p>
          </li>

          <li class="flex flex-col -m-0.5 p-4 sm:p-8">
            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2">
            <?= $weight ?>
            </div>
            <p class="text-sm sm:text-base text-gray-600">
            <?= $weight ?> کیلوگرم، <?= $weightStatus ?>
            </p>
          </li>

          <li class="flex flex-col -m-0.5 p-4 sm:p-8">
            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2">
            <?= $height ?>
            </div>
            <p class="text-sm sm:text-base text-gray-600">
            <?= $height ?> سانتی متر، <?= $heightStatus ?>
            </p>
          </li>
        </ul>
        <!-- End List -->
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Testimonials with Stats -->

<br><br><br><br>
<!-- Hero -->
<div class="bg-gradient-to-b from-violet-600/10 via-transparent">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-8">

    <!-- Title -->
    <div class="max-w-3xl text-center mx-auto">
      <h1 class="block font-medium text-4xl sm:text-5xl md:text-6xl lg:text-7xl title-res">
        نگاهی به گزارش BMR خود بیاندازید
      </h1>
    </div>
    <!-- End Title -->

    <div class="max-w-3xl text-center mx-auto">
      <p class="text-lg ">در اینجا ما اطلاعاتی راجب متابولیسم بدن شما آماده کرده ایم که میتواند برایتان مفید باشد.</p>
    </div>


  </div>
</div>
<!-- End Hero -->

<!-- Testimonials with Stats -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Grid -->
  <div class="lg:grid lg:grid-cols-12 lg:gap-16 lg:items-center lg:justify-between">
    <div class="lg:col-span-5 lg:col-start-1">
      <!-- Title -->
      <div class="mb-8">
        <h2 class="mb-2 text-3xl text-gray-800 font-bold lg:text-4xl">
          وضعیت شاخص متابولیسم بدن شما
        </h2>
        <p class="text-gray-600">
          متابولیسم پایه بدن، مقدار کالری مورد نیاز مصرفی در روز را نشان میدهد که میتوانید با کم و زیاد کردن آن وزن خود را کنترل کنید
        </p>
      </div>
      <!-- End Title -->

      <!-- Blockquote -->
      <blockquote class="relative">
        <!-- <svg class="absolute top-0 start-0 transform -translate-x-6 -translate-y-8 size-16 text-gray-200" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M7.39762 10.3C7.39762 11.0733 7.14888 11.7 6.6514 12.18C6.15392 12.6333 5.52552 12.86 4.76621 12.86C3.84979 12.86 3.09047 12.5533 2.48825 11.94C1.91222 11.3266 1.62421 10.4467 1.62421 9.29999C1.62421 8.07332 1.96459 6.87332 2.64535 5.69999C3.35231 4.49999 4.33418 3.55332 5.59098 2.85999L6.4943 4.25999C5.81354 4.73999 5.26369 5.27332 4.84476 5.85999C4.45201 6.44666 4.19017 7.12666 4.05926 7.89999C4.29491 7.79332 4.56983 7.73999 4.88403 7.73999C5.61716 7.73999 6.21938 7.97999 6.69067 8.45999C7.16197 8.93999 7.39762 9.55333 7.39762 10.3ZM14.6242 10.3C14.6242 11.0733 14.3755 11.7 13.878 12.18C13.3805 12.6333 12.7521 12.86 11.9928 12.86C11.0764 12.86 10.3171 12.5533 9.71484 11.94C9.13881 11.3266 8.85079 10.4467 8.85079 9.29999C8.85079 8.07332 9.19117 6.87332 9.87194 5.69999C10.5789 4.49999 11.5608 3.55332 12.8176 2.85999L13.7209 4.25999C13.0401 4.73999 12.4903 5.27332 12.0713 5.85999C11.6786 6.44666 11.4168 7.12666 11.2858 7.89999C11.5215 7.79332 11.7964 7.73999 12.1106 7.73999C12.8437 7.73999 13.446 7.97999 13.9173 8.45999C14.3886 8.93999 14.6242 9.55333 14.6242 10.3Z" fill="currentColor"/>
        </svg> -->

        <div class="relative z-10">
          <p class="text-xl italic text-gray-800">
            در مقابل اطلاعاتی راجب مقدار کالری مورد نیاز شما جمع آوری کرده ایم.
          </p>
        </div>

      </blockquote>
      <!-- End Blockquote -->
    </div>
    <!-- End Col -->

    <div class="mt-10 lg:mt-0 lg:col-span-6 lg:col-end-13">
      <div class="space-y-6 sm:space-y-8">
        <!-- List -->
        <ul class="grid grid-cols-2 divide-y divide-y-2 divide-x divide-x-2 divide-gray-200 overflow-hidden">
          <li class="flex flex-col -m-0.5 p-4 sm:p-8">
            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2">
              <?= $bmr ?>
            </div>
            <p class="text-sm sm:text-base text-gray-600">
              کالری مورد نیاز فعلی بدن شما
            </p>
          </li>

          <li class="flex flex-col -m-0.5 p-4 sm:p-8">
            
          </li>

          <li class="flex flex-col -m-0.5 p-4 sm:p-8">
            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2">
            <?= $bmr-500 ?>
            </div>
            <p class="text-sm sm:text-base text-gray-600">
              کالری مورد نیاز برای نیم کیلو کاهش وزن در هفته
            </p>
          </li>

          <li class="flex flex-col -m-0.5 p-4 sm:p-8">
            <div class="flex items-end gap-x-2 text-3xl sm:text-5xl font-bold text-gray-800 mb-2">
            <?= $bmr+500 ?>
            </div>
            <p class="text-sm sm:text-base text-gray-600">
            کالری مورد نیاز برای نیم کیلو افزایش وزن در هفته
            </p>
          </li>
        </ul>
        <!-- End List -->
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End Grid -->
</div>
<!-- End Testimonials with Stats -->
<br><br><br><br>

<a href="../dashboard/dashboard.php"><button class="w-full mt-4 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg text-blue border border-gray-300 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" style="font-weight: bold;">بازگشت به داشبورد</button></a>

<link rel="stylesheet" href="result.css">
<script src="result.js"></script>
</body>
</html>