@extends('layouts.layout')

@section('title', 'Create transaction')

@section('content')
    <h3 class="text-center mt-4">Create transaction</h3>
    <div class="row">
        <div class="col-md-6 m-auto">
            <form action="{{route('transactions.store')}}" method="post" enctype="multipart/form-data">
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
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3"></textarea>
                    @error('description')
                    <small class="form-text text-danger">Description required</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control @error('amount') is-invalid @enderror"
                           id="amount" name="amount"
                           placeholder="Enter amount">
                    @error('amount')
                        <small class="form-text text-danger">Amount required</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="amount">Image</label>
                    <input type="file"
                           class="form-control-file"
                           id="image" name="image"
                    @error('amount')
                        <small class="form-text text-danger">Image error</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-4">Create</button>
            </form>
        </div>
    </div>
@endsection

