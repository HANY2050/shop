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







                    <div class="card-header">

                        {!! !is_null($product)? 'Update Product <span  class="product-title-header" >'.$product->title. '</span>'  :'New Product' !!}

                    </div>

                    <div class="card-body">



                        <form  action="{{ (!is_null($product)) ? route('update-product') : route('new-product') }}" method="post"  class="row" enctype="multipart/form-data">

                            @csrf
                            @if(! is_null($product))

                                <input type="hidden" name="_method"  value="put" />
                                <input type="hidden" name="product_id" value="{{$product->id}}" >

                            @else
                            @endif




  <div class="form-group col-md-12 ">

                            <input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="User Id " required>
                    </div>


                            <div class="form-group col-md-12 ">

                                <input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="Product Name " required
                                       value="{{(! is_null(Auth::user()->id))? Auth::user()->id:''}}" >
                            </div>

                            <div class="form-group col-md-12 ">
                                <label for="product_title" >Product Name</label>
                                <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Product Name " required
                                       value="{{(! is_null($product))? $product->title:''}}" >
                            </div>


                            <div class="form-group col-md-12 ">
                                <label for="product_description" >Product Description</label>
                                <textarea  placeholder="Product Description "    required class="form-control" name="product_description" id="product_description" cols="30" rows="10"  >
                                   {{(! is_null($product))? $product->description:''}}

                               </textarea  >
                            </div>



                            <div class="form-group col-md-12 ">
                                <label for="product_unit" >Categories</label>
                                <select class="form-control" name="product_category" id="product_category"  required>

                                    <option>SELECT a Categories</option>

                                    @foreach($categories as $category)


                                        <option value="{{$category->id}}"

                                            {{(! is_null($product) && ($product->category->id ===$category->id)) ?'selected':''}}

                                        >{{$category->name}}</option>

                                    @endforeach

                                </select>

                            </div>












                            <div class="form-group col-md-12 ">
                                <label for="product_unit" >Product Unit</label>
                                <select class="form-control" name="product_unit" id="product_unit"  required>

                                    <option>SELECT a Unites</option>

                                    @foreach($unit as $units)


                                        <option value="{{$units->id}}"

                                            {{(! is_null($product) && ($product->hasUnit->id ===$units->id)) ?'selected':''}}

                                        >{{$units->formatted ()}}</option>



                                    @endforeach



                                </select>

                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="product_price" >Product Price</label>
                                <input type="number" class="form-control" name="product_price" id="product_price" step="any"  placeholder="Product Price " required
                                       value="{{(! is_null($product))? $product->price:''}}" >
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="product_price" >Product Discount</label>
                                <input type="number" class="form-control" name="product_discount" id="product_discount" step="any" placeholder="Product Discount " required
                                       value="{{(! is_null($product))? $product->discount:0}}" >
                            </div>

                            <div class="form-group col-md-12 ">
                                <label for="product_total" >Product Total</label>
                                <input type="number" class="form-control" name="product_total" id="product_total" step="any" placeholder="Product Total " required
                                       value="{{(! is_null($product))? $product->total:''}}" >
                            </div>



                            <div class="form-group col-md-12 ">

                                <a class="btn btn-outline-dark add-option-btn"  href="#" >Add Option</a>
                                <table id="options-table"  class="table  table-striped" >
                                    @if(! is_null($product))

                                        @if(! is_null($product->jsonOptions()))

                                            @foreach($product->jsonOptions() as $option_Name => $options )


                                                @foreach( $options as $option  )

                                                    <tr >

                                                        <td  >

                                                            {{$option_Name}}
                                                        </td>


                                                        <td   >

                                                            {{$option}}
                                                        </td>

                                                        <td>

                                                            <a href="" class="remove-option" ><i class="fas fa-minus-circle"></i></a>

                                                            <input  type="hidden"  name=" {{$option_Name}}[]" value="  {{$option}}" >

                                                        </td>

                                                    </tr>




                                                @endforeach
                                                <td><input type="hidden" name="options[]" value="{{$option_Name}}" ></td>
                                            @endforeach

                                        @endif


                                    @endif
                                </table>
                            </div>



                            <div  class="form-group col-md-12" >
                                <div class="row">
                                    @for($i = 0 ; $i < 1 ; $i++)

                                        <div class="col-md-4 col-sm-12 mb-4" >

                                            <div class="card image-card-upload" >
                                                <a  href="" class="remove-image-upload" ><i class="fas fa-minus-circle"></i></a>
                                                <a href="#"  class="activate-image-upload" data-fileid="image-{{ $i }}" >


                                                    @if( !is_null($product)  && ! is_null($product->images) && count($product->images)>0)
                                                        @if( isset($product->images[$i]) && ! is_null($product->images[$i] &&  !empty($product->images[$i])))
                                                            <img id="{{'iimage-'.$i}}" src="{{ asset($product->images[$i]->url) }}" class="card-img-top" >

                                                        @endif


                                                    @endif



                                                    <div class="card-body" style="text-align: center">



                                                                <i class="fas fa-images"></i>




                                                    </div>
                                                </a>
                                                <input   name="product_images[]"  type="file"  class="form-control-file image-file-upload " id="image-{{ $i }}"  >


                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>



                            <div class="form-group col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block   " >Save</button>



                            </div>


                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal  options-Window " tabindex="-1"  id="options-Window" >
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
    </div>











    <script>
        $(document).ready(function (){

            var optionNamesList = [];
            var $optionWindow = $('#options-Window');
            var $addOptionBtn =$('.add-option-btn');
            var $optionsTable =$('#options-table');
            var   optionsNamesRow ='';
            var $activateImageUpload =$('.activate-image-upload');
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
