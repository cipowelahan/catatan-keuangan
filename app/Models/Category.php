<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    
    protected $table = 'categories';
    protected $guarded = [];

    public static function getRules() {
        return [
            'type' => 'required|in:Pemasukan,Pengeluaran',
            'name' => 'required'
        ];
    }

    public static function getMessages() {
        return [
            'type.required' => 'Tipe Kategori Dibutuhkan',
            'type.in' => 'Tipe Kategori yang diperbolekan adalah Pemasukan dan Pengeluaran',
            'name.required' => 'Nama Kategori Dibutuhkan',
        ];
    }

    public function transaction() {
        return $this->hasMany('App\Models\Transaction', 'category_id');
    }
}
