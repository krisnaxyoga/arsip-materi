<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Sertifikat;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SertifikatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Anggota::all();

        return view('petugas.sertifikat.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

            $data = new Sertifikat();
            $data->name = $request->name;

            $data->anggota_id = $request->anggota_id;
            $data->user_id = $iduser;
            $data->description = $request->description;
            $data->file = $file;
            $data->save();

            return redirect()
                ->route('sertifikatbypetugas.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Sertifikat::find($id);
        $data = Anggota::where('id',$model->anggota_id)->first();
        $sertif = Sertifikat::where('anggota_id',$data->id)->get();

        return view('petugas.sertifikat.form',compact('data','sertif','model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Anggota::find($id);
        $sertif = Sertifikat::where('anggota_id',$id)->get();
        $model = new Sertifikat();

        return view('petugas.sertifikat.form',compact('data','sertif','model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $post = Sertifikat::findorfail($id);
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
            $iduser = auth()->user()->id;

            $data = Sertifikat::find($id);
            $data->name = $request->name;
            $data->user_id = $iduser;
            $data->description = $request->description;
            $data->file = $file;
            $data->save();

            return redirect()->back()->with('message', 'data berhasil di edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Anggota::find($id);
        if (File::exists(public_path($data->file))) {
            File::delete(public_path($data->file));
        }
        $data->delete();
        return redirect()->back()->with('message', 'data berhasil dihapus');
    }
}
