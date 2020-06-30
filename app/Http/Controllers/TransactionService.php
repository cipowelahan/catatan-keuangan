<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionService {

    public function getCategory($type = null) {
        $category = Category::when($type, function($q) use ($type) {
            $q->where('type', $type);
        })->get();
        return $category;
    }

    public function getInitFilterDate() {
        $carbon = Carbon::now();
        $month = str_pad($carbon->month, 2, '0', STR_PAD_LEFT);

        $start = $carbon->year.'-'.$month.'-01';
        $end = $carbon->year.'-'.$month.'-'.str_pad($carbon->daysInMonth, 2, '0', STR_PAD_LEFT);

        return [
            'start' => $start,
            'end' => $end
        ];
    }

    private function sumOutTransaction() {
        return Transaction::where('type', 'Pengeluaran')->sum('value');
    }

    private function sumInTransaction() {
        return Transaction::where('type', 'Pemasukan')->sum('value');
    }

    public function getSumOutTransaction() {
        return $this->sumOutTransaction();
    }

    public function getSumInTransaction() {
        return $this->sumInTransaction();
    }

    public function getSaldoTransaction() {
        return $this->sumInTransaction() - $this->sumoutTransaction();;
    }
}
