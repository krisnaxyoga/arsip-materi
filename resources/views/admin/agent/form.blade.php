@extends('layouts.admin')
@section('title', 'Agent')
@section('content')
<section>
    <div class="container mt-5">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h1>@if($model->exists) Edit @else Add @endif @yield('title')</h1>
                    </div>
                    <div class="card-body">
                        <form action="@if($model->exists) {{ route('dashboard.agent.update', $model->id) }} @else {{ route('dashboard.agent.store') }} @endif" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($model->exists ? 'PUT' : 'POST')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">First Name</label>
                                        <input type="text" name="firstname" class="form-control" id="firstname" value="{{ $model->first_name }}" placeholder="First Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $model->phone }}"  placeholder="Phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" value="{{ $model->address }}" placeholder="Address">
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="" class="form-label">content</label>
                                        <textarea name="content" id="editor"></textarea>
                                    </div> --}}
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="input2" class="form-label">Last Name</label>
                                        <input type="text" name="lastname" class="form-control" id="lastname" value="{{ $model->last_name }}" placeholder="Last Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ $model->user->email }}" placeholder="email@mail.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">default password</label>
                                        <input type="text" readonly class="form-control" id="input1" value="password123">
                                    </div>
                                </div>
                            </div>
                            <hr>
                                <button class="btn btn-primary">
                                    <i class="fa fa-save"></i> save
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    CKEDITOR.replace('editor');
  </script>
@endsection