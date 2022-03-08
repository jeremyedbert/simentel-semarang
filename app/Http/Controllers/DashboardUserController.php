<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users', [
            'data' => User::all(),
            'notif' => Notifikasi::whereNull('mark_as_read')->get(),
            'countNotif' => DB::table('notifikasis')
                ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                ->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user', [
            'data' => $user,
            'notif' => Notifikasi::whereNull('mark_as_read')->get(),
            'countNotif' => DB::table('notifikasis')
                ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                ->count()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return dd($user);
        return view('admin.edit-user', [
            'data' => $user,
            'notif' => Notifikasi::whereNull('mark_as_read')->get(),
            'countNotif' => DB::table('notifikasis')
                ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                ->count()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $passwordAdmin = $request->password_admin;
        // return dd(Hash::check($passwordAdmin, Auth::user()->getAuthPassword()));
        $phone = $request->phone;
        if ($request->password == '') {

            // if (Hash::check($passwordAdmin, Auth::user()->getAuthPassword())) {
            $rules = [
                'name' => 'required',
                'email' => ['required', 'email:dns', Rule::unique('users', 'email')->ignore($user->id)],
                'phone' => ['required', Rule::unique('users', 'phone')->ignore($user->id)],
                'password_admin' => 'required|current_password:admin'
            ];
            $validatedData = $request->validate($rules, [
                'name.required' => 'Kolom nama wajib diisi.',
                'email.unique' => 'Email sudah dipakai oleh pengguna lain.',
                'email.email' => 'Email tidak sesuai.',
                'phone.required' => 'Kolom nomor handphone wajib diisi.',
                'phone.unique' => 'Nomor HP sudah dipakai oleh pengguna lain.',
                'password_admin.required' => 'Kolom password admin wajib diisi',
                'password_admin.current_password' => 'Password Anda tidak sesuai.',
            ]);
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
            // } else {
            //     return back()->with('error', 'Password Anda tidak sesuai');
            // }
        } else {
            // if (Hash::check($passwordAdmin, Auth::user()->getAuthPassword())) {
            $rules = [
                'name' => 'required',
                'email' => ['required', 'email:dns', Rule::unique('users', 'email')->ignore($user->id)],
                'phone' => ['required', Rule::unique('users', 'phone')->ignore($user->id)],
                'password' => 'min:5|max:30',
                'cpassword' => 'required|same:password',
                'password_admin' => 'required|current_password:admin',
                // 'password_admin' => 'required|min:5|max_30'
            ];
            $validatedData = $request->validate($rules, [
                'name.required' => 'Kolom nama wajib diisi.',
                'email.unique' => 'Email sudah dipakai oleh pengguna lain.',
                'email.email' => 'Email tidak sesuai.',
                'phone.required' => 'Kolom nomor handphone wajib diisi.',
                'phone.unique' => 'Nomor HP sudah dipakai oleh pengguna lain.',
                'password.min' => 'Password minimal 5 karakter.',
                'password.max' => 'Password maksimal 30 karakter.',
                'cpassword.same' => 'Password konfirmasi tidak sesuai.',
                'cpassword.required' => 'Password konfirmasi wajib diisi.',
                'password_admin.required' => 'Kolom password admin wajib diisi.',
                'password_admin.current_password' => 'Password Anda tidak sesuai.',
            ]);
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            // } else {
            //     return back()->with('error', 'Password Anda tidak sesuai');
            // }
        }

        // return dd($user->phone, $validatedData['phone']);

        // $passwordAdmin = $request->password_admin;


        return redirect('/admin/kelola-user/' . $user->id)->with('success', 'Data pengguna berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/admin/kelola-user')->with('success', 'Akun sudah dihapus');
    }
}
