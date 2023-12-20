@extends('layouts.app')

@section('title') Edit @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <br>
                <form action="{{ route('posts.update', $post->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="titleInput">{{ __('messages.Title') }}: </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" style="margin-bottom: 0.5rem;" id="titleInput" name="title" value="{{$post->title}}">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="contentInput">{{ __('messages.Content') }}: </label>
                        <textarea class="form-control @error('content') is-invalid @enderror" style="margin-bottom: 0.5rem;" id="contentInput" rows="3" name="content">{{$post->content}}</textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="priceInput">{{ __('messages.Price') }}: </label>
                        <input type="number" class="form-control" style="margin-bottom: 0.5rem;" id="priceInput" name="price" value="{{$post->price}}">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="categoryInput">{{ __('messages.Category') }}: </label>
                        <select class="form-control @error('category_id') is-invalid @enderror" style="margin-bottom: 0.5rem;" id="categoryInput" name="category_id">
                            @foreach($categories as $cat)
                                <option @if($cat->id == $post->category_id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <br>
                    <button class="btn btn-outline-success" type="submit">{{ __('messages.Update') }}</button>

                </form>
            </div>
        </div>
    </div>
@endsection
