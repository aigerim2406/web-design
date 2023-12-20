@extends('layouts.adm')

@section('title','Cart page')

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">#</th>
        </tr>
        </thead>
        <tbody>
        @for($i = 1;$i<count($postsInCart);$i++)
            <tr>
                <th scope="row">{{$i}}</th>
                <th>###</th>
                <td>{{$postsInCart[$i-1]->post->title}}</td>
                <td>{{$postsInCart[$i-1]->user->name}}</td>
                <td>{{$postsInCart[$i-1]->quantity}}</td>
                <td>{{$postsInCart[$i-1]->status}}</td>
                <td>
                    <form action="{{route('admin.cart.confirm',$postsInCart[$i-1]->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-outline-success" type="submit">by Ordered</button>
                    </form>
                </td>
                <td></td>
            </tr>
        @endfor
        </tbody>
    </table>
@endsection
