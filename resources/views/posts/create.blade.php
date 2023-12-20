@extends('layouts.app')

@section('title', 'CREATE PAGE')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.Title') }}: </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="titleInput" name="title" placeholder="{{ __('messages.Enter title') }}">
                    </div>

                    <div class="form-group">
                        <label for="contentInput">{{ __('messages.Content') }}: </label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="contentInput" rows="3" name="content"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="imgInput" class="form-label">{{ __('messages.Image') }}:</label>
                        <input type="file" class="form-control @error('img') is-invalid @enderror" id="imgInput" name="img">
                        @error('img')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="priceInput" class="col-sm-2 col-form-label"> {{ __('messages.Price') }}: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="priceInput" style="margin-bottom: 0.6rem;" placeholder="{{ __('messages.Enter price') }}">
                        </div>
                        @error('price')
                            <div class = "invalid-feedback">{{$message}}</div>
                        @enderror
                    </div><br>

                    <div class="form-group">
                        <label for="categoryInput">{{ __('messages.Category') }}: </label>
                        <select class="form-control @error('category_id') is-invalid @enderror" id="categoryInput" name="category_id">
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="form-group mt-3">
                        <button class="btn btn-outline-success" type="submit">{{ __('messages.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{--    <form>--}}
{{--        <div class="form-group">--}}
{{--            <label for="exampleFormControlFile1">Example file input</label>--}}
{{--            <input type="file" class="form-control-file" id="exampleFormControlFile1">--}}
{{--        </div>--}}
{{--    </form>--}}

@endsection
