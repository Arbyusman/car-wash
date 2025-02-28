<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Role';
        $description = 'Detail Akses Role User';
        $role = Role::orderBy('created_at', 'desc')->get();

        return view('admin.role.index', compact('title', 'role', 'description'));
    }

    public function create()
    {
        $title = 'Tambah Role';
        $lastRole = Role::latest('id')->pluck('id')->first();
        $view = view('admin.role.create', compact('title', 'lastRole'));
        $view = $view->render();

        return $view;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role_id' => 'required|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');

            return redirect('/admin/roles/create');
        }

        $input = [
            'name' => $request->name,
            'role_id' => $request->role_id,
            'status' => $request->status,
        ];

        Role::create($input);
        Alert::toast('Role Berhasil Ditambah', 'success');

        return redirect('/admin/roles');
    }

    public function edit(Role $Role, $roleId)
    {
        $id = crypt::decrypt($roleId);
        $role = Role::findOrFail($id);
        $lastRole = Role::latest('id')->pluck('id')->first();
        $title = 'Edit Role';
        $view = view('admin.role.edit', compact('title', 'role', 'lastRole'));
        $view = $view->render();

        return $view;
    }

    public function update(Request $request, $roleId)
    {
        $id = Crypt::decrypt($roleId);
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');

            return redirect()->route('menus.edit', ['id' => $roleId])
                ->withErrors($validator)
                ->withInput();
        }
        $input = [
            'name' => $request->name,
            'status' => $request->status,
        ];

        $role->update($input);
        Alert::toast('Role Berhasil Di Ubah', 'success');

        return redirect('/admin/roles');
    }

    public function destroy(Request $request)
    {
        $roleId = Crypt::decrypt($request->id);
        $role = Role::findOrFail($roleId);
        $role->delete();
        Alert::toast('Role Berhasil Di Hapus', 'success');

        return redirect('/admin/roles')->with('status', 'Role Berhasil Dihapus');
    }
}
