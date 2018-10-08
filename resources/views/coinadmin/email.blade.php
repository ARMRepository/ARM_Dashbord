<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{ Setting::get('site_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <style type="text/css">
    .verify-sec {
        max-width: 550px;
        margin: 100px auto;
        border: 0px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .18);
        padding: 20px;
        background-color: #c5c5c5;
        text-align: center;
    }
    </style>
</head>

<body class="fixed-header " >
    <div class="register-container full-height sm-p-t-30">
        <div class="d-flex justify-content-center flex-column full-height ">
            <img height="50" src="{{ img(Setting::get('site_logo')) }}" alt="" />
            <div class="verify-sec text-center">
                <h3>Email : {{ $data}}</h3>
            </div>
        </div>
    </div>
</body>
</html>
