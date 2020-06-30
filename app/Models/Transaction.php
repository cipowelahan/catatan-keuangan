<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    protected $table = 'transactions';
    protected $guarded = [];

    public static function getRules() {
        return [
            'type' => 'required|in:Pemasukan,Pengeluaran',
            'category_id' => 'required',
            'value' => 'required',
            'description' => 'required',
        ];
    }

    public static function getMessages() {
        return [
            'type.required' => 'Tipe Transaksi Dibutuhkan',
            'type.in' => 'Tipe Transaksi yang diperbolekan adalah Pemasukan dan Pengeluaran',
            'category_id.required' => 'Kategori Dibutuhkan',
            'value.required' => 'Nominal Dibutuhkan',
            'description.required' => 'Deskripsi Dibutuhkan',
        ];
    }

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
