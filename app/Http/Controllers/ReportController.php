<?php

namespace App\Http\Controllers;

use App\Models\Master\Unit;
use App\Models\Setting;
use App\Models\Transaction;
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
                    $utransactions = $unit->transaction->where('transaction_unit', $request->unit_id);
                    if ($utransactions != null){
                        foreach ($utransactions as $transaction) {
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
                $msg = Unit::where('unit_id', $request->unit_id)->first();

            }
            return response()->json($msg);
        }
        else {
            return view('backend.report_unit', $this->data);
        }
    }

    public function transaction(Request $request)
    {
        if ($request->isMethod('post')){
            if ($request->_type == 'data' && $request->_data == 'all'){
                $no = 1;
                $transaction = Transaction::orderBy('transaction_id', 'DESC');
                if ($request->transaction_status != 0) {
                    $transaction->where('transaction_status', $request->transaction_status);
                }
                if ($request->transaction_month != 0){
                    $transaction->whereMonth('transaction_date_in', $request->transaction_month);
                }
                foreach ($transaction->get() as $transcation) {
                    switch ($transcation->transaction_status) {
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
                        $transcation->unit->unit_nopol,
                        $transcation->unit->unit_type,
                        $transcation->garage->garage_name,
                        $transcation->transaction_customer,
                        $transcation->transaction_phone,
                        $status,
                        $transcation->date_in(),
                        $transcation->date_finish(),
                        $transcation->transaction_desc,
                    ];
                }
                $msg = ['data' => empty($data) ? [] : $data];
            }
            return response()->json($msg);
        }
        else {
            return view('backend.report_transaction', $this->data);
        }
    }
}
