@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Purchase Information</div>

                <div class="panel-body">
                   <div class="control-group">
                        <form method="post" action="{{route('sale')}}" role="form">
                        {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Shop No</label>
                                <div class="col-sm-4">
                                    <select name="shop" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Vouchar No</label>
                                <div class="col-sm-4">
                                <input type="text" name="vouchar_no" class="form-control" placeholder="Enter Vouchar No">
                                </div>
                                <label class="col-sm-2 col-form-label"> Purchase Date</label>
                                <div class="col-sm-4">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" name="created_at" class="form-control">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div id="purchase_div">
                             <table class="table" border="1">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Product</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tr_div">
                                  <tr>
                                      <td>1</td>
                                      <td><input type="text" name="product[]" class="form-control"></td>
                                      <td><input type="text" name="unit_price[]" id="unit_price" class="form-control"></td>
                                      <td><input type="text" name="quantity[]" id="quantity" class="form-control"></td>
                                      <td><input type="text" name="amount[]" id="amount" class="form-control"></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="form-group row">
                                <div align="center" class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button id="calculation" class="btn btn-primary">Calculate</button>
                                </div>
                            </div>
                        </form>
                        <!-- <a href="{{route('purchase')}}"><button class="btn btn-default">Cancel</button></a> -->
                    </div>
                    <div class="col-md-3" >
                        <button id="addMore" class="fa fa-plus btn blue">More</button><button id="removeDiv" class="fa fa-minus btn red">Less</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <form method="post" action="{{route('sale')}}" role="form">
            {{ csrf_field() }}
             <div class="form-group row">
                <label class="col-sm-2 col-form-label">Voucher No</label>
                <div class="col-sm-4">
                <input type="text" name="voucher" id="voucher" class="form-control" value="{{$voucher}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Total Amount Sale</label>
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
    </div>
    <input type="hidden" id="div_no">
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<script src="{{asset('assets/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('assets/datepicker/css/bootstrap-datepicker.min.css')}}" />

<script>
    $(function() {
    var divId = 0; 
    var tdId = 1;
    $("#addMore").click(function(e) {
        divId++;
        tdId++;
        e.preventDefault();
       $('#div_no').val(divId);
        var items = '';
        items+='<tr class="newDiv_' + divId +'">';
        items+='<td>'+tdId+'</td>';
        items+='<td><input type="text" name="product[]" class="form-control" placeholder="Product Name"></td>';
        items+='<td><input type="text" name="unit_price[]" id="unit_price_' + divId +'" class="form-control" placeholder="Unit Price"></td>';
        items+='<td><input type="text" name="quantity[]" id="quantity_' + divId +'" class="form-control" placeholder="Quantity"></td>';
        items+='<td><input type="text" name="amount[]" id="amount_' + divId +'" class="form-control" placeholder="Amount"></td>';

        items+='</tr>';
        
        $("#tr_div").append(items);
    });

     $("#removeDiv").click(function(e) {
        e.preventDefault();
        var div_id = 'newDiv_' + divId;
        if (divId>0) {
            $( "tr" ).remove('.'+ div_id );
           
            divId--;
        }
       
    }); 

      $("#calculation").click(function(f) {
        f.preventDefault();
        var calculate = '';
        calculate+=' <tr><td colspan="4">Total</td><td><input type="text" name="total" class="form-control"></td></tr>';
        calculate+='<tr><td colspan="4">Less</td><td><input type="text" name="less" class="form-control"></td></tr>';
        calculate+='<tr><td colspan="4">Due</td><td><input type="text" name="due" class="form-control"></td></tr>';
        calculate+='<tr><td colspan="4">Paid</td><td><input type="text" name="paid" class="form-control"></td></tr>';
        
        $("#tr_div").append(calculate);
        $("#calculation").hide();
        $("#addMore").hide();
        $("#removeDiv").hide();
    });

});
    function TotalAmount()
    {
        var quantity = $('#quantity').val();
        var unit_price = $('#unit_price').val();
        var other_expense = $('#other_expense').val();
        var amount = parseInt(quantity)*parseInt(unit_price) +  parseInt(other_expense);
        $('#amount').val(amount);
        
        var totalAmount = amount;
        var divId = $('#div_no').val();

        for (var i = 1; i <= divId; i++) {
            var quantity = $('#quantity_'+divId).val();
            var unit_price = $('#unit_price_'+divId).val();
            var other_expense = $('#other_expense_'+divId).val();
            var amount = parseInt(quantity)*parseInt(unit_price) +  parseInt(other_expense);
            totalAmount+=amount;
            $('#amount_'+divId).val(amount);
        }
        $('#total_amount').val(totalAmount);
    }
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
function Amount()
    {
        var quantity = $('#quantity').val();
        var unit_price = $('#unit_price').val();
        var other_expense = $('#other_expense').val();
        var amount = parseInt(quantity)*parseInt(unit_price) +  parseInt(other_expense);
        $('#amount').val(amount);
       
        var totalAmount = amount;
 /*
        for (var i = 1; i <= divId; i++) {
            var quantity = $('#quantity_'+divId).val();
            var unit_price = $('#unit_price_'+divId).val();
            var other_expense = $('#other_expense_'+divId).val();
            var amount = parseInt(quantity)*parseInt(unit_price) +  parseInt(other_expense);
            totalAmount+=amount;
        }*/
        $('#total_amount').val(totalAmount);
    }

</script>