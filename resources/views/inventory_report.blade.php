@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Purchase Information</div>

                <div class="panel-body">
                   <div class="control-group">
                     <form method="post" action="{{route('inventory_report')}}" role="form">
                                            {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Date From</label>
                            <div class="col-sm-4">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" name="date_from" class="form-control" value="{{$date_from}}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-2 col-form-label"> Date To</label>
                            <div class="col-sm-4">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" name="date_to" class="form-control" value="{{$date_to}}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div align="center" class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-hover" style="margin-left: 7%;width: 87%">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Product</th>
                                <th>Purchase Quantity</th>
                                <th>Sale Quantity</th>
                                <th>Return Quantity</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0; $i<count($product); $i++)
                            <tr class="odd gradeX">
                                <td>{{$i}}</td>
                                <td>{{$product[$i]}}</td>
                                <td>{{$quantity_p[$i]}}</td>
                                <td>{{$quantity_s[$i]}}</td>
                                <td>{{$quantity_r[$i]}}</td>
                                <td>{{$quantity[$i]}}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="{{asset('assets/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('assets/datepicker/css/bootstrap-datepicker.min.css')}}" />
