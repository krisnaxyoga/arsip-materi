@extends('layouts.admin')
@section('title', 'Anggota data')
@section('content')
<section>
    <div class="container">
        <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>phone</th>

                                        <th>email</th>
                                        <th>birthday</th>

                                        <th>address</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->birtday }}</td>
                                        <td>{{ $item->alamat }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       
            </div>
        </div>
    </div>
</section>
<script>
    window.print()
</script>
@endsection
