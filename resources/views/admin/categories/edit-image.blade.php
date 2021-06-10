@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">@section('content')


    <div class="container">

        <div class="row">


            <div class="col-md-12" >

                <div class="card">
                    <div class="card-header">{{ __('تعديل الصورة') }}</div>
                    <div class="card-body">


                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong  >{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        <form action="{{route('image.update')}}" method="post" class="row" enctype="multipart/form-data"  >

                            @csrf
                   <input type="hidden"  name="id" value="{{$image->id}}" />



                            <div class="form-group col-md-6 ">
                                <label for="tag_name" >اختار صورة</label>
                                <input type="file" class="form-control" name="category_image" id="category_image"  onchange="previewFile(this)"  required  />
                                <img    src={{asset($image->image)}}  id="previewImg" alt="profile image" style="max-width: 130px; margin-top:20px; "    />

                            </div>



                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-primary  " >تعديل الصورة</button>
                            </div>
                        </form>



















</div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function previewFile(){
            var file=$("input[type=file]").get(0).files[0];
            if(file){
                var reader = new  FileReader();
                reader.onload = function (){
                    $('#previewImg').attr("src",reader.result);


                }
                return  reader.readAsDataURL(file);

            }
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
@endsection
