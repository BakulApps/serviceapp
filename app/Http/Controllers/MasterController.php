<?php

namespace App\Http\Controllers;

use App\Models\Master\Garage;
use App\Models\Master\Unit;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MasterController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function unit(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Unit::get() as $unit){
                    $data[] = [
                        $no++,
                        $unit->unit_nopol,
                        $unit->unit_merk,
                        $unit->unit_type,
                        $unit->unit_year,
                        $unit->unit_region,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$unit->unit_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$unit->unit_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'unit_nopol' => 'required',
                        'unit_merk' => 'nullable',
                        'unit_type' => 'required',
                        'unit_year' => 'nullable',
                        'unit_region' => 'nullable',
                    ], [
                        'unit_nopol.required' => 'Kolom Nomor Polisi tidak boleh kosong',
                        'unit_merk.required' => 'Kolom Merk tidak boleh kosong',
                        'unit_type.required' => 'Kolom Tipe tidak boleh kosong',
                        'unit_year.required' => 'Kolom Tahun tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $unit = new Unit();
                        $unit->unit_nopol = $request->unit_nopol;
                        $unit->unit_merk = $request->unit_merk;
                        $unit->unit_type = $request->unit_type;
                        $unit->unit_year = $request->unit_year;
                        $unit->unit_region = $request->unit_region;
                        if ($unit->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data unit berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'unit'){
                $msg = Unit::where('unit_id', $request->unit_id)->first();
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'unit_nopol' => 'required',
                        'unit_merk' => 'nullable',
                        'unit_type' => 'required',
                        'unit_year' => 'nullable',
                        'unit_region' => 'nullable',
                    ], [
                        'unit_nopol.required' => 'Kolom Nomor Polisi tidak boleh kosong',
                        'unit_merk.required' => 'Kolom Merk tidak boleh kosong',
                        'unit_type.required' => 'Kolom Tipe tidak boleh kosong',
                        'unit_year.required' => 'Kolom Tahun tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $unit = Unit::find($request->unit_id);
                        $unit->unit_nopol = $request->unit_nopol;
                        $unit->unit_merk = $request->unit_merk;
                        $unit->unit_type = $request->unit_type;
                        $unit->unit_year = $request->unit_year;
                        $unit->unit_region = $request->unit_region;
                        if ($unit->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data unit berhasil di diperbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $unit = Unit::find($request->unit_id);
                    if ($unit->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data unit berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('backend.master_unit', $this->data);
        }
    }

    public function garage(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Garage::get() as $garage){
                    $data[] = [
                        $no++,
                        $garage->garage_name,
                        $garage->garage_address,
                        $garage->garage_phone,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$garage->garage_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$garage->garage_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'garage_name' => 'required',
                        'garage_address' => 'nullable',
                        'garage_phone' => 'nullable',
                    ], [
                        'garage_name.required' => 'Kolom Nama Bengkel tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $garage = new Garage();
                        $garage->garage_name = $request->garage_name;
                        $garage->garage_address = $request->garage_address;
                        $garage->garage_phone = $request->garage_phone;
                        if ($garage->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data bengkel berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'garage'){
                $msg = Garage::where('garage_id', $request->garage_id)->first();
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'garage_name' => 'required',
                        'garage_address' => 'nullable',
                        'garage_phone' => 'nullable',
                    ], [
                        'garage_name.required' => 'Kolom Nama Bengkel tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $garage = Garage::find($request->garage_id);
                        $garage->garage_name = $request->garage_name;
                        $garage->garage_address = $request->garage_address;
                        $garage->garage_phone = $request->garage_phone;
                        if ($garage->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data bengkel berhasil di perbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $garage = Garage::find($request->garage_id);
                    if ($garage->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data bengkel berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('backend.mater_garage', $this->data);
        }
    }

    public function user(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (User::get() as $user){
                    $data[] = [
                        $no++,
                        $user->user_fullname,
                        $user->user_name,
                        '******',
                        $user->user_address,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$user->user_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$user->user_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'user_fullname' => 'required',
                        'user_name' => 'required',
                        'user_pass' => 'required',
                        'user_pass_re' => 'required',
                        'user_address' => 'required',
                    ], [
                        'user_fullname.required' => 'Kolom Nama Lengkap tidak boleh kosong',
                        'user_name.required' => 'Kolom Nama Pengguna tidak boleh kosong',
                        'user_pass.required' => 'Kolom Kata Sandi tidak boleh kosong',
                        'user_pass_re.required' => 'Kolom Ulangi Kata Sandi tidak boleh kosong',
                        'user_address.required' => 'Kolom Alamat tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        if ($request->user_pass != $request->user_pass_re){
                            throw new \Exception('Kata Sandi & Ulangi Sandi tidak sama.');
                        }
                        else {
                            $user = new User();
                            $user->user_fullname = $request->user_fullname;
                            $user->user_name = $request->user_name;
                            $user->user_pass = Hash::make($request->user_pass);
                            $user->user_address = $request->user_address;
                            if ($user->save()){
                                $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil di simpan.'];
                            }
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'user'){
                $msg = User ::where('user_id', $request->user_id)->first();
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'user_fullname' => 'required',
                        'user_name' => 'required',
                        'user_address' => 'required',
                    ], [
                        'user_fullname.required' => 'Kolom Nama Lengkap tidak boleh kosong',
                        'user_name.required' => 'Kolom Nama Pengguna tidak boleh kosong',
                        'user_address.required' => 'Kolom Alamat tidak boleh kosong',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        if (($request->user_pass) != ''){
                            if ($request->user_pass != $request->user_pass_re){
                                throw new \Exception('Kata Sandi & Ulangi Kata Sandi tidak sama.');
                            }
                        }
                        $user = User::find($request->user_id);
                        $user->user_fullname = $request->user_fullname;
                        $user->user_name = $request->user_name;
                        $user->user_pass = $request->user_pass == '' ? $user->user_pass : Hash::make($request->user_pass);
                        $user->user_address = $request->user_address;
                        if ($user->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil di perbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $user = User::find($request->user_id);
                    if ($user->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data Pengguna berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('backend.master_user', $this->data);
        }
    }
}
