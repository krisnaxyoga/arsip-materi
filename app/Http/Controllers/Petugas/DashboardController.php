<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Komentar;
use App\Models\Materi;
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
        $id = auth()->user()->id;
        $anggota = Anggota::select('*')->count();
        $koment = Komentar::where('user_id',$id)->count();
        
        $materi = Materi::select('*')->count();

        return view('petugas.index',compact('koment','materi','anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function password()
    {
        $model = new User();
        return view('petugas.password',compact('model'));
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
