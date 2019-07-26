@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Sale Information</div>
                @if (session('status'))
                    <div style="text-align: center;" class="alert alert-warning">
                        {{ session('status') }}
                    </div>
                @endif
                @if (isset($msg))
                    <div style="text-align: center;" class="alert alert-warning">
                        {{ $msg }}
                    </div>
                @endif
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
                                <input type="text" name="vouchar_no" class="form-control" placeholder="Enter Vouchar No" required required>
                                </div>
                                <label class="col-sm-2 col-form-label"> Purchase Date</label>
                                <div class="col-sm-4">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" name="created_at" class="form-control" required required>
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
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody id="tr_div">
                                  <tr>
                                      <td>1</td>
                                      <td class="selection">
                                          <select name="category" onchange="getItems(this.value,0)" id="category" class="form-control">
                                          <option disabled selected>Select</option>
                                          @foreach($list as $item)
                                            <option value="{{$item->id}}"> {{$item->name}} </option>
                                          @endforeach
                                        </select>
                                      </td>
                                      <td class="selection">
                                        <select id="product_name_0" onchange="getStock(this.value,0)" name="product[]" class="form-control">
                                            <option>Select One </option>
                                        </select>
                                      <!-- <select name="product[]" class="form-control">
                                          <option disabled selected>Select</option>
                                          @foreach($product as $item)
                                            <option value="{{$item}}"> {{$item}} </option>
                                          @endforeach
                                      </select> -->
                                      </td>
                                      <td><input type="text" onchange="saleAmount('0')" name="unit_price[]" id="unit_price_0" class="form-control" required></td>
                                      <td><input type="text" onchange="saleAmount('0')" name="quantity[]" id="quantity_0" class="form-control" required></td>
                                      <td><input type="text" name="amount[]" id="amount_0" class="form-control" required></td>
                                      <td><input type="text" name="stock[]" id="stock_0" class="form-control" readonly><input type="hidden" id="remaining_0"></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="form-group row">
                                <div align="center" class="offset-sm-2 col-sm-10">
                                    <button id="submit" style="display: none;" type="submit" class="btn btn-primary">Submit</button>
                                    <button id="calculation" class="btn btn-primary">Calculate</button>
                                </div>
                            </div>
                        </form>
                        <!-- <a href="{{route('purchase')}}"><button class="btn btn-default">Cancel</button></a> -->
                    </div>
                    <div class="col-md-3" >
                        <button id="addMore" class="fa fa-plus btn btn-primary">More</button><button id="removeDiv" class="fa fa-minus btn btn-warning">Less</button>
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
                <input type="text" name="voucher" id="voucher" class="form-control" value="{{$voucher}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Total Amount Sale</label>
                <div class="col-sm-4">
                <input type="text" name="total_amount" class="form-control" value="{{$total_amount}}">
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
    <input type="hidden" id="sum">
</div>

@endsection

@section('js_content')

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<script src="{{asset('assets/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('assets/datepicker/css/bootstrap-datepicker.min.css')}}" />

