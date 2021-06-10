
@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="row">


            <div class="col-md-12" >

                <div class="card">
                    <div class="card-header">{{ __('Reviews') }}</div>
                    <div class="card-body">
                        <div class="row">

                            @foreach($reviews as $review)
                                <div class="col-md-3" >
                                    <div class="alert alert-primary" role="alert">

                                        <h5>{{$review->customer->formattedName()}}</h5>
                                        <p>product : {{$review->product->title}}</p>
                                        <p>stars :

                                            @php

                                            $total =5;
                                             $currentStars = $review->stars;
                                              $remainingStars = $total - $currentStars;

                                            @endphp
                                            @for($i = 0 ; $i < $review->stars ; $i++ )
                                                <i class="fas fa-star"></i>
                                            @endfor

                                            @for($i = 0 ; $i < $remainingStars ; $i++ )
                                                <i class="far fa-star"></i>
                                            @endfor

                                        </p>




                                        <p>review : {{$review->review}}</p>
                                        <p>Date : {{$review->date_in_View()}}</p>




                                    </div>


                                </div>

                            @endforeach

                        </div>
                        {{ $reviews->links('pagination::bootstrap-4') }}

                    </div>

                </div>

            </div>

        </div>

    </div>



@endsection


