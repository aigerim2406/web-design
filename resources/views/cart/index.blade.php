@extends('layouts.app')

@section('title', 'cart')

@section('content')
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-7"></div>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Shopping cart</p>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        @foreach($postsInCart as $post)
                                        <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                            <div>
                                                                <img
                                                                    src="{{asset($post->img)}}"
                                                                    class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                            </div>
                                                            <div class="ms-3">
                                                                <h5>{{$post->title}}</h5>
                                                                <p class="small mb-0">{{$post->pivot->status}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div style="width: 50px;">
                                                                <h5 class="fw-normal mb-0">{{$post->pivot->quantity}}</h5>
                                                            </div>
                                                            <div style="width: 80px;">
                                                                <h5 class="mb-0">{{$post->price*$post->pivot->quantity}}</h5>
                                                            </div>
                                                            <form action="{{route('cart.deletefromcart', $post->id)}}" method="POST">
                                                                @csrf
                                                                <button class="btn btn-btn-danger" type="submit">{{ __('messages.Delete') }}</button>
                                                            </form>
                                                        </div>
                                                </div>
                                        </div>
                                        @endforeach
{{--                                        <div class="d-flex justify-content-between mb-4">--}}
{{--                                            <p class="mb-2">$4818.00</p>--}}
{{--                                        </div>--}}
                                    </div>
                                    <form action="{{route('cart.buy', Auth::user()->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-outline-success" type="submit"
                                            @if(Auth::user()->shot <= $sum || $kol == 0) disabled @endif>
                                            {{ __('messages.Buy All') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
