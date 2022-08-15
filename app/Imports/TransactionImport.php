<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use RennyPasardesa\Apriori\Models\AssociationRule;
use RennyPasardesa\Apriori\Tools\AprioriAlgorithm;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionImport implements ToCollection, WithHeadingRow
{
    public function headingRow(): int
    {
        return 1;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        set_time_limit(0);
        AssociationRule::whereRaw('1 = 1')->delete();
        TransactionDetail::whereRaw('1 = 1')->delete();
        Transaction::whereRaw('1 = 1')->delete();
        $transactions = collect();
        foreach ($collection as $row) {
            $current_transaction = $transactions
                ->where('code_transaction', $row['code_transaction'])
                ->first();

            if (! $current_transaction) {
                $current_transaction = Transaction::create([
                    'code_transaction' => $row['code_transaction']
                ]);

                $transactions->push($current_transaction);
            }

            $transaction_detail = TransactionDetail::create([
                    'transaction_id' => $current_transaction->id,
                    'product_id' => $row['product_id'],
                    'product_name' => $row['product_name'],
            ]);
        }
    }
}
