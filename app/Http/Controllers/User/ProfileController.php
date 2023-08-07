<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('user.profile.index', compact('user'));
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [ // VALIDASI DATA
            'oldpass' => [
                'required', 'string', 'min:7', 'max:16',
                function ($attr, $val, $fail) { // VALIDASI PASSWORD LAMA
                    if (!Hash::check($val, Auth::user()->password)) { // JIKA PASSWORD LAMA TIDAK SESUAI
                        $fail("Password sekarang tidak sesuai! Silahkan coba lagi.");
                    }
                }
            ],
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'newpass' => ['required', 'string', 'min:7', 'max:16', 'different:oldpass'],
            'confirmpass' => ['required', 'string', 'min:7', 'max:16', 'same:newpass'],
        ], [
            'oldpass.required' => 'Password sekarang tidak boleh kosong!',
            'oldpass.min' => 'Password lama minimal 7 karakter!',
            'newpass.min' => 'Password baru minimal 7 karakter!',
            'newpass.max' => 'Password baru maksimal 16 karakter!',
            'newpass.different' => 'Password baru tidak boleh sama dengan password sekarang!',
            'confirmpass.required' => 'Konfirmasi password tidak boleh kosong!',
            'confirmpass.min' => 'Konfirmasi password minimal 7 karakter!',
            'confirmpass.max' => 'Konfirmasi password maksimal 16 karakter!',
            'confirmpass.same' => 'Konfirmasi password tidak sesuai!',
        ]);

        //dd($validator->errors()->toArray());
        if ($validator->fails()) {
            $error = [];
            foreach ($validator->errors()->toArray() as $key => $value) {
                foreach ($value as $tod) {
                    array_push($error, $tod);
                }
            }

            return redirect()->back()->with([
                'danger' => $error,
                'alert-type' => 'danger',
            ]);

        } else {
            DB::beginTransaction();
            try {
                $user = User::find(Auth::id());

                if ($user) {
                    $user->password = Hash::make($request->newpass); // HASH PASSWORD BARU
                    // $user->foto = $request->foto;
                    $foto = $request->file('foto')->store(
                        'foto-user', 'public'
                    );

                    $user->foto = $foto;

                    if ($user->isDirty()) { // JIKA ADA PERUBAHAN
                        $user->update();

                        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui!');
                    } else {
                        return redirect()->route('profile')->with('warning', 'Password tidak ada perubahan!');
                    }
                } else {
                    return redirect()->route('profile')->with('error', 'Data tidak ditemukan!');
                }
            } catch (\Illuminate\Database\QueryException $th) {
                DB::rollBack();

                $msg = $th->getMessage();
                if (isset($th->errorInfo[2])) {
                    $msg = $th->errorInfo[2];
                }

                return response()->json([
                    'status' => 400,
                    'message' => "Terjadi kesalahan saat memperbarui data!\nPesan: $msg",
                ]);
            } finally {
                DB::commit();
            }
        }

    }
}
