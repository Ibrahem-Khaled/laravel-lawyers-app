<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض المستخدمين</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Fonts and icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Cairo", sans-serif;
            background-color: #f8f9fa;
        }

        .user-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .user-card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.2);
        }

        .user-card img {
            border-radius: 50%;
            margin-bottom: 15px;
            width: 120px;
            height: 120px;
            object-fit: cover;
        }

        .user-card h5 {
            font-weight: 700;
            color: #333;
        }

        .user-card p {
            color: #777;
            margin-bottom: 10px;
        }

        .user-card .btn {
            background-color: #8B4513;
            color: #fff;
            border-radius: 10px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .user-card .btn:hover {
            background-color: #6c3413;
            color: #fff;
        }

        .user-container {
            padding: 50px 0;
            flex-direction: column;
        }

        .user-container h2 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
            color: #8B4513;
        }
    </style>
</head>

<body>
    @include('homeLayouts.nav-bar')
    @include('homeLayouts.hero-section')
    <div class="container user-container">
        <h2>قائمة المحامين</h2>
        <div class="row">

            @foreach ($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="user-card">
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="User Image">
                        <h5>{{ $user->name }}</h5>
                        <p>{{ $user->email }}</p>
                        <p>+{{ $user->phone }}</p>
                        <a href="#" class="btn">التفاصيل</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('homeLayouts.subscription-section', ['plans' => $plans])
    @include('homeLayouts.contact-us')
    @include('homeLayouts.footer')

    <!-- جافا سكريبت -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
