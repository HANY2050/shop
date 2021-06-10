@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="row">


            <div class="col-md-12" >

                <div class="card">
                    <div class="card-header">{{ __('products') }} <a class="btn btn-primary"  href="{{route('new-product')}}" ><i class="fas fa-plus-circle"></i></a> </div>
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



                        <div class="row">

                            @foreach($products as $product)
                                <div class="col-md-4" >
                                    <div class="alert alert-primary" role="alert">

                                        <h5>{{$product->title}}</h5>
                                        <p>category : {{ (is_object($product->category)) ? $product->category->name:''}}</p>
                                        <p>Price :{{$currency_code}} {{$product->price}}</p>

                                     {!! (count( $product->images ) > 0) ?'<img    alt=""   class="img-thumbnail card-img" src="'.($product->images[0]->url )  .'">':''!!}

                                        @if($product->options > 0 ? $product->options:'' )

                                            @foreach($product->jsonOptions() as $key => $values)
                                                 <div class="row">

                                                   <div class="form-group col-md-12 ">
                                                         <label for="{{$key}}" >{{ strtoupper($key)  }}</label>
                                                         <select type="text" class="form-control" name="{{$key}}" id="{{$key}}"  required >

                                                             @foreach($values as  $value)

                                                                 <option   value="{{$value}}" >{{ strtolower($value) }}</option>

                                                             @endforeach
                                                         </select>
                                                     </div>

                                                 </div>

                                            @endforeach

                                        @endif
















                                        <a class="btn btn-success m-2"  href="{{route('update-product-form', ['id'=>$product->id])}}" >Update Product</a>
                                                                             </div>


                                                                         </div>

                                                                     @endforeach

                                                                 </div>
                                                                 {{ $products->links('pagination::bootstrap-4') }}

                                                             </div>

                                                         </div>

                                                     </div>

                                                 </div>

                                             </div>



                                         @endsection

