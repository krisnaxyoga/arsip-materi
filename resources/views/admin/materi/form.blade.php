@extends('layouts.admin')
@section('title','materi')
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
                    <form action="@if($model->exists) {{ route('materi.update', $model->id) }} @else {{ route('materi.store') }} @endif" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($model->exists ? 'PUT' : 'POST')
                        <div class="form-group">
                            <label class="small mb-1">Name of category <span class="text-danger">*</span></label>
                            <select name="category_id" id="" class="form-select form-control">
                                <option value="">Select name of category</option>
                                @foreach ($category as $item )
                                    <option value="{{ $item->id }}" {{ old('category_id', $model->category_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="name" type="text" placeholder="Name" value="{{ old('name', $model->name) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">File <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="file" type="file" value="{{ old('file', $model->file) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">description</label>
                       <textarea name="description" value=" {{ old('description', $model->description) }}" class="form-control" id="" cols="30" rows="10">
                        {{ old('description', $model->description) }}
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