<script>

    function getStock(item,t)
    {
        var CSRF_TOKEN = "{{ csrf_token() }}";
        $.ajax({
          type: "POST",
          url: "{{route('item_stock')}}",
          data: {item:item,_token: CSRF_TOKEN},
          cache: false,
          success: function(data){
                 var data = JSON.parse(data);
                 var stock = data.stock;

                 var quantity = $("#quantity_"+t).val();
                 if (quantity!='') {
                    stock = parseInt(stock) - parseInt(quantity);
                 }
                 $("#stock_"+t).val(stock);
                 $("#remaining_"+t).val(stock);
            }

        });
    }
    function getItems(category,t)
    {
        var CSRF_TOKEN = "{{ csrf_token() }}";
        $.ajax({
          type: "POST",
          url: "{{route('item_by_category')}}",
          data: {category:category,_token: CSRF_TOKEN},
          cache: false,
          success: function(data){
                 var data = JSON.parse(data);
                 var items = data.items;
                 var itemOption = '';
                 itemOption+='<option>Select One </option>';
                 var id,item;
                 for (var i = 0; i <items.length; i++) {
                     id = items[i]['id'];
                     item = items[i]['name'];

                     itemOption+='<option value="'+id+'">'+item+' </option>'
                 }
                 $("#product_name_"+t).html(itemOption);
            }

        });
    }
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
        /*items+='<td><select name="product[]" class="form-control"><option disabled selected>Select</option>@foreach($product as $item)<option value="{{$item}}"> {{$item}} </option>@endforeach</select></td>';*/
        items+='<td><select name="category" onchange="getItems(this.value,'+divId+')" id="category" class="form-control"><option disabled selected>Select</option>@foreach($list as $item)<option value="{{$item->id}}"> {{$item->name}} </option>@endforeach</select></td>';
        items+='<td><select id="product_name_'+divId+'" onchange="getStock(this.value,'+divId+')" name="product[]" class="form-control"><option>Select One </option></select></td>';
        items+='<td><input type="text" onchange="saleAmount('+divId+')" name="unit_price[]" id="unit_price_' + divId +'" class="form-control" placeholder="Unit Price"></td>';
        items+='<td><input type="text" onchange="saleAmount('+divId+')" name="quantity[]" id="quantity_' + divId +'" class="form-control" placeholder="Quantity"></td>';
        items+='<td><input type="text" name="amount[]" id="amount_' + divId +'" class="form-control" placeholder="Amount"></td>';
        items+='<td><input type="text" name="stock[]" id="stock_' + divId +'" class="form-control" placeholder="Stock" readonly><input type="hidden" id="remaining_' + divId +'"></td>';

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
        calculate+=' <tr><td colspan="4">Total</td><td><input type="text" id="total_amount" name="total" class="form-control"></td></tr>';
        calculate+='<tr><td colspan="4">Less</td><td><input type="text" name="less" id="less" class="form-control"></td></tr>';
        calculate+='<tr><td colspan="4">Due</td><td><input type="text" onchange="paidCal()" name="due" id="due" class="form-control"></td></tr>';
        calculate+='<tr><td colspan="4">Paid</td><td><input type="text" id="paid" name="paid" class="form-control"></td></tr>';
        
        $("#tr_div").append(calculate);
        $("#calculation").hide();
        $("#addMore").hide();
        $("#removeDiv").hide();
        $("#submit").show();
        var sum = $('#sum').val();
        $('#total_amount').val(sum);
    });

});
    /*function TotalAmount()
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
    }*/
$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});
/*function Amount(id=0)
{
    var quantity = $('#quantity_'+id).val();
    var unit_price = $('#unit_price_'+id).val();
    var amount = parseInt(quantity)*parseInt(unit_price) ;
    $('#amount_'+id).val(amount);
   
    var totalAmount = amount;

    for (var i = 1; i <= divId; i++) {
        var quantity = $('#quantity_'+divId).val();
        var unit_price = $('#unit_price_'+divId).val();
        var other_expense = $('#other_expense_'+divId).val();
        var amount = parseInt(quantity)*parseInt(unit_price) +  parseInt(other_expense);
        totalAmount+=amount;
    }
    $('#total_amount').val(totalAmount);
}*/

function saleAmount(id)
{
    var quantity = $('#quantity_'+id).val();
    var unit_price = $('#unit_price_'+id).val();
    var amount = parseInt(quantity)*parseInt(unit_price) ;
    if(!isNaN(amount)) {
        $('#amount_'+id).val(amount);
    }
   
    var totalAmount = 0;

    var divId = $('#div_no').val();

        for (var i = 0; i <= divId; i++) {
            var amount = $('#amount_'+i).val();
            totalAmount+=parseInt(amount);
            //$('#amount_'+divId).val(amount);
        }
    $('#sum').val(totalAmount);
    var stock = $('#remaining_'+id).val();
    $('#stock_'+id).val(parseInt(stock) - parseInt(quantity));
}
function paidCal()
{
    var total_amount =$('#total_amount').val();
    var less =$('#less').val();
    var due =$('#due').val();
    var paid = parseInt(total_amount)- parseInt(less) - parseInt(due);
    $('#paid').val(paid);
}
</script>
<style>
    .selection {
        width: 20%;
    }
</style>
@endsection
