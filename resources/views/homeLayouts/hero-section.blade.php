<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Fonts and icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Cairo", sans-serif;
            font-optical-sizing: auto;
        }

        .hero-section {
            position: relative;
            height: 600px;
            display: flex;
            align-items: center;
            color: #333;
        }

        /* خلفية الصورة مع الضبابية */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fstatic.vecteezy.com%2Fsystem%2Fresources%2Fpreviews%2F001%2F269%2F203%2Fnon_2x%2Flawyer-working-at-desk-free-photo.jpg&f=1&nofb=1&ipt=f10dbc7318911b360ec98b729feeb3f82aa3db03c73de473a1a440ca8d343062&ipo=images') no-repeat center center/cover;
            filter: blur(3px);
            /* مقدار الضبابية */
            z-index: -1;
        }

        .hero-content {
            z-index: 1;
            max-width: 800px;
            background-color: rgba(255, 255, 255, 0.8);
            /* خلفية شبه شفافة للنص */
            padding: 20px;
            border-radius: 10px;
            text-align: right; /* محاذاة النص لليمين */
        }

        .hero-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1D1E1F;
        }

        .hero-text {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .hero-btns {
            text-align: right; /* محاذاة الأزرار لليمين */
        }

        .hero-btns .btn {
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 600;
        }

        .btn {
            background-color: #8B4513;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #6c3413;
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row">
                <!-- محتوى النصوص -->
                <div class="col-md-6 hero-content order-md-2">
                    <p class="lead">منصة احترافية لتقديم خدماتك.</p>
                    <h4 class="hero-title">اشترك الآن كمحامي أو شركة وابدأ بعرض أعمالك</h4>
                    <p class="hero-text">انضم إلى منصتنا التي تتيح لك فرصة الوصول إلى عملاء من جميع أنحاء العالم، مع
                        إمكانية عرض خدماتك والتواصل مع عملاء جدد بكل سهولة.</p>
                    <div class="hero-btns">
                        <a href="#" class="btn btn">ابدأ الآن</a>
                        <a href="#" class="btn btn-outline-secondary">استعرض جميع الخدمات</a>
                    </div>
                </div>

                <!-- عمود الصورة أو المحتوى الإضافي -->
                <div class="col-md-6 order-md-1">
                    <!-- يمكنك إضافة صورة أو ترك هذا الجزء فارغاً -->
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript and Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
