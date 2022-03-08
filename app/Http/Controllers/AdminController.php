<?php

namespace App\Http\Controllers;

use App\Models\Emisi;
use App\Models\Master\Garage;
use App\Models\Master\Unit;
use App\Models\Setting;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting']  = new Setting();
    }
    public function home()
    {
        return view('backend.home', $this->data);
    }

    public function monitoring(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                foreach (Transaction::orderBy('transaction_id', 'DESC')->get() as $transaction){
                    switch ($transaction->transaction_status){
                        case 1 :
                            $status = "<span class='badge badge-pill badge-danger'>Booking</span>";
                            break;
                        case 2 :
                            $status = "<span class='badge badge-pill badge-success'>On Proccess</span>";
                            break;
                        case 3 :
                            $status = "<span class='badge badge-pill badge-primary'>Finished</span>";
                    }
                    $data[] = [
                        $no++,
                        $transaction->unit->unit_nopol.'/'.$transaction->unit->unit_type,
                        $transaction->garage->garage_name,
                        $transaction->transaction_customer,
                        $transaction->transaction_desc,
                        $transaction->date_in(),
                        $status,
                        '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="'.$transaction->transaction_id.'"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="'.$transaction->transaction_id.'"><i class="icon-trash"></i></button>
                         </div>
                         '
                    ];
                };
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'store'){
                try {
                    $validator = Validator::make($request->all(),[
                        'transaction_date_in' => 'required',
                        'transaction_unit' => 'required',
                        'transaction_garage' => 'required',
                        'transaction_customer' => 'required',
                        'transaction_phone' => 'nullable',
                        'transaction_desc' => 'required',
                    ], [
                        'transaction_date_in.required' => 'Kolom tanggal masuk tidak boleh kosong.',
                        'transaction_unit.required' => 'Silahkan memilih unit terlebih dahulu.',
                        'transaction_garage.required' => 'Silahkan memilih bengkel terlebih dahulu.',
                        'transaction_customer.required' => 'Kolom nama pelanggan tidak boleh kosong.',
                        'transaction_phone.required' => 'Kolom telepon pelanggan tidak boleh kosong.',
                        'transaction_desc.required' => 'Kolom keterangan tidak boleh kosong.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $transaction = new Transaction();
                        $transaction->transaction_date_in = Carbon::createFromFormat('d/m/Y', $request->transaction_date_in)->format('Y-m-d');
                        $transaction->transaction_unit = $request->transaction_unit;
                        $transaction->transaction_garage = $request->transaction_garage;
                        $transaction->transaction_customer = $request->transaction_customer;
                        $transaction->transaction_phone = $request->transaction_phone;
                        $transaction->transaction_desc = $request->transaction_desc;
                        $transaction->transaction_status = 1;
                        if ($transaction->save()){
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data transaksi berhasil di simpan.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'data' && $request->_data == 'transaction'){
                $transaction = Transaction::where('transaction_id', $request->transaction_id)->first();
                $transaction->transaction_date_in = Carbon::parse($transaction->transaction_date_in)->format('d/m/Y');
                $transaction->transaction_date_finish = Carbon::parse($transaction->transaction_date_finish)->format('d/m/Y');
                $transaction->transaction_unit = ['id' => $transaction->unit->unit_id, 'text' => $transaction->unit->unit_nopol.'/'.$transaction->unit->unit_type];
                $transaction->transaction_garage = ['id' => $transaction->garage->garage_id, 'text' => $transaction->garage->garage_name];
                $transaction->transaction_emisi = $transaction->emisi != null ? $transaction->emisi->first() : [];
                $msg = $transaction;
            }
            elseif ($request->_type == 'update'){
                try {
                    $validator = Validator::make($request->all(),[
                        'transaction_date_in' => 'required',
                        'transaction_date_finish' => 'required',
                        'transaction_unit' => 'required',
                        'transaction_garage' => 'required',
                        'transaction_customer' => 'required',
                        'transaction_phone' => 'required',
                        'transaction_desc' => 'required',
                        'transaction_desc_finish' => 'nullable',
                        'transaction_stiker' => 'nullable',
                        'transaction_apar' => 'nullable',
                        'transaction_status' => 'nullable',
                        'emisi_co' => 'nullable',
                        'emisi_hc' => 'nullable',
                        'emisi_co2' => 'nullable',
                        'emisi_o2' => 'nullable',
                        'emisi_lamda' => 'nullable',
                    ], [
                        'transaction_date_in.required' => 'Kolom tanggal masuk tidak boleh kosong.',
                        'transaction_date_finish.required' => 'Kolom tanggal selesai tidak boleh kosong.',
                        'transaction_unit.required' => 'Silahkan memilih unit terlebih dahulu.',
                        'transaction_garage.required' => 'Silahkan memilih bengkel terlebih dahulu.',
                        'transaction_customer.required' => 'Kolom nama pelanggan tidak boleh kosong.',
                        'transaction_phone.required' => 'Kolom nomor pelanggan tidak boleh kosong.',
                        'transaction_desc.required' => 'Kolom keterangan tidak boleh kosong.',
                        'transaction_desc_finish.required' => 'Kolom keterangan perbaikan tidak boleh kosong.',
                        'transaction_stiker.required' => 'Silahkan memilih opsi stiker terlebih dahulu.',
                        'transaction_apar.required' => 'Silahkan memilih opsi apar terlebih dahulu.',
                        'transaction_status.required' => 'Silahkan memilih opsi status perbaikan terlebih dahulu.',
                        'emisi_co.required' => 'Kolom emisi CO tidak boleh kosong.',
                        'emisi_hc.required' => 'Kolom emisi HC tidak boleh kosong.',
                        'emisi_co2.required' => 'Kolom emisi CO<sup>2</sup> tidak boleh kosong.',
                        'emisi_o2.required' => 'Kolom emisi O<sup>2</sup> tidak boleh kosong.',
                        'emisi_lamda.required' => 'Kolom emisi lamda tidak boleh kosong.',
                    ]);
                    if ($validator->fails()){
                        throw new \Exception(Arr::first(Arr::flatten($validator->getMessageBag()->get('*'))));
                    }
                    else {
                        $transaction = Transaction::find($request->transaction_id);
                        $transaction->transaction_date_in = Carbon::createFromFormat('d/m/Y', $request->transaction_date_in)->format('Y-m-d');
                        $transaction->transaction_date_finish = Carbon::createFromFormat('d/m/Y', $request->transaction_date_finish)->format('Y-m-d');
                        $transaction->transaction_unit = $request->transaction_unit;
                        $transaction->transaction_garage = $request->transaction_garage;
                        $transaction->transaction_customer = $request->transaction_customer;
                        $transaction->transaction_phone = $request->transaction_phone;
                        $transaction->transaction_desc = $request->transaction_desc;
                        $transaction->transaction_desc_finish = $request->transaction_desc_finish;
                        $transaction->transaction_stiker = $request->transaction_stiker;
                        $transaction->transaction_apar = $request->transaction_apar;
                        $transaction->transaction_status = $request->transaction_status;
                        if ($transaction->save()){
                            if ($transaction->emisi == null){
                                $emisi = new Emisi();
                            }
                            else {
                                $emisi = Emisi::find($transaction->emisi->emisi_id);
                            }
                            $emisi->emisi_transaction = $transaction->transaction_id;
                            $emisi->emisi_co = $request->emisi_co;
                            $emisi->emisi_hc = $request->emisi_hc;
                            $emisi->emisi_co2 = $request->emisi_co2;
                            $emisi->emisi_o2 = $request->emisi_o2;
                            $emisi->emisi_lamda = $request->emisi_lamda;
                            $emisi->save();
                            $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data transaksi berhasil di perbarui.'];
                        }
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            elseif ($request->_type == 'delete'){
                try {
                    $transaction = Transaction::with('emisi')->find($request->transaction_id);
                    if ($transaction->emisi()->delete() && $transaction->delete()){
                        $msg = ['title' => 'Sukses !', 'class' => 'success', 'text' => 'Data bengkel berhasil dihapus.'];
                    }
                } catch (\Exception $e){
                    $msg = ['title' => 'Gagal !', 'class' => 'danger', 'text' => $e->getMessage()];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('backend.monitoring', $this->data);
        }
    }

    public function api(Request $request)
    {
        switch ($request->_data){
            case 'unit' :
                $msg = $this->apiunit($request);
                break;
            case 'garage' :
                $msg = $this->apigarage($request);
                break;
            default :
                $msg = null;
                break;
        }
        return $msg;
    }

    public function apiunit(Request $request)
    {
        if ($request->_type == 'select'){
            $units = Unit::where('unit_type', 'LIKE', '%'.$request->search.'%')->orWhere('unit_nopol', 'LIKE', '%'.$request->search.'%')->get();
            foreach ($units as $unit){
                $msg[] = ['id' => $unit->unit_id, 'text' => $unit->unit_nopol .'/'.$unit->unit_type];
            }
        }
        return $msg;

    }

    public function apigarage(Request $request)
    {
        if ($request->_type == 'select'){
            $garages = Garage::where('garage_name', 'LIKE', '%'.$request->search.'%')->get();
            foreach ($garages as $garage){
                $msg[] = ['id' => $garage->garage_id, 'text' => $garage->garage_name];
            }
        }
        return $msg;

    }
}
