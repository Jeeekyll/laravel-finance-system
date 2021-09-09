@extends('layouts.layout')

@section('title', 'Login')

@section('content')
    <h3 class="text-center mt-4">Login</h3>
    <div class="row">
        <div class="col-md-6 m-auto">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(isset($error))
                <p>error</p>
            @endif

            <form action="{{route('login.store')}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           placeholder="Enter email">
                    @error('email')
                    <small class="form-text text-danger">Email required</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password"
                           placeholder="Enter password">
                    @error('password')
                    <small class="form-text text-danger">Password required</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 m-auto text-center mt-4">
            <a href="{{route('register.create')}}">Register an account</a>
        </div>
    </div>
@endsection
