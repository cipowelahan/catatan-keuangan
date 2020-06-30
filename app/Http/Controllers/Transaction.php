<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction as ModelData;
use App\Http\Controllers\TransactionService;

class Transaction extends Controller {

    private $service;

    public function __construct() {
        $this->middleware('ajax');
        $this->service = new TransactionService;
    }

    public function index(Request $req) {
        $date = $this->service->getInitFilterDate();

        $date_start = $req->filled('date_start') ? $req->date_start:$date['start'];
        $date_end = $req->filled('date_end') ? $req->date_end:$date['end'];

        $transaction = ModelData::with('category')
        ->when($req->filled('search'), function($q) use ($req) {
            $q  
                ->orWhereHas('category', function($r) use ($req) {
                    $r->where('name', 'like', '%'.$req->search.'%');
                })
                ->orWhere('id', 'like', '%'.$req->search.'%')
                ->orWhere('value', 'like', '%'.$req->search.'%')
                ->orWhere('description', 'like', '%'.$req->search.'%')
                ->orWhere('created_at', 'like', '%'.$req->search.'%')
                ->orWhere('updated_at', 'like', '%'.$req->search.'%');
        })
        ->when($req->filled('type'), function($q) use ($req) {
            $q->where('type', $req->type); 
            if ($req->filled('category_id')) {
                $q->where('category_id', $req->category_id);
            }
        })
        ->when($req->filled('order_column'), function($q) use ($req) {
            $q->orderBy($req->order_column, $req->order);
        })
        ->whereBetween('created_at', [$date_start.' 00:00:00', $date_end.' 23:59:59'])
        ->paginate(10);

        $saldo = $this->service->getSaldoTransaction();
        return view('dashboard.pages.transaction.index', compact('transaction', 'date_start', 'date_end', 'saldo'));
    }

    public function category(Request $req) {
        return $this->service->getCategory($req->type);
    }

    public function create(Request $req) {
        if ($req->isMethod('get')) {
            $saldo = $this->service->getSaldoTransaction();
            return view('dashboard.pages.transaction.create', compact('saldo'));
        }

        $validation = Validator::make($req->all(), ModelData::getRules(), ModelData::getMessages());
        if ($validation->fails()) {
            return response($validation->errors()->first() ,422);
        }
        
        $req->merge(['value' => str_replace(',','',$req->value)]);
        $transaction = ModelData::create($req->except('_token'));
        return response("1");
    }

    public function update(Request $req) {
        $transaction = ModelData::find($req->id);

        if ($req->isMethod('get')) {
            $saldo = $this->service->getSaldoTransaction();
            return view('dashboard.pages.transaction.edit', compact('transaction', 'saldo'));
        }

        $validation = Validator::make($req->all(), ModelData::getRules(), ModelData::getMessages());
        if ($validation->fails()) {
            return response($validation->errors()->first() ,422);
        }

        $req->merge(['value' => str_replace(',','',$req->value)]);
        $transaction->update($req->except('_token'));
        return response("1");
    }

    public function delete(Request $req) {
        $transaction = ModelData::find($req->id);
        $transaction->delete();
        return response()->json([
            'succes' => true,
            'lastUrl' => $req->lastUrl
        ]);
    }

}
