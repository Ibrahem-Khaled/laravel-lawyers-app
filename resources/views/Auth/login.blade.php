<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <style>
        body {
            color: #fff;
            background-color: #8d6b53;
            background-size: cover;
            height: 100%;
            direction: rtl;
            font-family: "Cairo", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            background-color: #fff;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            display: flex;
            overflow: hidden;
            margin-top: 100px;
        }

        .image-container {
            background-image: url('https://images.unsplash.com/photo-1506784365847-bbad939e9335?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            width: 50%;
            height: auto;
        }

        .form-container {
            padding: 50px;
            width: 50%;
            background-color: #f0f0f0;
            color: #000;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 120px;
        }

        .btn-primary {
            background-color: #8B4513;
            border: none;
        }

        .btn-primary:hover {
            background-color: #6c3413;
        }

        a {
            color: #8B4513;
        }

        a:hover {
            color: #6c3413;
            text-decoration: none;
        }

        .form-group label {
            font-weight: 600;
        }

        .form-control {
            border: 2px solid #8B4513;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #6c3413;
            box-shadow: none;
        }

        .form-check-input {
            margin-left: -1.25rem;
        }

        .form-check-label {
            margin-right: 1.25rem;
        }

        .container small {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="image-container"></div>
        <div class="form-container">
            <div class="logo-container">
                <!-- يمكنك إضافة شعار الشركة هنا -->
                <!-- <img src="path_to_logo.png" alt="Logo"> -->
            </div>
            <h3 class="mb-4 text-center">تسجيل الدخول</h3>
            <form method="POST" action="{{ route('customLogin') }}">
                @csrf

                <div class="form-group mb-4">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" placeholder="أدخل بريدك الإلكتروني"
                        required>
                </div>
                <div class="form-group mb-4">
                    <label>كلمة المرور</label>
                    <input type="password" name="password" class="form-control" placeholder="أدخل كلمة المرور" required>
                </div>
                <div class="form-group form-check mb-4 d-flex justify-content-between">
                    <div>
                        <input type="checkbox" class="form-check-input" id="chk1" name="chk">
                        <label class="form-check-label text-muted" for="chk1">تذكرني</label>
                    </div>
                    <a href="{{ route('forgetPassword') }}" class="text-muted">نسيت كلمة المرور؟</a>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">دخول</button>
                <small class="d-block text-center">ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء
                        حساب</a></small>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>
