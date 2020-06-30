<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TransactionService;

class Home extends Controller {

    private $transactionService;

    public function __construct() {
        $this->middleware('ajax')->only([
            'main', 'error'
        ]);

        $this->transactionService = new TransactionService;
    }

    public function index() {
        return view('dashboard.pages.dashboard');
    }

    public function error(Request $req) {
        return view('dashboard.pages.error', [
            'title' => $req->title,
            'messages' => $req->messages
        ]);
    }

    public function main() {
        $saldo = number_format($this->transactionService->getSaldoTransaction());
        $money_in = number_format($this->transactionService->getSumInTransaction());
        $money_out = number_format($this->transactionService->getSumOutTransaction());
        return view('dashboard.pages.main', compact('saldo', 'money_in', 'money_out'));
    }
}
