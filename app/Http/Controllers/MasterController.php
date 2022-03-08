<?php

namespace App\Http\Controllers;

use App\Models\Master\Garage;
use App\Models\Master\Unit;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
}
