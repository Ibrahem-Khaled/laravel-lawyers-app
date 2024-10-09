<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>إنشاء حساب</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <style>
        body {
            color: #fff;
            background-color: #836f64;
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
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            display: flex;
            overflow: hidden;
            margin-top: 3%;
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
            background-color: #f8f9fa;
            color: #000;
        }

        .btn-primary {
            background-color: #8B4513;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e64a19;
        }

        a {
            color: #8B4513;
        }

        a:hover {
            color: #e64a19;
            text-decoration: none;
        }

        .nav-tabs .nav-link {
            border-radius: 0;
            border: 1px solid #ccc;
            color: #53045F;
            font-weight: bold;
        }

        .nav-tabs .nav-link.active {
            background-color: #8B4513;
            color: white;
        }

        .form-control {
            border: 2px solid #8B4513;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #6c3413;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="image-container"></div>
        <div class="form-container">
            <!-- تبويبات المستخدم ومحامي -->
            <ul class="nav nav-tabs mb-4" id="userTypeTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#user" role="tab"
                        aria-controls="user" aria-selected="true">مستخدم</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="lawyer-tab" data-bs-toggle="tab" href="#lawyer" role="tab"
                        aria-controls="lawyer" aria-selected="false">محامٍ</a>
                </li>
            </ul>

            <!-- محتوى التبويبات -->
            <div class="tab-content" id="userTypeTabContent">
                <!-- تبويب المستخدم العادي -->
                <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                    <h3 class="mb-4 text-center">إنشاء حساب</h3>
                    <form method="POST" action="{{ route('customRegister') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <label>الاسم الكامل</label>
                            <input type="text" name="name" class="form-control" placeholder="أدخل اسمك الكامل"
                                required>
                        </div>
                        <div class="form-group mb-4">
                            <label>البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="أدخل بريدك الإلكتروني" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>كلمة المرور</label>
                            <input type="password" name="password" class="form-control" placeholder="أدخل كلمة المرور"
                                required>
                        </div>
                        <div class="form-group mb-4">
                            <label>تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="أعد إدخال كلمة المرور" required>
                        </div>
                        <input type="hidden" name="role" value="user">
                        <button type="submit" class="btn btn-primary w-100 mb-3">تسجيل</button>
                        <small class="d-block text-center">هل لديك حساب؟ <a href="{{ route('login') }}">
                                تسجيل الدخول</a></small>
                    </form>
                </div>

                <!-- تبويب المحامي -->
                <div class="tab-pane fade" id="lawyer" role="tabpanel" aria-labelledby="lawyer-tab">
                    <h3 class="mb-4 text-center">إنشاء حساب محامٍ</h3>
                    <form method="POST" action="{{ route('customRegister') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <label>الاسم الكامل</label>
                            <input type="text" name="name" class="form-control" placeholder="أدخل اسمك الكامل"
                                required>
                        </div>
                        <div class="form-group mb-4">
                            <label>البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="أدخل بريدك الإلكتروني" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>رقم الهاتف</label>
                            <input type="number" name="phone" class="form-control" placeholder="أدخل رقم الهاتف"
                                required>
                        </div>
                        <div class="form-group mb-4">
                            <label>عنوان المكتب</label>
                            <input type="text" name="address" id="office_address" class="form-control"
                                placeholder="أدخل عنوان المكتب" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>كلمة المرور</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="أدخل كلمة المرور" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="أعد إدخال كلمة المرور" required>
                        </div>
                        <input type="hidden" name="role" value="lawyer">
                        <button type="submit" class="btn btn-primary w-100 mb-3">تسجيل</button>
                        <small class="d-block text-center">هل لديك حساب؟ <a href="{{ route('login') }}">
                                تسجيل الدخول</a></small>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- إضافة مكتبة JavaScript لتفعيل التبويبات -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
