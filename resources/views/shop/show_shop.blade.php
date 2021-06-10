@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="row"  >


            <div class="col-md-12">

                <div class="card"  style="text-align: right" >
                    <div class="card-header">{{ __('اضافة بيانات المتجر') }} <a class="btn btn-primary"  href="{{route('addShop')}}" ><i class="fas fa-plus-circle"></i></a> </div>
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



                        <div class="row"   >

                            @foreach($shops as $shop)
                                @if($shop->user_id === $user)
                                    <div class="col-md-4"   >
                                        <div class="alert alert-primary" role="alert" style="text-align: right"  >

                                            <h5  >{{$shop->shop_name }}</h5  >
                                            <p>اسم مالك المتجر: {{ $shop->owner_name}}</p>
                                            <p>رقم الهاتف : {{$shop->number_phone}}</p>
                                            <p>العنوان : {{$shop->addresses}}</p>

                                            {!! ( $shop->image_profile ) > 0 ?'<img    alt=""   class="img-thumbnail card-img" src="'.($shop->image_profile )  .'">':''!!}






                                            <a class="btn btn-success m-2"  href="updateShop/{{$shop->id}}" >تعديل البيانات</a>
                                        </div>


                                    </div>
                                @endif

                            @endforeach

                        </div>
                        {{ $shops->links('pagination::bootstrap-4') }}

                    </div>

                </div>

            </div>

        </div>

    </div>



@endsection

