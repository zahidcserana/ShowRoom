<?php
use App\Model\Item;
?>
@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Sales Information</div>
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
                        <div align="center">
                        <a  href="{{route('sale')}}"><button class="btn btn-success btn-number"><b>Add New</b> <span class="glyphicon glyphicon-plus"></span></button></a>
                        </div>
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Vouchar</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                    <th>Vouchar Sale</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($list as $row)
                                <tr class="odd gradeX">
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->vouchar_no}}</td>
                                    <td>{{$row->product==''?'':(Item::findOrFail($row->product)->name)}}</td>
                                    <td>{{$row->quantity}}</td>
                                    <td>{{$row->unit_price}}</td>
                                    <td>{{$row->amount}}</td>
                                    <td>{{$row->total}}</td>
                                    <td>{{$row->created_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_content')
    @parent
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
</script>
   
@endsection

