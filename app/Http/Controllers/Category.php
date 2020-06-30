<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category as ModelData;

class Category extends Controller {

    public function __construct() {
        $this->middleware('ajax');
    }

    public function index(Request $req) {
        $category = ModelData::when($req->filled('search'), function($q) use ($req) {
            $q
                ->orWhere('id', 'like', '%'.$req->search.'%')
                ->orWhere('name', 'like', '%'.$req->search.'%')
                ->orWhere('description', 'like', '%'.$req->search.'%')
                ->orWhere('created_at', 'like', '%'.$req->search.'%')
                ->orWhere('updated_at', 'like', '%'.$req->search.'%');
        })
        ->when($req->filled('type'), function($q) use ($req) {
            $q->where('type', $req->type);
        })
        ->when($req->filled('order_column'), function($q) use ($req) {
            $q->orderBy($req->order_column, $req->order);
        })
        ->paginate(10);
        return view('dashboard.pages.category.index', compact('category'));
    }

    public function create(Request $req) {
        if ($req->isMethod('get')) {
            return view('dashboard.pages.category.create');
        }

        $validation = Validator::make($req->all(), ModelData::getRules(), ModelData::getMessages());
        if ($validation->fails()) {
            return response($validation->errors()->first() ,422);
        }
        
        $category = ModelData::create($req->except('_token'));
        return response("1");
    }

    public function update(Request $req) {
        $category = ModelData::find($req->id);

        if ($req->isMethod('get')) {
            return view('dashboard.pages.category.edit', compact('category'));
        }

        $validation = Validator::make($req->all(), ModelData::getRules(), ModelData::getMessages());
        if ($validation->fails()) {
            return response($validation->errors()->first() ,422);
        }

        $category->update($req->except('_token'));
        return response("1");
    }

    public function delete(Request $req) {
        $category = ModelData::find($req->id);
        $category->delete();
        return response()->json([
            'succes' => true,
            'lastUrl' => $req->lastUrl
        ]);
    }

}
