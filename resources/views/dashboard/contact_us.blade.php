@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>رسائل اتصل بنا</h1>

    <!-- زر لإضافة رسالة جديدة -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMessageModal">إضافة رسالة جديدة</button>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <!-- عرض الرسائل -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الموضوع</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->subject }}</td>
                    <td>
                        <!-- زر لعرض وتعديل الرسالة -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editMessageModal{{ $message->id }}">عرض/تعديل</button>

                        <!-- زر لحذف الرسالة -->
                        <form action="{{ route('contact_us.destroy', $message->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- مودال لتعديل/عرض الرسالة -->
                <div class="modal fade" id="editMessageModal{{ $message->id }}" tabindex="-1" aria-labelledby="editMessageModalLabel{{ $message->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('contact_us.update', $message->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMessageModalLabel{{ $message->id }}">عرض/تعديل الرسالة</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">الاسم</label>
                                        <input type="text" name="name" class="form-control" value="{{ $message->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">البريد الإلكتروني</label>
                                        <input type="email" name="email" class="form-control" value="{{ $message->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">الموضوع</label>
                                        <input type="text" name="subject" class="form-control" value="{{ $message->subject }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">الرسالة</label>
                                        <textarea name="message" class="form-control" required>{{ $message->message }}</textarea>
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

    <!-- مودال لإضافة رسالة جديدة -->
    <div class="modal fade" id="createMessageModal" tabindex="-1" aria-labelledby="createMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('contact_us.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createMessageModalLabel">إضافة رسالة جديدة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">الموضوع</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message">الرسالة</label>
                            <textarea name="message" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">إرسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
