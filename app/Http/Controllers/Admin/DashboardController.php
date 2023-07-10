<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Anggota;
use App\Models\Komentar;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = Anggota::select('*')->count();
        $materi = Materi::select('*')->count();
        $komentar = Komentar::select('*')->count();
        $petugas = Petugas::select('*')->count();
        $data = Komentar::all();
        return view('admin.index',compact('anggota','materi','komentar','petugas','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function password()
    {
        $model = new User();
        return view('admin.password',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function passwordstrore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {

            $id = auth()->user()->id;
            $user = User::find($id);
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()
                ->back()
                ->with('message', 'change password success');;
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
