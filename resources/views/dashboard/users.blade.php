@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2>إدارة المستخدمين</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">إضافة مستخدم</button>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الصورة الشخصية</th>
                    <th>الحالة</th>
                    <th>الدور</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="50"></td>
                        <td>{{ $user->status == 'active' ? 'مفعل' : 'غير مفعل' }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <!-- زر لتفعيل أو إلغاء تفعيل المستخدم -->
                            <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="btn btn-sm {{ $user->status == 'active' ? 'btn-danger' : 'btn-success' }}">
                                    {{ $user->status == 'active' ? 'إلغاء التفعيل' : 'تفعيل' }}
                                </button>
                            </form>

                            <!-- الأزرار الأخرى مثل تعديل وحذف المستخدم -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $user->id }}">تعديل</button>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">حذف</button>
                            </form>
                        </td>

                    </tr>

                    <!-- تعديل المودال -->
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                        aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('users.update', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel">تعديل المستخدم</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">الاسم</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $user->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="role">الدور</label>
                                            <select class="form-control" name="role" required>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>أدمن
                                                </option>
                                                <option value="supervisor"
                                                    {{ $user->role == 'supervisor' ? 'selected' : '' }}>مشرف
                                                </option>
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>مستخدم
                                                </option>
                                                <option value="lawyer" {{ $user->role == 'lawyer' ? 'selected' : '' }}>
                                                    محامٍ
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">اسم المستخدم</label>
                                            <input type="text" class="form-control" name="username"
                                                value="{{ $user->username }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">الهاتف</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $user->phone }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">العنوان</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $user->address }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="country">البلد</label>
                                            <input type="text" class="form-control" name="country"
                                                value="{{ $user->country }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="avatar">الصورة الشخصية</label>
                                            <input type="file" class="form-control" name="avatar">
                                        </div>
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="100">
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

        <!-- إضافة مودال -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">إضافة مستخدم</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">كلمة المرور</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="role">الدور</label>
                                <select class="form-control" name="role" required>
                                    <option value="admin">أدمن</option>
                                    <option value="supervisor">مشرف</option>
                                    <option value="user">مستخدم</option>
                                    <option value="lawyer">محامٍ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="avatar">الصورة الشخصية</label>
                                <input type="file" class="form-control" name="avatar">
                            </div>
                            <div class="form-group">
                                <label for="username">اسم المستخدم</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label for="phone">الهاتف</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="address">العنوان</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="form-group">
                                <label for="country">البلد</label>
                                <input type="text" class="form-control" name="country">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-primary">إضافة المستخدم</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
