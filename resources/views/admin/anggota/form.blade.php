@extends('layouts.admin')
@section('title','Anggota')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">@if($model->exists) Edit @else Tambah @endif  @yield('title')</div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert with-close alert-danger mb-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <form action="@if($model->exists) {{ route('anggota.update', $model->id) }} @else {{ route('anggota.store') }} @endif" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($model->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label class="small mb-1">Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="name" type="text" placeholder="Name" value="{{ old('name', $model->name) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Birthday <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="birtday" type="date" placeholder="birtday" value="{{ old('birtday', $model->birtday) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Phone <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="phone" type="text" placeholder="phone" value="{{ old('phone', $model->phone) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Email <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="email" type="email" placeholder="email" value="{{ old('email', $model->email) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Password <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="password" type="text" placeholder="password123" disabled />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Alamat</label>
                       <textarea name="alamat" value=" {{ old('alamat', $model->alamat) }}" class="form-control">
                        {{ old('alamat', $model->alamat) }}
                       </textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right" type="submit"><i class="far fa-save mr-1"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
