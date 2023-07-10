@extends('layouts.admin')
@section('title', 'Anggota data print')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h2>@yield('title')</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{route('cetakpdf.cetak')}}" method="get">
                            <div class="d-flex">
                                <div class="mb-3 mx-1">
                                    <input type="date" name="start" class="form-control">
                                </div>
                                <div class="mb-3 mx-1">
                                    <input type="date" name="end" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-file-pdf"></i> print</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
