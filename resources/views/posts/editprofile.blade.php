@extends('layouts.app')
@section('title','Edit Profile')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class = "card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form action="{{route('posts.updateregister',$user->id)}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="imageInput" class="col-md-4 col-form-label text-md-end">Image</label>

                                <div class="col-sm-6">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="imageInput" name="image" placeholder="">
                                    @error('image')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection





