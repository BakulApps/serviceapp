<?php

namespace App\Http\Controllers;

use App\Models\Master\Unit;
use App\Models\Setting;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] =  new Setting();
    }

    public function unit(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                if ($request->unit_id != null){
                    $unit = Unit::find($request->unit_id)->first();
                    if ($unit->transaction != null){
                        foreach ($unit->transaction->get() as $transaction) {
                            switch ($transaction->transaction_status) {
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
                                $transaction->garage->garage_name,
                                $transaction->transaction_customer,
                                $transaction->transaction_desc,
                                $transaction->date_in(),
                                $status,
                                '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-edit" data-num="' . $transaction->transaction_id . '"><i class="icon-pencil"></i></button>
                            <button class="btn btn-outline-primary bt-sm btn-delete" data-num="' . $transaction->transaction_id . '"><i class="icon-trash"></i></button>
                         </div>
                         '
                            ];
                        }
                    }
                    else {
                        $data = null;
                    }
                }
                else {
                    $data = null;
                }
                $msg = ['data' => empty($data) ? [] : $data];
            }
            elseif ($request->_type == 'data' && $request->_data == 'unit'){
                $unit = Unit::where('unit_nopol', 'LIKE', '%'.$request->unit_nopol.'%');
                if ($unit->count() >= 1){
                    $msg = $unit->get();
                }
                else {
                    $msg = ['title' => 'Sukses !', 'class' => 'danger', 'text' => 'Unit tidak ditemukan.'];
                }
            }
            return response()->json($msg);
        }
        else {
            return view('backend.report_unit', $this->data);
        }
    }
}
