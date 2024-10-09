@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>جميع المنشورات</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">إضافة منشور جديد</button>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table to display posts -->
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>النص</th>
                    <th>الصورة</th>
                    <th>المستخدم</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                        <td>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" width="50" height="50" alt="Image">
                            @endif
                        </td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            <!-- Edit Button to open modal -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editPostModal{{ $post->id }}">تعديل</button>

                            <!-- Delete Form -->
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Post Modal -->
                    <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1"
                        aria-labelledby="editPostModalLabel{{ $post->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('posts.update', $post->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPostModalLabel{{ $post->id }}">تعديل المنشور
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title">العنوان</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $post->title }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="body">النص</label>
                                            <textarea name="body" class="form-control" required>{{ $post->body }}</textarea>
                                        </div>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'supervisor')
                                            <div class="form-group">
                                                <label for="user_id">المستخدم</label>
                                                <select name="user_id" class="form-control" required>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ $post->user_id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for="user_id">المستخدم</label>
                                                <select name="user_id" class="form-control" required>
                                                    <option value="{{ $post->user_id }}">
                                                        {{ $post->user->name }}</option>
                                                </select>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="image">الصورة</label>
                                            <input type="file" name="image" class="form-control">
                                            @if ($post->image)
                                                <img src="{{ asset('storage/' . $post->image) }}" width="100"
                                                    alt="Image">
                                            @endif
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

        <!-- Create Post Modal -->
        <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createPostModalLabel">إضافة منشور جديد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">العنوان</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="body">النص</label>
                                <textarea name="body" class="form-control" required></textarea>
                            </div>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'supervisor')
                                <div class="form-group">
                                    <label for="user_id">المستخدم</label>
                                    <select name="user_id" class="form-control" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="user_id">المستخدم</label>
                                    <select disabled name="user_id" class="form-control" required>
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="image">الصورة</label>
                                <input type="file" name="image" class="form-control">
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
