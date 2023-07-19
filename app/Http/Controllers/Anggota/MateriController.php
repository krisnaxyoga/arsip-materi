<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;

use App\Models\Category;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->data;
        
        if ($category) {
            $data = Materi::where('category_id', $category['category'])->get();
            // return ($category);
        } else {
            $data = Materi::all();
        }

        $category = Category::all();
        
        return view('anggota.materi.index',compact('data','category'));
    }
}
