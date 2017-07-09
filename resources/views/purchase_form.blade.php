@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Purchase Information</div>

                <div class="panel-body">
                   <div class="control-group">
                        <form method="post" action="{{route('purchase')}}" role="form">
                        {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Vouchar No</label>
                                <div class="col-sm-10">
                                <input type="text" name="vouchar_no" class="form-control" placeholder="Enter Vouchar No">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-10">
                                <input type="text" name="product_name" class="form-control" placeholder="Product Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Brand</label>
                                <div class="col-sm-10">
                                <input type="text" name="brand" class="form-control" placeholder="Brand">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Purchase From</label>
                                <div class="col-sm-10">
                                <input type="text" name="purchase_from" class="form-control" placeholder="Purchase From">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Quantity</label>
                                <div class="col-sm-10">
                                <input type="text" name="quantity" class="form-control" placeholder="Quantity">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                <input type="text" name="amount" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Other Expense</label>
                                <div class="col-sm-10">
                                <input type="text" name="other_expense" class="form-control" placeholder="Other Expense">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Unit Price</label>
                                <div class="col-sm-10">
                                <input type="text" name="unit_price" class="form-control" placeholder="Unit Price">
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Purchase By</label>
                                <div class="col-sm-10">
                                <input type="text" name="purchase_by" class="form-control" placeholder="Purchase By">
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
</div>
@endsection
