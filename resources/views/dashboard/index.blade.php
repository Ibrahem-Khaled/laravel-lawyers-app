@extends('layouts.dashboard')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">لوحة التحكم</h1>

        <!-- الإحصائيات -->
        <div class="row text-center">
            <!-- إجمالي المستخدمين -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي المستخدمين</h5>
                        <h2>{{ $totalUsers }}</h2>
                        <i class="fas fa-users fa-3x text-primary"></i>
                    </div>
                </div>
            </div>

            <!-- إجمالي المنشورات -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي المنشورات</h5>
                        <h2>{{ $totalPosts }}</h2>
                        <i class="fas fa-file-alt fa-3x text-warning"></i>
                    </div>
                </div>
            </div>

            <!-- إجمالي الاشتراكات -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الاشتراكات</h5>
                        <h2>{{ $totalSubscriptions }}</h2>
                        <i class="fas fa-receipt fa-3x text-success"></i>
                    </div>
                </div>
            </div>

            <!-- إجمالي الأرباح -->
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">إجمالي الأرباح</h5>
                        <h2>${{ number_format($totalProfits, 2) }}</h2>
                        <i class="fas fa-dollar-sign fa-3x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- الرسوم البيانية -->
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title">الاشتراكات على مدار الأشهر</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="subscriptionsChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title">الأرباح على مدار الأشهر</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="profitsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- التنبيهات -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title">التنبيهات</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($notifications as $notification)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $notification->message }}
                                    <span
                                        class="badge bg-primary rounded-pill">{{ $notification->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- إضافة الرسوم البيانية -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const subscriptionsChart = new Chart(document.getElementById('subscriptionsChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: @json($subscriptionMonths), // استبدال $profitsMonths بـ $subscriptionMonths
                datasets: [{
                    label: 'الاشتراكات',
                    data: @json($monthlySubscriptions),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            }
        });

        const profitsChart = new Chart(document.getElementById('profitsChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: @json($subscriptionMonths), // استبدال $profitsMonths بـ $subscriptionMonths
                datasets: [{
                    label: 'الأرباح',
                    data: @json($monthlyProfits),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                }]
            }
        });
    </script>
@endsection
