<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <link rel="stylesheet" href="/BMI-Application/style.css">
</head>
<body>
    <div id="changeTheme" class="change-theme">
        <div class="back-btn">
            <span id="spanTheme"></span>
            <ion-icon class="dark" name="moon-outline"></ion-icon>
            <ion-icon class="light" name="sunny-outline"></ion-icon>
        </div>
    </div>

    <div id="chooseBox" class="choose-box">
        <h1>حالت استفاده از اپلیکیشن را انتخاب کنید</h1>
        <div class="choose-btn">
            <a class="online-btn" href="/BMI-Application/forms/signin.php">آنلاین</a>
            <a class="offline-btn" href="#">آفلاین</a>
        </div>
        <div id="helpButton" class="help-btn">
            <ion-icon id="helpIcon" name="caret-back-outline"></ion-icon><span>راهنمایی</span>
        </div>
        <div class="help-box">
            <div class="help online-help">
                <p>حالت آنلاین:</p>
                <p>اتصال پایدار اینترنت</p>
                <p>دریافت اطلاعات وزنی از دستگاه</p>
                <p>ثبت و ذخیره اطلاعات به صورت آنلاین</p>
            </div>
            <div class="help offline-help">
                <p>حالت آفلاین:</p>
                <p>عدم نیاز به اینترنت</p>
                <p>وارد کردن اطلاعات به صورت دستی</p>
                <p>ذخیره اطلاعات به صورت آفلاین بر روی دستگاه</p>
            </div>
        </div>
    </div>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="/BMI-Application/script.js"></script>
    
</body>
</html>