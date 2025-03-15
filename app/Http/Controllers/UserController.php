<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Pengguna';
        $description = 'Detail Pengguna';
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('title', 'users', 'description'));
    }

    public function create(Request $request)
    {
        $title = 'Tambah Pengguna';
        $role = Role::all();
        $view = view('admin.users.create', compact('title', 'role'));
        $view = $view->render();

        return $view;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|max:100|min:5|confirmed',
            'password_confirmation' => 'required|string|max:100|min:5',
            'jenis_kelamin' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'role' => 'required|max:10',
        ]);


        if ($validator->fails()) {
            $errorMessage = $validator->messages()->all();
            Alert::toast($errorMessage, 'error');
            return redirect()->back()->withInput();
        }

        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ];

        $file = $request->file('avatar');
        if ($file) {
            $filename = time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            Storage::putFileAs('public/images', $file, $filename);
            $input['avatar'] = $filename;
        }

        User::create($input);

        Alert::toast('User Berhasil Ditambah', 'success');

        return redirect('/admin/users')->with('status', 'User Berhasil Ditambah');
    }

    public function edit(Request $request, $userId)
    {

        $id = crypt::decrypt($userId);
        $user = User::findOrFail($id);
        $title = 'Edit Pengguna';
        $role = Role::all();
        $view = view('admin.users.edit', compact('title', 'role', 'user'));
        $view = $view->render();

        return $view;
    }

    public function update(Request $request, $userId)
    {
        $id = Crypt::decrypt($userId);
        $user = User::findOrFail($id);
        $userId = $user->id;
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($userId),
            ],
            'password' => 'nullable|string|max:100|min:5|confirmed',
            'password_confirmation' => 'nullable|string|max:100|min:5',
            'jenis_kelamin' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|max:10',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');

            return redirect()->back()
                ->withInput();
        }


        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        if ($request->password) {
            $file = $request->file('avatar');
            $input['password'] =  Hash::make($request->password);
        }

        try {

            $file = $request->file('avatar');
            if ($file) {
                $filename = time() . '.' . $request->file('avatar')->getClientOriginalExtension();
                Storage::putFileAs('public/images', $file, $filename);
                $input['avatar'] = $filename;
            }
        } catch (\Exception $e) {

            Alert::toast('Failed to upload image. Please try again.', 'error');

            return redirect()->back()
                ->withErrors('Failed to upload image. Please try again.')
                ->withInput();
        }

        $user->update($input);
        Alert::toast('User Berhasil Di Ubah', 'success');

        return redirect('/admin/users')->with('status', 'User Berhasil Di Ubah');
    }

    public function editProfile(Request $request, $userId)
    {
        $id = crypt::decrypt($userId);
        $user = User::findOrFail($id);
        $title = 'Edit Pengguna';
        $role = Role::all();
        $view = view('admin.users.profile', compact('title', 'role', 'user'));
        $view = $view->render();

        return $view;
    }

    public function updateProfile(Request $request, $userId)
    {
        $id = Crypt::decrypt($userId);
        $user = User::findOrFail($id);

        $userId = $user->id;
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($userId),
            ],
            'identification_number' => 'nullable',
            'phone' => 'nullable|string|max:20',
        ]);

        if ($request->currentPassword) {
            if (! Hash::check($request->currentPassword, $user->password)) {
                Alert::toast('Password Sebelumnya Salah', 'error');

                return redirect()->back()
                    ->withErrors('Password Sebelumnya Salah');
            } else {
                $validator->sometimes('password', 'required|string|min:5|max:100|confirmed', function ($input) {
                    return $input->password !== null;
                });
            }
        }

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');

            return redirect()->back();
        }
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->password) {
            $input['password'] = Hash::make($request->password);
        }

        $file = $request->file('avatar');
        if ($file) {
            $filename = time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            Storage::putFileAs('public/images', $file, $filename);
            $input['avatar'] = $filename;
        }

        $user->update($input);
        Alert::toast('Profil Berhasil Di Ubah', 'success');

        return redirect()->back()->with('status', 'Profil Berhasil Di Ubah');
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {
            $userId = Crypt::decrypt($request->id);
            $user = User::findOrFail($userId);
            $user->absens()->delete();
            $user->delete();

            DB::commit();

            Alert::toast('User Berhasil Dihapus', 'success');

            return redirect('/admin/users')->with('status', 'User Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Terjadi kesalahan saat menghapus user', 'error');

            return redirect()->back()->withErrors('Terjadi kesalahan saat menghapus user');
        }
    }

    public function resetPassword(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'resetPassword' => 'required|string|min:5|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/users/edit')->withErrors($validator)->withErrors('Gagal reset password');
        }
        $user = User::findOrFail($userId);
        $user->password = Hash::make($request->resetPassword);
        $user->save();

        Alert::toast('Password Berhasil Di Reset', 'success');

        return redirect()->back()->with('status', 'Password Berhasil Di Reset');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->back()->with('success', 'Users imported successfully!');
    }
}
