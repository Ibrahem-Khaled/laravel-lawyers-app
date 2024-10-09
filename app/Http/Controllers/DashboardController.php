<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // جلب البيانات اللازمة
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalSubscriptions = UserSubscription::count();

        // جمع إجمالي الأرباح من جدول الاشتراكات الأساسي
        $totalProfits = UserSubscription::join('subscriptions', 'user_subscriptions.subscription_id', '=', 'subscriptions.id')
            ->sum('subscriptions.price'); // نفترض أن لديك عمود "price" في جدول الاشتراكات الأساسي

        $notifications = Notification::latest()->take(5)->get();

        // بيانات الاشتراكات والأرباح للأشهر السابقة
        $subscriptionMonths = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });

        $monthlySubscriptions = UserSubscription::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total');

        $monthlyProfits = UserSubscription::join('subscriptions', 'user_subscriptions.subscription_id', '=', 'subscriptions.id')
            ->selectRaw('MONTH(user_subscriptions.created_at) as month, SUM(subscriptions.price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total');

        return view('dashboard.index', compact(
            'totalUsers',
            'totalPosts',
            'totalSubscriptions',
            'totalProfits',
            'notifications',
            'subscriptionMonths',
            'monthlySubscriptions',
            'monthlyProfits'
        ));
    }
}
