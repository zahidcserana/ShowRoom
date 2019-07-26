@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Category Information</div>
                @if (session('success'))
                    <div style="text-align: center;" class="alert alert-warning">
                        {{ session('success') }}
                    </div>
                @endif
                @if (isset($msg))
                    <div style="text-align: center;" class="alert alert-warning">
                        {{ $msg }}
                    </div>
                @endif
                <div class="panel-body">
                   <div class="control-group">
                        <form method="post" action="{{route('category')}}" role="form">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-6">Category Name</label>
                                <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Enter Category Name">
                                </div>
                            </div>
                            <div style="padding-top: 50px;" align="center">
                            <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </form>
                        <a href="{{route('categories')}}"><button class="btn btn-default">List</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop