@extends('layouts.anggota')
@section('title', 'Materi Data')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h2>@yield('title')</h2>
                            <div class="mb-3">
                                <form action="">
                                    <select name="category" id="category" class="category form-control-sm">
                                        <option value="">-select category-</option>
                                        <option value="0">all</option>
                                        @foreach ($category as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <span id="load"></span>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>category</th>
                                        <th>description</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <a href="{{ $item->file }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="download"></i></a>
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
<script>
    $('.category').change(function() {
        var nilaiInput = $(this).val();
       console.log(nilaiInput,">>>>>>nilai select");

        // Tampilkan loading
        $('#load').append('<div id="loading" class="d-flex"><div class="loader mx-2"></div><p>Loading...</p></div>');

        if(nilaiInput == 0){
            window.location.reload();
        }else{
            $.ajax({
            url: "{{route('dashboard.anggota.materi')}}",
            method: 'GET',
            data: { data:{category:nilaiInput} },
            success: function(response) {
                $('#loading').remove();
                $('body').html(response);
            },
            error: function(error) {
                $('#loading').remove();
                console.log('Terjadi kesalahan saat menyimpan data keranjang.');
                console.log(error);
            }
            });
        }
    });
</script>
<style>
    .loader {
      border: 5px solid #8bc1f3;
      border-radius: 50%;
      border-top: 5px solid #f78787;
      width: 20px;
      height: 20px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }
    
    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    </style>
@endsection
