<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('dashboard.subscriptions', compact('subscriptions'));
    }

    public function create()
    {
        return view('subscriptions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        Subscription::create($validated);

        return redirect()->route('subscriptions.index')->with('success', 'تم إنشاء الاشتراك بنجاح.');
    }

    public function edit(Subscription $subscription)
    {
        return view('subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $subscription->update($validated);

        return redirect()->route('subscriptions.index')->with('success', 'تم تحديث الاشتراك بنجاح.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', 'تم حذف الاشتراك بنجاح.');
    }
}
