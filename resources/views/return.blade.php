@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product Return Information</div>

                <div class="panel-body">
                   <div class="control-group">
                        <form method="post" action="{{route('return')}}" role="form">
                        {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Vouchar No</label>
                                <div class="col-sm-4">
                                    <select name="vouchar_no" class="form-control">
                                          <option disabled selected>Select</option>
                                          @foreach($vouchar_no as $item)
                                            <option value="{{$item}}"> {{$item}} </option>
                                          @endforeach
                                      </select>
                                </div>

                                <label class="col-sm-2 col-form-label"> Return Date</label>
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
                                    <select id="product_name_0" name="product" class="form-control">
                                        <option>Select One </option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"> Quantity</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="quantity" onchange="calUnit()" id="quantity" class="form-control" placeholder="Quantity" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Amount</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="amount" id="amount" onchange="calUnit()" class="form-control" placeholder="Amount" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Unit Price</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="unit_price" id="unit_price" class="form-control" placeholder="Unit Price" readonly>
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

    function calUnit()
    {
        var quantity = $('#quantity').val();
        var amount = $('#amount').val();
        var unit_price = parseInt(amount)/parseInt(quantity);
        if(!isNaN(unit_price)) {
            $('#unit_price').val(parseInt(unit_price));
        }
        
    } 
</script>

@endsection