@extends('layouts.adm')

@section('title', 'Users page')

@section('content')
<form action="{{route('admin.users.search')}}" method="GET">
    <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="search..." aria-label="Username" aria-describedby="basic-addon1"/>
            <button type="submit" class="btn btn-secondary">Search</button>
    </div>
</form>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th>###</th>
                <th>###</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0; $i<count($users); $i++)
                <tr>
                    <th scope="row">{{$i+1}}</th>
                    <td>{{$users[$i]->name}}</td>
                    <td>{{$users[$i]->email}}</td>
                    <td>{{$users[$i]->role->name}}</td>
                    <td></td>
                </tr>
            @endfor
        </tbody>
    </table>
@endsection
