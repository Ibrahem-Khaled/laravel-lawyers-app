@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>الاشتراكات</h1>

        <!-- زر لفتح مودال إضافة اشتراك جديد -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSubscriptionModal">إضافة اشتراك
            جديد</button>

        <!-- عرض رسالة النجاح -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- جدول لعرض الاشتراكات -->
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>الوصف</th>
                    <th>السعر</th>
                    <th>المدة</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->title }}</td>
                        <td>{{ $subscription->description }}</td>
                        <td>{{ $subscription->price }}</td>
                        <td>{{ $subscription->duration }}</td>
                        <td>{{ $subscription->status == 'active' ? 'مفعل' : 'غير مفعل' }}</td>
                        <td>
                            <!-- زر لتعديل الاشتراك -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editSubscriptionModal{{ $subscription->id }}">تعديل</button>

                            <!-- زر لحذف الاشتراك -->
                            <form action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>

                    <!-- مودال لتعديل الاشتراك -->
                    <div class="modal fade" id="editSubscriptionModal{{ $subscription->id }}" tabindex="-1"
                        aria-labelledby="editSubscriptionModalLabel{{ $subscription->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('subscriptions.update', $subscription->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSubscriptionModalLabel{{ $subscription->id }}">
                                            تعديل الاشتراك</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title">العنوان</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $subscription->title }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">الوصف</label>
                                            <textarea name="description" class="form-control" required>{{ $subscription->description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">السعر</label>
                                            <input type="number" name="price" class="form-control" step="0.01"
                                                value="{{ $subscription->price }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="duration">المدة</label>
                                            <input type="text" name="duration" class="form-control"
                                                value="{{ $subscription->duration }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">الحالة</label>
                                            <select name="status" class="form-control" required>
                                                <option value="active"
                                                    {{ $subscription->status == 'active' ? 'selected' : '' }}>مفعل</option>
                                                <option value="inactive"
                                                    {{ $subscription->status == 'inactive' ? 'selected' : '' }}>غير مفعل
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">إلغاء</button>
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
        <div class="modal fade" id="createSubscriptionModal" tabindex="-1" aria-labelledby="createSubscriptionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('subscriptions.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createSubscriptionModalLabel">إضافة اشتراك جديد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">العنوان</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">الوصف</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">السعر</label>
                                <input type="number" name="price" class="form-control" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="duration">المدة</label>
                                <input type="text" name="duration" class="form-control" required>
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
