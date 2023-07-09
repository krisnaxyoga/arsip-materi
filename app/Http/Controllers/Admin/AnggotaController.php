<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Anggota::all();

        return view('admin.anggota.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Anggota();

        return view('admin.anggota.form',compact('model'));
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


            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('password123');
            $user->role_id = 3;
            $user->save();

            $data = new Anggota();
            $data->user_id = $user->id;
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->alamat = $request->alamat;
            $data->birtday = $request->birtday;
            $data->save();

            return redirect()
                ->route('anggota.index')
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
        //
        $model = Anggota::find($id);

        return view('admin.anggota.form',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            $data = Anggota::find($id);
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->alamat = $request->alamat;
            $data->birtday = $request->birtday;
            $data->save();

            $user = User::find($data->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()
                ->route('anggota.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Anggota::find($id);
        $model->delete();

        $user = User::find($model->user_id);
        $user->delete();

        return redirect()->back()->with('message', 'data berhasil dihapus');
    }
}
