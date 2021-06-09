@extends('user.layouts.layout')
@section('title','Request Form')

@section('content')
<div class="bg-white min-vh-100">
    <div class="pl-3 py-3">
        <h4>
            Transactions
        </h4>
        <hr>
        <div>
            <small class="text-muted mb-5">In this pages you can create an order based on respected purposes</small>
            <div class="mt-4">
                <div class="container-fluid">
                    <form action="{{ action('UserController@requestTransaction') }}" method="POST">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Items</label>
                                    <label class="col-form-label col-md-2">Qty</label>
                                    <label class="col-form-label col-md-5">Notes</label>
                                </div>
                                <div id="requestedItems">
                                    {{ csrf_field() }}
                                    <div class="form-group row" id="items0">
                                        <div class="col-md-5">
                                            <select class="form-control" name="item[0][item]" style="width: 100%" required="required">
                                                <option value=""></option>
                                                @foreach($stockItems as $item)
                                                <option value="{{ $item->id }}" {{ $item->qty == 0 ? 'disabled' : '' }}> {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="item[0][qty]" required>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="item[0][note]">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2 offset-md-10 pl-5">
                                        <a class="btn btn-outline-info rounded-pill" id="btnAddRequest">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                        <a class="btn btn-outline-danger rounded-pill" id="btnDelRequest">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 offset-1">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-light" id="btnResetRequest">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additionalScript')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        let row_number = 0;
        $("#btnAddRequest").click(function(e){
            e.preventDefault();
            var new_row_number = row_number + 1;
            $('#requestedItems').append('\
                <div class="form-group row" id="items'+new_row_number+'">\
                    <div class="col-md-5">\
                        <select class=\"form-control\" name=\"item['+new_row_number+'][item]\" style=\"width: 100%\" required=\"required\">\
                            <option value=""></option>\
                            @foreach($stockItems as $item)\
                                <option value="{{ $item->id }}" {{ $item->qty == 0 ? 'disabled' : '' }}> {{ $item->name }}</option>\
                            @endforeach\
                        </select>\
                    </div>\
                    <div class="col-md-2">\
                        <input type="text" class="form-control" name="item['+new_row_number+'][qty]" required>\
                    </div>\
                    <div class="col-md-5">\
                        <input type="text" class="form-control" name="item['+new_row_number+'][note]">\
                    </div>\
                </div>\
            ');
            row_number++;
        });

        $("#btnDelRequest").click(function(e){
            e.preventDefault();
            $('#items'+row_number).remove();
            if(row_number > 0){
                row_number--;
            }
        });

        $('#btnResetRequest').click(function(e){
            var new_row_number = 0;
            $('#requestor').val('');
            $('#requestedItems').html('\
            {{ csrf_field() }}\
            <div class="form-group row" id="items'+new_row_number+'">\
                    <div class="col-md-5">\
                        <select class=\"form-control\" name=\"item['+new_row_number+'][item]\" style=\"width: 100%\" required=\"required\">\
                            <option value=\"\"></option>\
                            @foreach($stockItems as $item)\
                                <option value="{{ $item->id }}" {{ $item->qty == 0 ? 'disabled' : '' }}> {{ $item->name }}</option>\
                            @endforeach\
                        </select>\
                    </div>\
                    <div class="col-md-2">\
                        <input type="text" class="form-control" name="item['+new_row_number+'][qty]" required>\
                    </div>\
                    <div class="col-md-5">\
                        <input type="text" class="form-control" name="item['+new_row_number+'][note]">\
                    </div>\
                </div>\
            ');
            row_number = new_row_number;
        });

    });
</script>

@endsection