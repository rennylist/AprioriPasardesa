<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\TransactionImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
    	$transaction = Transaction::with(['transactiondetail'])->paginate(5);
        return view('transaction',['transaction'=>$transaction]);
    }

    public function import(Request $request)
    {
    	if (! $request->file('transaction')) {
            echo 'Data Transaksi Harus Diisi';
            die();
        }

        Excel::import(new TransactionImport, $request->file('transaction'));

        return redirect('/transaction');
    }

}
