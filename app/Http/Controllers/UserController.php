<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;

use Hash;
use Auth;
use File;
use Session;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function user()
    {
        $user = User::all();
        return view('user',['user' => $user]);
    }

    public function user_add()
    {
        return view('user_add');
    }

    public function user_aksi(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'level' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('foto');
        
        // cek jika gambar kosong
        if($file != ""){
            // menambahkan waktu sebagai pembuat unik nnama file gambar
            $nama_file = time()."_".$file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar/user';
            $file->move($tujuan_upload,$nama_file);
        }else{
            $nama_file = "";
        }
 
 
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level,
            'foto' => $nama_file
        ]);

        return redirect('/user')->with('success','User has been saved');
    }

    public function user_edit($id)
    {
        $user = User::find($id);
        return view('user_edit',compact('user'));
    }

     public function user_update($id ,Request $req)
    {
         $this->validate($req, [
            'name' => 'required',
            'email' => 'required|email',
            'level' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $name = $req->input('name');
        $email = $req->input('email');
        $password = $req->input('password');
        $level = $req->input('level');
        

        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        if($password != ""){
            $user->password = bcrypt($password);
        }

        // menyimpan data file yang diupload ke variabel $file
        $file = $req->file('foto');
        
        // cek jika gambar tidak kosong
        if($file != ""){
            // menambahkan waktu sebagai pembuat unik nnama file gambar
            $nama_file = time()."_".$file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar/user';
            $file->move($tujuan_upload,$nama_file);

            // hapus file gambar lama
            File::delete('gambar/user/'.$user->foto);

            $user->foto = $nama_file;
        }
        $user->level = $level;
        $user->save();

        return redirect('/user')->with("success","User has been updated!");
    }

    public function user_delete($id)
    {
        $user = User::find($id);
        // hapus file gambar lama
        if($user->foto != "")
        File::delete('gambar/user/'.$user->foto);
        $user->delete();

        return redirect('/user')->with('success','User has been deleted!');
    }

    public function password()
    {
        return view('reset_password');
    }

    public function password_update(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
            return redirect()->back()->with('error','Your current password does not matches with the password you provided. Please try again.');
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
            return redirect()->back()->with('error','New Password cannot be same as your current password. Please choose a different password.');
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with('success','Password has been changed!');
    }
}
