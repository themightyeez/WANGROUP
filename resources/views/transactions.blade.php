@extends('layouts.layout')
@section('title','Transaction')

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
                <ul class="nav nav-pills custom-pill mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill active request" id="pills-request-tab" data-toggle="pill" href="#pills-request" role="tab" aria-controls="pills-request" aria-selected="true">Request</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill return" id="pills-return-tab" data-toggle="pill" href="#pills-return" role="tab" aria-controls="pills-return" aria-selected="false">Return</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill opname" id="pills-opname-tab" data-toggle="pill" href="#pills-opname" role="tab" aria-controls="pills-opname" aria-selected="false">Opname</a>
                    </li>
                </ul>

                <hr>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-request" role="tabpanel" aria-labelledby="pills-request-tab">@include('form.request')</div>
                    <div class="tab-pane fade" id="pills-return" role="tabpanel" aria-labelledby="pills-return-tab">@include('form.return')</div>
                    <div class="tab-pane fade" id="pills-opname" role="tabpanel" aria-labelledby="pills-opname-tab">@include('form.opname')</div>
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
                            <option value=\"\"></option>\
                            @foreach($stockItems as $item)\
                            <option value=\"{{ $item->id }}\"> {{ $item->name }}</option>\
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
                            <option value=\"{{ $item->id }}\"> {{ $item->name }}</option>\
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

<script>
    $(document).ready(function(){
        let row_number = 0;
        $("#btnAddReturn").click(function(e){
            e.preventDefault();
            var new_row_number = row_number + 1;
            $('#returnedItems').append('\
                <div class="form-group row" id="items'+new_row_number+'">\
                    <div class="col-md-5">\
                        <select class=\"form-control\" name=\"item['+new_row_number+'][item]\" style=\"width: 100%\" required=\"required\">\
                            <option value=\"\"></option>\
                            @foreach($stockItems as $item)\
                            <option value=\"{{ $item->id }}\"> {{ $item->name }}</option>\
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

        $("#btnDelReturn").click(function(e){
            e.preventDefault();
            $('#items'+row_number).remove();
            if(row_number > 0){
                row_number--;
            }
        });

        $('#btnResetReturn').click(function(e){
            var new_row_number = 0;
            $('#returnee').val('');
            $('#returnedItems').html('\
            {{ csrf_field() }}\
            <div class="form-group row" id="items'+new_row_number+'">\
                    <div class="col-md-5">\
                        <select class=\"form-control\" name=\"item['+new_row_number+'][item]\" style=\"width: 100%\" required=\"required\">\
                            <option value=\"\"></option>\
                            @foreach($stockItems as $item)\
                            <option value=\"{{ $item->id }}\"> {{ $item->name }}</option>\
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

<script>
    $(document).ready(function(){
        $('#btnResetOpname').click(function(e){
            var new_row_number = 0;
            $('#itemName').val('');
            $('#qty').val('');
            $('#category').val('');
            $('#category').val('');
            $('#photo').val('');
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#removeCategory').on('show.bs.modal', function(e){
            category = $('#qryCategory');
            $.ajax({
                url: "{{ action('ProductController@queryCategory') }}",
                type: "post", 
                data: {
                    _token: '{!! csrf_token() !!}',
                },
                success: function(response) {
                    category.empty();
                    $.each(response['data'],function(key,value){
                        category.append('<option value='+value['id']+'>'+value['name']+'</option>');
                    });
                },
                error: function(){

                }
            });
        });
    });
</script>


@endsection