@extends('layouts.main')
@section('content')
        <form class="form-horizontal" action="#" method="post" id="product_form">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="td_space" class="control-label">Product Name: </label>
                <input type="text" autofocus="" required="" name="product" id="product" class="form-control" title="Please enter product name" value="" placeholder="Enter Product Name">
            </div>
            <div class="form-group">
                <label for="td_space" class="control-label">Quantity in stock: </label>

                <input type="text" autofocus="" required="" name="quantity" id="quantity" class="form-control" title="Please enter Quantity in stock" value="" placeholder="Enter Quantity in stock">
            </div>
            <div class="form-group">
                <label for="td_space" class="control-label">Price per item: </label>
                <input type="text" autofocus="" required="" name="price" id="price" class="form-control" title="Please enter Price per item" value="" placeholder="Enter Price per item">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" id="save_data" type="button">Save</button>
            </div>
        </form>

        <div class="content">
            <div class="row column-order">
                <legend>Product info</legend>
                <div style="border-bottom: 1px solid">
                    <div style="overflow:hidden;margin-right:16px" id="headerdiv">
                        <table style="min-width:900px;border-bottom:1px solid;border-top: 1px solid">
                            <thead><tr>
                                <th>Product Name</th>
                                <th>Quantity in stock</th>
                                <th>Price per item</th>
                                <th>Total value number</th>
                                <th>Datetime submitted</th>
                                <th>Action</th>
                            </tr></thead>
                            <tbody id="product_data_list"></tbody>
                        </table>
                        <div class="text-right">sum total of all of the Total Value numbers: <i id="total_sum"></i></div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script-bottom')
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
        $("#product_data_list").children().remove();
        $("#total_sum").children().remove();
        $.ajax({
            url: "{{url('get')}}",
            type: 'get',
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                datashow(data);

            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    $(document).on('click','button#save_data', function(e){
        var form_data = new FormData($("#product_form")[0]);
        $("#product_data_list").children().remove();
        $.ajax({
            url: "{{url('save')}}",
            type: 'POST',
            data:form_data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                datashow(data);

            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    function datashow(data) {
        $.each(data[1],function(i,obj)
        {
            var row = "<tr>";
            $.each(obj,function(j,dobj)
            {
                row = row+"<td class='prd'>"+dobj+"</td>";
            });
            row = row+"<td><a href='#' class='btn btn-primary'>Edit</a></td></tr>";
            $("#product_data_list").append($(row));
        });
        $("#total_sum").append(data[0]);
    }
</script>
@endsection