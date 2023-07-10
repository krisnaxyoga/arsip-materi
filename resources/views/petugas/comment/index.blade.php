@extends('layouts.petugas')
@section('title', 'jamaat tanya')
@section('content')
<section>
    <div class="container">
        <div class="row">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>@yield('title')</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('commentpetugas.create') }}" class="btn btn-primary mb-2">add</a>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>comment</th>
                                        <th>time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>
                                           <p class="@if($item->user->id == Auth::user()->id) text-primary @else text-dark @endif">{{ $item->user->name }}</p> 
                                           <p class="@if($item->user->role_id == 2) text-secondary @else text-success @endif" style="font-size: 12px">{{ $item->user->role->role_name }}</p> 
                                        </td>
                                        <td><p class="@if($item->user->id == Auth::user()->id) text-primary @else text-dark @endif">{{ $item->comment }}</p></td>
                                    
                                        <td><p class="@if($item->user->id == Auth::user()->id) text-primary @else text-dark @endif">{{ $item->created_at }}</p></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
