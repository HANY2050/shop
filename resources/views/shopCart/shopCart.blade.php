@extends('layouts.app')
@section('content')


    <div class="container">

        <div class="row">


            <div class="col-md-12" >

                <div class="card">
                    <div  style="text-align: right" class="card-header">{{ __('صور مطلوبة رخصة المتجر , صورة داحلية للمتجر   ,صورة البطاقة الشخصية  ') }}</div>
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

                        <form action="AddCartShop" method="post" class="row" enctype="multipart/form-data"  >

                            @csrf

                            <div class="form-group col-md-12 ">

                                <input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="Product Name " required
                                       value="{{(! is_null(Auth::user()->id))? Auth::user()->id:''}}" >
                            </div>



                            <div class="form-group col-md-6 "  style="text-align: right">
                                <label for="photo_car" >اضف صورة رخصة المتجر , وصورة  داخلية للمتجر , وصورة من البطاقة الشخصية</label>
                                <input type="file" class="form-control" name="photo_car" id="photo_car"  onchange="previewFile(this)"   required />
                                <img  id="previewImg" alt="profile image" style="max-width: 130px; margin-top:20px; " />
                            </div>



                            <div class="form-group col-md-12"   >
                                <button   type="submit" class="btn btn-primary btn2 " >حفظ الصورة</button>
                            </div>
                        </form>











                        <div class="row">

                            @foreach($ShopCart as $ShopCarts)
                                @if($ShopCarts->user_id === $user);
                                <div class="col-md-3" >
                                    <div class="alert alert-primary" role="alert">

                                        <span>
                                            <form action="{{route('delete-Cart')}}" method="post"  >
                                         @csrf

                                       <input type="hidden" name="_method"  value="delete" />
                                                   <input type="hidden" name="id"  value="{{$ShopCarts->id}}" />
                                                <button type="submit" class="delete-btn" ><i class="fas fa-trash-alt"></i></button>

                                            </form>

                                        </span>


                                        <th>

                                            <a href="edit-Cart/{{$ShopCarts->id}}" class="btn btn-info"><i class="fas fa-images"></i></a>

                                        </th>

                                        <img    alt=""   class="img-thumbnail card-img" src={{$ShopCarts->photo_car}}>

                                        <p>{{--{{$category->name}}--}}</p>


                                    </div>


                                </div>
                                @endif
                            @endforeach

                        </div>
                        {{--{{ (!is_null($showLinks)&&$showLinks)  ? $categories->links('pagination::bootstrap-4'):'' }}--}}
                        {{--<form action="--}}{{--{{route('search-categories')}}--}}{{--"  method="get"  >
                            @csrf
                            <div class="row" >
                                <div class="form-group col-md-6 ">
                                    <input type="text" class="form-control" name="category_search" id="category_search" placeholder="Tag Search " required >
                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary" >بحث</button>
                                </div>
                            </div>
                        </form>--}}

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="modal" tabindex="-1"  id="edit" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل البيانات</h5>
                    <span> <a  href=""  class="edit-close"  >  <i class="fas fa-window-close"></i> </a>  </span>
                </div>
                <div class="modal-body">
                    <form action="{{route('categories')}}" method="post" class="row"  enctype="multipart/form-data" >

                        @csrf

                        <div class="form-group col-md-6 ">
                            <label for="category_name" >Category Name</label>
                            <input type="text" class="form-control " name="category_name" id="edit_category_name" placeholder="Category Name " required >
                        </div>








                        <input type="hidden" class="form-control" name="category_id" id="edit_category_id"  required >
                        <input type="hidden" name="_method"  value="put" />
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn2 " >تحديث البيانات </button>
                        </div>

                    </form>


                </div>

            </div>
        </div>
    </div>
    <script>

        function myFunction(){
            var fileName=$("input[type=file]").get(0).files[0];
            if(fileName){
                var reader = new  FileReader();
                reader.onload = function (){
                    $('#EditPreviewImg').attr("src",reader.result);


                }
                reader.readAsDataURL(fileName);

            }
        }

    </script>

    <script type="text/javascript">
        $('.delete-btn').click(function(e) {
            if(!confirm('Are you sure you want to delete this?')) {
                e.preventDefault();
            }
        });
    </script>

    <script>
        $(document).ready(function (){
            var $Edit = $('.edit-All');
            var $Window = $('#edit');
            var $edit_category_name =$('#edit_category_name');
            //var $edit_category_image =$('#edit_category_image');
            var $edit_category_id =$('#edit_category_id');
            $Edit.on('click', function (element) {
                element.preventDefault();
                var categoryName = $(this).data('categoryname');
                // var categoryImage = $(this).data('categoryimage');

                var categoryId = $(this).data('categorygid');
                $Window.modal('show');

                $edit_category_name.val(categoryName);
                //  $edit_category_image.val(categoryImage);

                $edit_category_id.val(categoryId);

            });


        });




    </script>



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
