<?php

namespace App\Http\Controllers;

use App\Models\Master\Unit;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['setting'] = new Setting();
    }

    public function index(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->isMethod('post')){
                if ($request->_type == 'data' && $request->_data == 'all'){
                    $no = 1;
                    foreach (Transaction::where('transaction_unit', $request->unit_nopol)->orderBy('transaction_id', 'DESC')->get() as $transaction) {
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
                            $transaction->unit->unit_nopol,
                            $transaction->unit->unit_type,
                            $transaction->garage->garage_name,
                            $transaction->transaction_customer,
                            $transaction->transaction_desc,
                            $transaction->date_in(),
                            $status,
                        ];
                    }
                    $msg = ['data' => empty($data) ? [] : $data];
                }
                elseif ($request->_type == 'data' && $request->_data == 'unit'){
                    $no = 1;
                    foreach (Unit::where('unit_nopol', 'LIKE', '%'.$request->unit_nopol.'%')->get() as $unit) {
                        $data[] = [
                            $no++,
                            $unit->unit_nopol,
                            $unit->unit_merk,
                            $unit->unit_type,
                            $unit->unit_region,
                            '<div class="btn-group">
                            <button class="btn btn-outline-primary bt-sm btn-detail" data-num="'.$unit->unit_id.'"><i class="icon-enter2"></i></button>
                         </div>
                         '
                        ];
                    }
                    $msg = ['data' => empty($data) ? [] : $data];

                }
                return response()->json($msg);
            }
        }
        else {
            return view('fronted.home', $this->data);
        }
    }
}
