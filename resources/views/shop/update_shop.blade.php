
@extends('layouts.app')


@section('content')

    <div class="container">

        <div class="row">


            <div class="col-md-12" >

                <div class="card">


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


                    <div class="card-header" style="text-align: center">
                        <h5>تعديل بيانات المركز التجاري</h5>
                    </div>

                    <div class="card-body">

                       {{-- @foreach($shops as $shop)
                            @if($shop->user_id === $user)--}}



                                <form  action="{{route('DoUpdateShop')}}" method="post"  class="row" enctype="multipart/form-data"  style="text-align: right" >

                                    @csrf

                                    <input type="hidden"  name="id" value="{{$shop->id}}" />









                                    <div class="form-group col-md-12 "  >

                                        <input type="hidden" class="form-control" name="user_id" id="user_id" placeholder=""
                                               value=" {{ Auth::user()->id }}" >
                                    </div>


                                    <div class="form-group col-md-12 " >
                                        <label  for="shop_name"  >اسم المركز التجاري</label>
                                        <input style="text-align: right"  type="text" class="form-control" name="shop_name" id="shop_name" placeholder="اكتب اسم  المركز التجاري"
                                               value="{{(! is_null($shop->shop_name))? $shop->shop_name:''}}" >
                                    </div>

                                    <div class="form-group col-md-12 ">
                                        <label for="owner_name" >اسم مالك المركز التجاري</label>
                                        <input style="text-align: right" type="text" class="form-control" name="owner_name" id="owner_name" placeholder="اكتب اسم مالك المركز التجاري"
                                               value="{{(! is_null($shop->owner_name))? $shop->owner_name:''}}" >
                                    </div>



                                    <div class="form-group col-md-12 ">
                                        <label for="product_total" >اكتب عنوان المركز التجاري</label>
                                        <input  style="text-align: right"  type="text" class="form-control" name="addresses" id="product_total" step="any" placeholder="اكتب عنوان المركز التجاري"
                                                value="{{(! is_null($shop->addresses))? $shop->addresses:''}}" >
                                    </div>


                                    <div class="form-group col-md-12 ">
                                        <label for="number_phone" >رقم الهاتف</label>
                                        <input  style="text-align: right" type="number" class="form-control" name="number_phone" id="number_phone" step="any" placeholder="اكتب رقم الهاتف "
                                                value="{{(! is_null($shop->number_phone))? $shop->number_phone:''}}" >
                                    </div>







                                    <div  class="form-group col-md-12"  style="text-align: center" >
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 mb-4" >
                                                <label for=""   >اضافة صورة شعار المركز التجاري </label>
                                                <div class="card image-card-upload" >
                                                    <a  href="" class="remove-image-upload" ><i class="fas fa-minus-circle"></i></a>
                                                    <a href="#"  class="activate-image-upload" data-fileid="image-" >


                                                            <img id="{{'iimage-'}}" src="{{ asset($shop->image_profile) }}" class="card-img-top" >







                                                        <div class="card-body" style="text-align: center">
                                                            <i class="fas fa-images"></i>
                                                        </div>
                                                    </a>
                                                    <input   name="image_profile"  type="file"  class="form-control-file image-file-upload " id="image-"   >

                                                </div>
                                            </div>

                                        </div>
                                    </div>







                                    <div class="form-group col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary btn-block   " >حفظ</button>



                                    </div>


                                </form>



                            {{--@endif

                        @endforeach--}}











                        {{--<div class="row">

                            @foreach($shops as $shop)
                                <div class="col-md-3" >
                                    <div class="alert alert-primary" role="alert">
                                        {{$shop->shop_name}}
                                        <span>
                                            <form action="{{route('categories')}}" method="post"  >
                                         @csrf

                                       <input type="hidden" name="_method"  value="delete" />
                                                   <input type="hidden" name="category_id"  value="{{$shop->shop_name}}" />
                                                <button type="submit" class="delete-btn" ><i class="fas fa-trash-alt"></i></button>

                                            </form>

                                        </span>

                                        <span> <a class="edit-All" data-categoryname="{{$shop->image_numberCart}}"

                                                  data-categorygid="{{$shop->image_profile}}"
                                            > <i class="fas fa-edit"></i> </a>  </span>





                                        <p>{{$shop->owner_name}}</p>


                                    </div>


                                </div>

                            @endforeach

                        </div>--}}














                    </div>
                </div>
            </div>
        </div>
    </div>




    {{--  <div class="modal  options-Window " tabindex="-1"  id="options-Window" >
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Option </h5>
                      <span> <a  href=""  class="edit-close"  >  <i class="fas fa-window-close"></i> </a>  </span>
                  </div>
                  <div class="modal-body  row "  >



                      <div class="form-group col-md-6 ">
                          <label for="option_name" >Option Name</label>
                          <input type="text" class="form-control" name="option_name" id="option_name" placeholder="Option Name " required >
                      </div>

                      <div class="form-group col-md-6 ">
                          <label for="option_value" >Option Value</label>
                          <input type="text" class="form-control" name="option_value" id="option_value" placeholder=" Option value " required >
                      </div>




                      <div class="form-group col-md-12">
                          <button type="submit" class="btn btn-primary    add-option-button " >Add Option </button>



                      </div>



                  </div>

              </div>
          </div>
      </div>--}}










    <script>
        $(document).ready(function (){

            var optionNamesList = [];
            var $optionWindow = $('#options-Window');
            var $addOptionBtn =$('.add-option-btn');
            var $optionsTable =$('#options-table');
            var   optionsNamesRow ='';
            var $activateImageUpload =$('.activate-image-upload');
            /*   var $activateImageUpload2 =$('. activate-image-upload2');*/


            $addOptionBtn.on('click', function (e){

                e.preventDefault();
                $optionWindow.modal('show');

            });



            $(document).on('click','.remove-option' , function (e){

                e.preventDefault();
                $(this).parent().parent().remove();


            });
            $(document).on('click','.add-option-button' , function (e){

                e.preventDefault();
                var $optionName = $('#option_name').val();

                if($optionName === ''){
                    alert('option name no think');
                    return false;
                }

                var $optionValue = $('#option_value').val();

                if($optionValue === ''){
                    alert('option value no think');
                    return false;
                }
                if( ! optionNamesList.includes($optionName)){

                    optionNamesList.push($optionName);
                    optionsNamesRow = '<td><input type="hidden" name="options[]" value="'+$optionName+'" ></td>'


                }


                var optionRow = `

<tr>

<td>

`+ $optionName +`
</td>


<td>

`+ $optionValue +`
</td>

<td>

<a href="" class="remove-option" ><i class="fas fa-minus-circle"></i></a>

<input  type="hidden"  name=" `+ $optionName +`[]" value="  `+ $optionValue +`" >

</td>

</tr>

`;

                $optionsTable.append(

                    optionRow
                );

                $optionsTable.append(

                    optionsNamesRow
                );

                $('#option_value').val('');

            });

            function readURL(input , imageID){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function (e){

                        $('#'+imageID).attr('src',e.target.result);

                    }

                    reader.readAsDataURL(input.files[0]);



                }

            }


            function resetFileUpload(fileUploadID ,imageID , $eI , $eD  ){

                $('#'+imageID).attr('src','');

                $eI.fadeIn();
                $eD.fadeOut();
                $('#'+fileUploadID).val('');

            }


            $activateImageUpload.on('click', function (e){

                e.preventDefault();

                var fileUploadID = $(this).data('fileid');
                var me = $(this);
                $('#'+fileUploadID).trigger('click');

                var imagetage = ' <img id="i'+fileUploadID+'" src="" class="card-img-top" >';


                $(this).append(imagetage);
                $('#'+fileUploadID).on('change',function (e){

                    readURL(this , 'i'+fileUploadID);
                    me.find('i').fadeOut();
                    var $removeThisImage =  me.parent().find('.remove-image-upload');

                    $removeThisImage.fadeIn();
                    $removeThisImage.on('click', function (e){

                        e.preventDefault();
                        resetFileUpload(fileUploadID , 'i'+fileUploadID ,  me.find('i') ,$removeThisImage);

                    });


                });

            });






















        });





    </script>


@endsection
