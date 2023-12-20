@extends('layouts.app')
@section('title','shot page')
@section('content')

    <section class="credit-card">
        <div class="container">

            <div class="card-holder">
                <div class="card-box bg-news">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="img-box">
                                <img src="{{Auth::user()->image}}" class="img-fluid"  style="width: 350px; height: 500px"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form action="{{route('posts.addMoney', Auth::user()->id)}}" method="post">
                                @csrf
                                    <div class="card-details">
                                        <h3 class="title">Credit Card</h3>
                                        <br>
                                        <div class="form-group" id="credit_cards">
                                            <img src="https://bootstraptema.ru/snippets/form/2017/visa.jpg" id="visa">
                                            <img src="https://bootstraptema.ru/snippets/form/2017/mastercard.jpg" id="mastercard">
                                            <img src="https://bootstraptema.ru/snippets/form/2017/amex.jpg" id="amex">
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="form-group col-sm-8">
                                                <div class="inner-addon right-addon">
                                                    <input type="number" name="shot" class="form-control" style="width: 250px" placeholder="money">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <button type="submit" class="btn btn-outline-success btn-sm">Add Money</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

{{--    <div class="container">--}}
{{--        <form action="{{route('posts.addMoney', Auth::user()->id)}}" method="post">--}}
{{--            @csrf--}}
{{--            <input type="number" name="shot" class="form-control" style="width: 250px" placeholder="money">--}}
{{--            <br>--}}
{{--            --}}{{--            <hr>--}}
{{--            <button type="submit" class="btn btn-outline-success btn-sm">Add Money</button>--}}
{{--        </form>--}}
{{--    </div>--}}
@endsection

