@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Item Information</div>
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
                        <form method="post" action="{{route('item')}}" role="form">
                        {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-md-6">Category</label>
                                <div class="col-md-6">
                                    <select name="category" class="form-control">
                                      <option disabled selected>Select</option>
                                      @foreach($list as $item)
                                        <option value="{{$item->id}}"> {{$item->name}} </option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-6">Item Name</label>
                                <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Enter Item Name">
                                </div>
                            </div>
                            <div style="padding-top: 50px;" align="center">
                            <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </form>
                        <a href="{{route('items')}}"><button class="btn btn-default">List</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop