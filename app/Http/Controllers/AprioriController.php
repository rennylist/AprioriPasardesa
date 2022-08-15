<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RennyPasardesa\Apriori\Models\AssociationRule;
use RennyPasardesa\Apriori\Tools\AprioriAlgorithm;
use App\Models\Transaction;
use App\Models\TransactionDetail;

 

class AprioriController extends Controller
{
    public function index()
    {
        $apriori = AssociationRule::paginate(10);
        
        foreach ($apriori as $a) {
        	$recommendation = TransactionDetail::where('product_id',$a->recommendation)->first();
        	$a->recommendation_name = $recommendation->product_name;

        	$products = TransactionDetail::whereIn('product_id', $a->products)->get();
        	$a->products_name = $products->pluck('product_name', 'product_name')->join(', ');
        }

        return view('apriori',['apriori'=>$apriori]);
    }

    public function ProcessApriori(Request $request)
    {
    	set_time_limit(0);
    	$transaction = Transaction::with(['transactiondetail'])->get();
    	$transactionArray = [];

    	foreach ($transaction as $t ) {
    		$transactionArray[$t->id] = $t->transactiondetail->pluck('product_id')->all();
    	}

    	$aprioriAlgorithm = new AprioriAlgorithm($transactionArray);
    	$aprioriAlgorithm->process();

    	return redirect('/apriori');
    }
}
