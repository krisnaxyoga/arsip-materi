<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Category;
use App\Models\Petugas;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Validator;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return view('petugas.materi.index',compact('data','category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Materi;
        $category = Category::all();
        return view('petugas.materi.form',compact('model','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files'), $filename);

                // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
            }
            $iduser = auth()->user()->id;
            $file = "/files/" . $filename;

            $data = new Materi();
            $data->name = $request->name;

            $data->category_id = $request->category_id;
            $data->user_id = $iduser;
            $data->description = $request->description;
            $data->file = $file;
            $data->save();

            return redirect()
                ->route('arsipmateri.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Materi::find($id);

        $category = Category::all();
        return view('petugas.materi.form',compact('model','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $post = Materi::findorfail($id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if ($request->file('file') != null) {
                if ($request->hasFile('file')) {
                    $file = $request->file('file');

                    if (File::exists(public_path($post->file))) {
                        File::delete(public_path($post->file));
                    }
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('files'), $filename);

                    // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
                }
                $file = "/files/" . $filename;
            } else {
                $file = $post->file;
            }

            $data = Materi::find($id);
            $data->name = $request->name;
            $data->category_id = $request->category_id;
            $data->description = $request->description;
            $data->file = $file;
            $data->save();

            return redirect()
                ->route('arsipmateri.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Materi::find($id);
        if (File::exists(public_path($data->file))) {
            File::delete(public_path($data->file));
        }
        $data->delete();
        return redirect()->back()->with('message', 'materi berhasil dihapus');

    }
}
