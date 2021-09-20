
@extends('layout.master')

@section('content')
<style>
    .container{
        margin-top:50px!important;
    }

</style>

<div class="container">
    <h1 class="header" style="text-align: center">User Dashboard</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="container" >
            <h1>Daily Todos</h1>

                <form action="{{route('post')}}" method="post">
                    @csrf
                <div class="form-group">
                        <input type="text" placeholder="Name" name="name" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <input type="title" placeholder="Title" name="title" class="form-control" required></input>
                    </div>

                    <div class="form-group">
                        <textarea name="description" placeholder="Description" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>

                </form>
            </div>
        </div>

        <div class="col-md-6">

            <div class="container">
            <h1>Todo Records</h1>

                <table class="table">

                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                            <th scope="col">Author</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($todos as $todo)
                        <tr>
                            <td>{{$todo->id}}</td>
                            <td>{{$todo->name}}</td>
                            <td>{{$todo->title}}</td>
                            <td>{{$todo->description}}</td>
                            <td>{{$todo->user->name}}</td>

                        </tr>
                    @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>


@stop
