@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Purchase Information</div>
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
                        <form method="post" action="{{route('purchase')}}" role="form">
                        {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Vouchar No</label>
                                <div class="col-sm-4">
                                <input type="text" name="vouchar_no" class="form-control" placeholder="Enter Vouchar No" required  >
                                </div>
                                <label class="col-sm-2 col-form-label"> Purchase Date</label>
                                <div class="col-sm-4">
                                <div class="input-group date" data-provide="datepicker">
                                    <input type="text" name="created_at" class="form-control" required  >
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div id="purchase_div">
                                <div class="form-group row">
                                    <label class="col-md-2">Category</label>
                                    <div class="col-md-4">
                                        <select name="category" onchange="getItems(this.value,0)" id="category" class="form-control">
                                          <option disabled selected>Select</option>
                                          @foreach($list as $item)
                                            <option value="{{$item->id}}"> {{$item->name}} </option>
                                          @endforeach
                                        </select>
                                    </div>
                                    <label class="col-md-2 col-sm-2 col-form-label">Product Name</label>
                                    <div class="col-md-4">
                                    <!-- <input type="text" name="product_name[]" class="form-control" placeholder="Product Name" required  > -->
                                    <select id="product_name_0" name="product_name[]" class="form-control">
                                        <option>Select One </option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Brand</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="brand[]" class="form-control" placeholder="Brand"   >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Purchase From</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="purchase_from[]" class="form-control" placeholder="Purchase From"   >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Quantity</label>
                                    <div class="col-sm-10">
                                    <input type="text" onchange="calUnit()" name="quantity[]" id="quantity" class="form-control" placeholder="Quantity" required  >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                    <input type="text" onchange="calUnit()" name="amount[]" id="amount" class="form-control" placeholder="Amount" required  >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Other Expense</label>
                                    <div class="col-sm-10">
                                    <input type="text" onchange="calUnit()" name="other_expense[]" id="other_expense" class="form-control" placeholder="Other Expense" required >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Unit Price</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="unit_price[]" id="unit_price" class="form-control" placeholder="Unit Price" readonly >
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Purchase By</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="purchase_by[]" class="form-control" placeholder="Purchase By"  >
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
                    <div class="col-md-3" >
                        <button id="addMore" class="fa fa-plus btn-primary btn">More</button><button id="removeDiv" class="fa fa-minus btn btn-warning">Less</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <form method="post" action="{{route('purchase')}}" role="form">
            {{ csrf_field() }}
             <div class="form-group row">
                <label class="col-sm-2 col-form-label">Voucher No</label>
                <div class="col-sm-4">
                <input type="text" name="voucher" id="voucher" class="form-control" value="{{$voucher}}" required>
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
    </div>
    <input type="hidden" id="div_no">
</div>

@endsection

@section('js_content')

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<script src="{{asset('assets/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('assets/datepicker/css/bootstrap-datepicker.min.css')}}" />

<script>

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
    $("#addMore").click(function(e) {
        divId++;
        e.preventDefault();
       $('#div_no').val(divId);
        var items = '';
        items+='<div class="newDiv_' + divId +'">';
        items+='<h3><u>Another Product</u></h3>';
        /*items+='<div class="form-group row"><label class="col-sm-2 col-form-label">Product Name</label><div class="col-sm-10"><input type="text" name="product_name[]" class="form-control" placeholder="Product Name"></div></div>';*/
        items+='<div class="form-group row"><label class="col-md-2">Category</label><div class="col-md-4"><select name="category" onchange="getItems(this.value,' + divId +')" id="category" class="form-control"><option disabled selected>Select</option>@foreach($list as $item)<option value="{{$item->id}}"> {{$item->name}} </option>@endforeach</select></div><label class="col-md-2 col-sm-2 col-form-label">Product Name</label><div class="col-md-4"><select id="product_name_' + divId +'" name="product_name[]" class="form-control"><option>Select One </option></select></div></div>';
        items+='<div class="form-group row"><label class="col-sm-2 col-form-label">Brand</label><div class="col-sm-10"><input type="text" name="brand[]" class="form-control" placeholder="Brand"></div></div>';
        items+='<div class="form-group row"><label class="col-sm-2 col-form-label">Purchase From</label><div class="col-sm-10"><input type="text" name="purchase_from[]" class="form-control" placeholder="Purchase From"></div></div>';
        items+='<div class="form-group row"><label class="col-sm-2 col-form-label"> Quantity</label><div class="col-sm-10"><input type="text" onchange="calUnitMore('+divId+')" name="quantity[]" id="quantity_' + divId +'" class="form-control" placeholder="Quantity"></div></div>';
        items+='<div class="form-group row"><label class="col-sm-2 col-form-label">Amount</label><div class="col-sm-10"><input type="text" name="amount[]" onchange="calUnitMore('+divId+')" id="amount_' + divId +'" class="form-control" placeholder="Amount"></div></div>';
        items+='<div class="form-group row"><label class="col-sm-2 col-form-label">Other Expense</label><div class="col-sm-10"><input type="text" onchange="calUnitMore('+divId+')" name="other_expense[]" id="other_expense_' + divId +'" class="form-control" placeholder="Other Expense"></div></div>';
        items+='<div class="form-group row"><label class="col-sm-2 col-form-label">Unit Price</label><div class="col-sm-10"><input type="text" name="unit_price[]" id="unit_price_' + divId +'" class="form-control" placeholder="Unit Price" readonly></div></div>';
        items+='<div class="form-group row"><label class="col-sm-2 col-form-label">Purchase By</label><div class="col-sm-10"><input type="text" name="purchase_by[]" class="form-control" placeholder="Purchase By"></div></div>';

        items+='</div>';
       
        
        $("#purchase_div").append(items);
    });

     $("#removeDiv").click(function(e) {
        e.preventDefault();
        var div_id = 'newDiv_' + divId;
        if (divId>0) {
            $( "div" ).remove('.'+ div_id );
           
            divId--;
        }
       
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

    function calUnit()
    {
        var quantity = $('#quantity').val();
        var amount = $('#amount').val();
        var other_expense = $('#other_expense').val();
        var total = parseInt(amount) + parseInt(other_expense);
        var unit_price = total/quantity;
        if(!isNaN(unit_price)) {
            $('#unit_price').val(unit_price);
        }
        
    } 

    function calUnitMore(divId)
    {
        var quantity = $('#quantity_'+divId).val();
        var amount = $('#amount_'+divId).val();
        var other_expense = $('#other_expense_'+divId).val();


       /* var quantity = $('#quantity').val();
        var amount = $('#amount').val();
        var other_expense = $('#other_expense').val();*/
        var total = parseInt(amount) + parseInt(other_expense);
        var unit_price = total/quantity;
        if(!isNaN(unit_price)) {
            $('#unit_price_'+divId).val(unit_price);
        }
        
    }
</script>

@endsection
