@extends('layouts.admin')
@section('title', 'Agent Data')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>@yield('title')</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{route('dashboard.agent.create')}}" class="btn btn-primary mb-2">add</a>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>first name</th>
                                        <th>last name</th>
                                        <th>phone</th>
                                        <th>address</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td><a href="{{route('dashboard.agent.edit',$item->id)}}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></a>
                                        
                                            <form class="d-inline" action="" method="POST" onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                                @csrf
                                                @method('delete')
    
                                                <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </form>
                                        </td>
                                       
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