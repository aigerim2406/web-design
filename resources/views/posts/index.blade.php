@extends('layouts.app')

@section('title', 'INDEX PAGE')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="heading_container heading_center">
                    <center>
                        <h2>
                            {{__('messages.welcome to our gift shop Ai-Moon')}}
                        </h2>
                    </center>
                </div>
                <br>
                @can('create', App\Models\Post::class)
                    <a href="{{route('posts.create')}}">{{ __('messages.Create') }}</a>
                @endcan
                <br>
                <hr>
                <br> <br>
                <div class="row">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="https://pandora.kz/upload/iblock/735/9ojppnatj1jsvpuwsye3pxd3y1143v7j.jpg">
                            </div>
                        </div>
                    </div>
                    <br> <br> <br>
                    <hr>
                    <br><br>
                    @foreach($posts as $post)
                        <div class="col-sm-4 mt-3">
                            <div class="card" style="width: 17rem; height: 25rem">
                                <img class="card-img-top" src="{{asset($post->img)}}" style="width: 150px; height: 150px">
                                <div class="card-body">
                                    <h5 class="card-title">{{$post->{'title_'.app()->getLocale()} }}</h5>
                                    {{ __('messages.Author') }}: {{$post->user->name}}
                                    <p class="card-text">{{$post->price}} ₸</p>
                                    <a href="{{route('posts.show', $post->id)}}" class="btn btn-outline-secondary">{{ __('messages.Read More') }}</a>
                                    &nbsp;
                                    @can('delete', $post)
                                        <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" type="submit">{{ __('messages.Delete') }}</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    <section class="contact-section bg-white">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-3 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h5 class="text-uppercase m-0">Address</h5>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">NarXoz universitity, st.Zhandosova,55</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-3 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h5 class="text-uppercase m-0">Email</h5>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50"><a href="#!">aigerim.gubaidullina@narxoz.kz</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-3 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h5 class="text-uppercase m-0">Phone</h5>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">+7 777 754 8832</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><hr><br>
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; NarXoz, Kazakhstan 2023</div>
    </footer>
@endsection
