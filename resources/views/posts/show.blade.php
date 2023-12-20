@extends('layouts.app')

@section('title', 'посмотреть')

@section('content')
    <div class="container d-flex g-5">
        <div class="container">
            <p><img class="card-img-top" src="{{asset($post->img)}}" style="width: 400px; height: 550px"></p>
        </div>
        <div class="container">
            <div class="col-md-10">

                <h4 class="display-5">{{$post->{'title_'.app()->getLocale()} }}</h4>
                <h4 class="fw-bold" >
                    <span class=""> {{$post->price}} ₸ </span>
                </h4>
                <p>{{$post->{'content_'.app()->getLocale()} }}</p>
                @can('update',$post)
                     <a href="{{route('posts.edit', $post->id)}}">{{__('messages.Edit')}}</a>
                @endcan
            </div>
            <br>
            <div class="form-group">
                @auth
                    <form action="{{route('posts.rate', $post->id)}}" method="post">
                        @csrf
                        <select class="form-control"  name="rating">
                            @for($i=1; $i<=5; $i++)
                                <option {{$myRating==$i ? 'selected' : ''}} value="{{$i}}">
                                    {{ $i==0 ? 'Not rated' : $i }}
                                </option>
                            @endfor
                        </select>
                        <hr>
                        <button class="btn btn-outline-secondary" type="submit">Rate</button>
                    </form>
                    @if($avgRating != 0)
                        <h5>Rating: {{$avgRating}}</h5>
                    @endif

                    <hr>

                    <div class="input-group quantity-selector">
                        <form action="{{route('cart.puttocart', $post->id)}}" method="POST">
                            @csrf
                            Sany: <input type="number" id="inputQuantitySelector" class="form-control" aria-live="polite" data-bs-step="counter" name="quantity"  min="0" max="5" >
                            <button class="btn btn-outline-success" type="submit">{{__('messages.To Cart')}}</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <hr>

    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: rgba(239,237,237,0.8);">
                <div class="card-body p-4">
                    <label class="form-label" for="addANote">+ {{__('messages.Add a note')}}</label>
                    <div class="form-outline mb-4">
                        <form action="{{route('comments.store')}}" method="post">
                            @csrf
                            <textarea class="form-control" name="content" id="" cols="30" rows="5" placeholder="{{__('messages.What do you think')}}?"></textarea>
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <br>
                            <button class="btn btn-outline-success" type="submit">{{__('messages.Save')}}</button>
                        </form>
                    </div>
                    <div class="card mb-4">
                        @foreach($post->comments as $comment)
                            <div class="card-body">
                                <p>{{$comment->content}}</p>

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <img src="{{Auth::user()->image}}" alt="avatar" width="25"
                                             height="25" />
                                        <p class="small mb-0 ms-2">{{$comment->created_at}}</p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('comments.destroy', $comment->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-btn-danger" type="submit">{{__('messages.Delete')}}</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
