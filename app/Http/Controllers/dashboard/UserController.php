<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.users', compact('users'));
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'username' => 'nullable|string|unique:users',
            'phone' => 'nullable|string|unique:users',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string',
            'gender' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'lat' => 'nullable|string',
            'lng' => 'nullable|string',
            'role' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
            'password' => 'required|min:6',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // التعامل مع رفع الصورة
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = null;
        }

        // إنشاء مستخدم جديد وتخزين البيانات
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'country' => $validated['country'],
            'city' => $validated['city'] ?? null,
            'postal_code' => $validated['postal_code'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'birth_date' => $validated['birth_date'] ?? null,
            'lat' => $validated['lat'] ?? null,
            'lng' => $validated['lng'] ?? null,
            'role' => $validated['role'] ?? 'user',
            'status' => $validated['status'] ?? 'active',
            'password' => bcrypt($validated['password']),
            'avatar' => $avatarPath,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة المستخدم بنجاح');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // التحقق من صحة البيانات مع تجاهل القيم الفريدة الحالية للمستخدم
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'nullable|string|unique:users,username,' . $id,
            'phone' => 'nullable|string|unique:users,phone,' . $id,
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'gender' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'lat' => 'nullable|string',
            'lng' => 'nullable|string',
            'role' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // التعامل مع رفع الصورة الجديدة
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                // حذف الصورة القديمة
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        } else {
            $avatarPath = $user->avatar;
        }

        // تحديث بيانات المستخدم
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'country' => $validated['country'],
            'city' => $validated['city'] ?? $user->city,
            'postal_code' => $validated['postal_code'] ?? $user->postal_code,
            'gender' => $validated['gender'] ?? $user->gender,
            'birth_date' => $validated['birth_date'] ?? $user->birth_date,
            'lat' => $validated['lat'] ?? $user->lat,
            'lng' => $validated['lng'] ?? $user->lng,
            'role' => $validated['role'] ?? 'user',
            'status' => $validated['status'] ?? 'active',
            'avatar' => $avatarPath,
        ]);

        return redirect()->back()->with('success', 'تم تعديل المستخدم بنجاح');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // حذف الصورة عند حذف المستخدم
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->back()->with('success', 'تمت العملية بنجاح');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 'active') {
            $user->status = 'inactive';
        } else {
            $user->status = 'active';
        }

        $user->save();

        return redirect()->back()->with('success', 'تم تحديث حالة المستخدم بنجاح.');
    }
}
