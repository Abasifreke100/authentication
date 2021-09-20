
@extends('layout.master')

@section('content')
<style>
    .container{
        margin-top:50px!important;
    }
</style>

<div class="container">
    <h1 class="header" style="text-align: center">User Authentication</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="container" >
                <h1>Register</h1>
                <form action="{{route('register')}}" method="post">
                @csrf
                <div class="form-group">
                        <input type="text" placeholder="Name" name="name" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Email" name="email" class="form-control" required></input>
                    </div>

                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" class="form-control" required></input>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>

                </form>
            </div>
        </div>
        <div class="col-md-6">
        <div class="container">
                <h1>Login</h1>
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="email" placeholder="Email" name="email" class="form-control"required></input>
                    </div>

                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password" class="form-control"required></input>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>

                </form>
            </div>

        </div>
    </div>
</div>




@stop
