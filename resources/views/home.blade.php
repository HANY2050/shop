@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}

                        </div>
                    @endif
                        <h4>{{  Auth::user()->first_name }}</h4><br>
                        <h4>{{  Auth::user()->id }}</h4><br>
                        <h4>{{  Auth::user()-> mobile }}</h4><br>
{{--
                        @guest

                            You are not logged in

                        @else

                            You are logged in!

                            @if (Auth::check() && Auth::user()->roles->id=='admin')

                            You are an Admin, showing Admin options...
                                {{ __(' You are an Admin, showing Admin options...') }}
                            @endif

                            @if(Auth::user()->UserIsSupport)

                                {{ __('You are a Moderator, showing Moderator options!') }}
                            @endif

                        @endguest--}}

                        {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
