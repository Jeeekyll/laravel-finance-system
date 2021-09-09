@extends('layouts.layout')

@section('title', 'Register')

@section('content')
    <h3 class="text-center mt-4">Register</h3>
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

            <form action="{{route('register.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name"
                           placeholder="Enter name">
                    @error('name')
                    <small class="form-text text-danger">Name required</small>
                    @enderror
                </div>

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

                <div class="form-group">
                    <label for="name">Confirm password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password_confirmation" name="password_confirmation"
                           placeholder="Confirm password">
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 m-auto text-center mt-4">
            <a href="{{route('login')}}">I already registered</a>
        </div>
    </div>
@endsection
