@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Inventory Information</div>

                <div class="panel-body">
                   <div class="control-group">
                     <form method="post" action="{{route('inventory_report')}}" role="form">
                                            {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label"> Date From</label>
                            <div class="col-sm-3">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" name="date_from" class="form-control" value="{{$date_from}}" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-1 col-form-label"> Date To</label>
                            <div class="col-sm-3">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" name="date_to" class="form-control" value="{{$date_to}}" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-sm-4">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-hover" >
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
                                <td>{{$i+1}}</td>
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

@section('js_content')

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="{{asset('assets/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('assets/datepicker/css/bootstrap-datepicker.min.css')}}" />
@endsection