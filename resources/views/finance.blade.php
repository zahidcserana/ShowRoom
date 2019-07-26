@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Finance Information</div>

                <div class="panel-body">
                   <div class="control-group">
                        <form method="post" action="{{route('finance')}}" role="form">
                        {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Exp: Vouchar No</label>
                                <div class="col-sm-4">
                                <input type="text" name="vouchar_no" class="form-control" placeholder="Enter Vouchar No" required>
                                </div>
                                <label class="col-sm-2 col-form-label"> Exp: Date</label>
                                <div class="col-sm-4">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" name="created_at" class="form-control" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div id="purchase_div">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Person Name</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="person" class="form-control" placeholder="Person Name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Purpose</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="purpose" class="form-control" placeholder="Purpose" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Amount Issue</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="issue" onchange="Deposited()" id="issue" class="form-control" placeholder="Amount Issue" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Amount Used</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="used" onchange="Deposited()" id="used" class="form-control" placeholder="Amount Used" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Deposited</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="deposited" id="deposited" class="form-control" placeholder="Deposited" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div align="center" class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <!-- <a href="{{route('purchase')}}"><button class="btn btn-default">Cancel</button></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div>
        <form method="post" action="{{route('purchase')}}" role="form">
            {{ csrf_field() }}
             <div class="form-group row">
                <label class="col-sm-2 col-form-label">Voucher No</label>
                <div class="col-sm-4">
                <input type="text" name="voucher" id="voucher" class="form-control" value="{{$voucher}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Total Amount</label>
                <div class="col-sm-4">
                <input type="text" name="total_amount" id="total_amount" class="form-control" value="{{$total_amount}}">
                </div>
            </div>
             <div class="form-group row">
                <div align="center" class="offset-sm-2 col-sm-10">
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div> -->
    <input type="hidden" id="div_no">
</div>

@endsection

@section('js_content')

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="{{asset('assets/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('assets/datepicker/css/bootstrap-datepicker.min.css')}}" />

<script>

$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
    function Deposited()
    {
        var issue = $('#issue').val();
        var used = $('#used').val();
        var deposited = parseInt(issue) -  parseInt(used);
        if(!isNaN(deposited)) {
            $('#deposited').val(deposited);
        }
    }

</script>

@endsection