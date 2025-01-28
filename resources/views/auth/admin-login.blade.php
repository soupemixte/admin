@extends('layouts.app')
@section('title', 'Login Admin')
@section('content')

@if(!$errors->isEmpty())
    <div class="alert error" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>     
        <button type="button" class="btn-close">X</button>
    </div>                
@endif          

<main class="flex-center">
    <section class="structure flex-col-center height60 gap20">
        <form method="POST" class="form" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="form-control">
                <label for="username" >@lang('lang.email')</label>
                    <input type="text" id="username" name="email" value="{{old('email')}}">
                </div>
                @if ($errors->has('email'))
                    <div class="alert_msg">
                        {{$errors->first('email')}}
                    </div>
                @endif
            <div class="form-control">
                <label for="password">@lang('lang.password')</label>
                <input type="password" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="alert_msg">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn-border">@lang('lang.login')</button>
        </form>
        
    </section>
</main>
@endsection