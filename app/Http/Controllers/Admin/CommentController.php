<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Komentar;

class CommentController extends Controller
{
    public function index()
    {
        $data = Komentar::all();
        return view('admin.comment.index',compact('data'));
    }
    public function delete($id)
    {
        $data = Komentar::find($id);
        $data->delete();

        return redirect()->back()->with('message', 'data berhasil dihapus');
    }
}
