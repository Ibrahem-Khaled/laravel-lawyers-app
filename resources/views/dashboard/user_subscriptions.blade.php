@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>اشتراكات المستخدمين</h1>

    <!-- زر لإضافة اشتراك جديد -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserSubscriptionModal">إضافة اشتراك جديد</button>

    <!-- عرض رسالة النجاح -->
    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <!-- جدول لعرض الاشتراكات -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>اسم المستخدم</th>
                <th>الاشتراك</th>
                <th>تاريخ البداية</th>
                <th>تاريخ النهاية</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userSubscriptions as $userSubscription)
                <tr>
                    <td>{{ $userSubscription->user->name }}</td>
                    <td>{{ $userSubscription->subscription->title }}</td>
                    <td>{{ $userSubscription->start_date->format('Y-m-d') }}</td>
                    <td>{{ $userSubscription->end_date->format('Y-m-d') }}</td>
                    <td>{{ $userSubscription->status == 'active' ? 'مفعل' : 'غير مفعل' }}</td>
                    <td>
                        <!-- زر لتعديل الاشتراك -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserSubscriptionModal{{ $userSubscription->id }}">تعديل</button>

                        <!-- زر لحذف الاشتراك -->
                        <form action="{{ route('user_subscriptions.destroy', $userSubscription->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- مودال تعديل الاشتراك -->
                <div class="modal fade" id="editUserSubscriptionModal{{ $userSubscription->id }}" tabindex="-1" aria-labelledby="editUserSubscriptionModalLabel{{ $userSubscription->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('user_subscriptions.update', $userSubscription->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserSubscriptionModalLabel{{ $userSubscription->id }}">تعديل الاشتراك</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="user_id">المستخدم</label>
                                        <select name="user_id" class="form-control" required>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $userSubscription->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subscription_id">الاشتراك</label>
                                        <select name="subscription_id" class="form-control" required>
                                            @foreach($subscriptions as $subscription)
                                                <option value="{{ $subscription->id }}" {{ $userSubscription->subscription_id == $subscription->id ? 'selected' : '' }}>{{ $subscription->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">الحالة</label>
                                        <select name="status" class="form-control" required>
                                            <option value="active" {{ $userSubscription->status == 'active' ? 'selected' : '' }}>مفعل</option>
                                            <option value="inactive" {{ $userSubscription->status == 'inactive' ? 'selected' : '' }}>غير مفعل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- مودال لإضافة اشتراك جديد -->
    <div class="modal fade" id="createUserSubscriptionModal" tabindex="-1" aria-labelledby="createUserSubscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('user_subscriptions.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserSubscriptionModalLabel">إضافة اشتراك جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="user_id">المستخدم</label>
                            <select name="user_id" class="form-control" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subscription_id">الاشتراك</label>
                            <select name="subscription_id" class="form-control" required>
                                @foreach($subscriptions as $subscription)
                                    <option value="{{ $subscription->id }}">{{ $subscription->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">الحالة</label>
                            <select name="status" class="form-control" required>
                                <option value="active">مفعل</option>
                                <option value="inactive">غير مفعل</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
