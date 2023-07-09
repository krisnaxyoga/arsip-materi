@extends('layouts.admin')
@section('title', 'Hotel')
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
                        <form action="@if($model->exists) {{ route('dashboard.hotel.update', $model->id) }} @else {{ route('dashboard.hotel.store') }} @endif" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($model->exists ? 'PUT' : 'POST')
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">First Name</label>
                                        <input type="text" name="firstname" class="form-control" id="input1" placeholder="First Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="input1" placeholder="Phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="input1" placeholder="Address">
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="" class="form-label">content</label>
                                        <textarea name="content" id="editor"></textarea>
                                    </div> --}}
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="input2" class="form-label">Last Name</label>
                                        <input type="text" name="lastname" class="form-control" id="input2" placeholder="Last Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="input1" placeholder="email@mail.com">
                                    </div>
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">default password</label>
                                        <input type="text" readonly class="form-control" id="input1" value="password123">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="input2" class="form-label">Name Hotel</label>
                                        <input type="text" name="hotelname" class="form-control" id="input2" placeholder="Buissines Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="input1" class="form-label">video</label>
                                        <input type="text" name="vidio" class="form-control" id="input1" value="">
                                    </div>
                                    <div class="mb-3">
                                        <div style="width:20rem; overflow:auto">
                                            <div class="d-flex" id="inputContainer">
                                            
                                            </div>
                                        </div>
                                      
                                        <label for="gambar">Gallery:</label>
                                        <input type="file" id="gambar" name="gambar[]" multiple>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">content</label>
                                        <textarea name="content" id="editor"></textarea>
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
  <script>
        var inputContainer = document.getElementById('inputContainer');
        var inputElement = document.getElementById('gambar');
        var fileList = inputElement.files;
        inputElement.addEventListener('change', function() {
            var files = Array.from(inputElement.files);
            
        
            files.forEach(function(file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var imageContainer = document.createElement('div');
                    imageContainer.className = 'image-container';
                    
                    var image = document.createElement('img');
                    image.src = event.target.result;
                    image.style.width = '100px';
                    image.style.height = 'auto';
                    image.className = 'mx-2';

                    console.log(inputElement.files,"value image");

                    var removeButton = document.createElement('button');
                    removeButton.innerHTML = '<i class="fa fa-trash"></i>';
                    removeButton.className = 'btn btn-danger';
                    
                    removeButton.addEventListener('click', function() {
                        imageContainer.remove();
                        hapusData(0);
                    });
                    
                    imageContainer.appendChild(image);
                    imageContainer.appendChild(removeButton);
                    
                    inputContainer.appendChild(imageContainer);
                };
                
                reader.readAsDataURL(file);
            });
        });
        function hapusData(index) {
            var files = Array.from(inputElement.files);
            files.splice(index, 1);

            // Membuat kembali FileList dari array yang dimodifikasi
            var newFileList = new DataTransfer();
            files.forEach(function(file) {
                newFileList.items.add(file);
            });

            // Mengganti value files pada elemen input
            inputElement.files = newFileList.files;
        }
    </script>
@endsection