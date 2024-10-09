<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    public function index()
    {
        $userSubscriptions = UserSubscription::with(['user', 'subscription'])->get();
        $users = User::all();
        $subscriptions = Subscription::all();
        return view('dashboard.user_subscriptions', compact('userSubscriptions', 'users', 'subscriptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'status' => 'required|in:active,inactive',
        ]);

        // الحصول على الاشتراك لحساب المدة
        $subscription = Subscription::find($validated['subscription_id']);
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addMonths($subscription->duration);

        // إنشاء الاشتراك
        UserSubscription::create([
            'user_id' => $validated['user_id'],
            'subscription_id' => $validated['subscription_id'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'تم إضافة الاشتراك بنجاح.');
    }

    public function update(Request $request, UserSubscription $userSubscription)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'status' => 'required|in:active,inactive',
        ]);

        $subscription = Subscription::find($validated['subscription_id']);
        $endDate = Carbon::parse($userSubscription->start_date)->addMonths($subscription->duration);

        $userSubscription->update([
            'user_id' => $validated['user_id'],
            'subscription_id' => $validated['subscription_id'],
            'end_date' => $endDate,
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'تم تحديث الاشتراك بنجاح.');
    }

    public function destroy(UserSubscription $userSubscription)
    {
        $userSubscription->delete();
        return redirect()->back()->with('success', 'تم حذف الاشتراك بنجاح.');
    }
}
