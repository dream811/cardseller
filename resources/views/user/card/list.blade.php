@extends('user.layouts.app')
@section('script')
{{-- <script src="{{asset('admin_assets/js/coin/coin.js')}}"></script> --}}
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item"><a href="#">#</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <table class="mx-2" style="padding:15px;">
        <tr>
            <td style="width:40px">
                <label>Category:</label>
            </td>
            <td style="width:120px">
                <style>
                    .select2-selection__rendered {
                        line-height: 27px !important;
                    }
                    .select2-container .select2-selection--single {
                        height: 31px !important;
                    }
                    .select2-selection__arrow {
                        height: 0px !important;
                    }
                </style>
                <select name="category" id="category" class="form-control select2bs4 " style="font-size:10px !important; width: 100%;"  required>
                    <option value="">==All==</option>

                    @foreach ($categories as $category)
                        <option value="{{$category->category}}" >{{$category->category}}</option>
                    @endforeach
                </select>
            </td>
            <td style="width:40px; padding-left:10px">
                <label>Bin:</label>
            </td>
            <td style="width:120px">
                <input type="text" class="form-control form-control-sm" id="bin" name="bin" value="">
            </td>
            <td style="width:40px; padding-left:10px">
                <label>Country:</label>
            </td>
            <td style="width:120px">
                <select name="country_id" id="country_id" class="form-control select2bs4 " style="font-size:10px !important; width: 100%;"  required>
                    <option value="">==All==</option>

                    @foreach ($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </td>
            <td style="width:40px; padding-left:10px">
                <label>State:</label>
            </td>
            <td style="width:120px">
                <select name="state_id" id="state_id" class="form-control select2bs4 " style="font-size:10px !important; width: 100%;"  required>
                    <option value="">==All==</option>
                </select>
            </td>
            <td style="width:40px; padding-left:10px">
                <label>City:</label>
            </td>
            <td style="width:120px">
                <select name="city" id="city" class="form-control select2bs4 " style="font-size:10px !important; width: 100%;"  required>
                    <option value="">==All==</option>
                </select>
            </td>
            <td style="width:40px; padding-left:10px">
                <label>Zip:</label>
            </td>
            <td style="width:120px">
                <input type="text" class="form-control form-control-sm" id="zip" name="zip" value="">
            </td>
            <td style="width:40px; padding-left:10px">
                <label>Type:</label>
            </td>
            <td style="width:120px">
                <select name="type" id="type" class="form-control select2bs4 " style="font-size:10px !important; width: 100%;"  required>
                    <option value="">==All==</option>
                    <option value="AMERICAN_EXPRESS">AMERICAN_EXPRESS</option>
                    <option value="MASTER_CARD">MASTER_CARD</option>
                    <option value="VISA_CARD">VISA</option>
                    <option value="DISCOVER">DISCOVER</option>
                </select>
            </td>
            <td style="width: auto">
                <button class="btn btn-sm btn-primary btnSearch float-right">Search</button>
            </td>
        </tr>
    </table>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <!-- <ul class="nav float-right">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >N</a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="card-body" >
                        <form id="divCardForm">
                            <table id="cardTable" class="table  table-hover table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                
                            </table>
                        </form>
                    </div>
                        
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
@push('page_scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });	
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        var table = $('#cardTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "640px",
            pageLength: 100,
            // fixedHeader: true,
            ajax: {
                url: "{{ route('user.card') }}",
                data: function ( d ) {
                    d.category = $('#category').val();
                    d.bin = $('#bin').val();
                    d.country_id = $('#country_id').val();
                    d.state_id = $('#state_id').val();
                    d.city = $('#city').val();
                    d.zip = $('#zip').val();
                    d.type = $('#type').val();
                }
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "Type", data: 'type', name: 'type', width:"40px", orderable:false, searchable: false, },
                {title: "Bin", data: 'bin', name: 'bin'},
                {title: "Exp Date", data: 'exp_date', name: 'exp_date'},
                {title: "Category", data: 'category', name: 'category'},
                {title: "Country", data: 'country_id', name: 'country_id'},
                {title: "State", data: 'state_id', name: 'state_id'},
                {title: "City", data: 'city', name: 'city'},
                {title: "Zip", data: 'zip', name: 'zip'},
                {title: "Action/Result", data: 'action', name: 'action', orderable:false, searchable: false, width: "40px", className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#coinTable_wrapper .col-md-6:eq(0)');
        // $('body').on('click', '.btnEdit', function () {
        //     var coinId = $(this).attr('data-id');
        //     window.open('/admin/coin/edit/' + coinId, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
        //     return false;
        // });
        $('body').on('click', '.btnSearch', function () {
            refreshTable();
        });
        $('body').on('click', '.btnEdit', function () {
            
            if(!confirm('You want to buy this card?')){return}
            var card = $(this);
            var cardId = $(this).attr('data-id');
            var action = '/card/' + cardId;
            
            $.ajax({
                url: action,
                data: {status},
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        card.parent().css("color", "blue")
                        card.parent().html(data)
                    }else{
                        card.parent().css("color", "red")
                        card.parent().html(data)
                    }
                },
                error: function (data) {
                    card.parent().css("color", "red")
                    card.parent().html('You must buy more credit to get this card')
                }
            });
        });
        $('#country_id').change(function(){ 
            
            var country_id = $(this).val();
            $('#state_id').html('<option value="">==All==</option>');
            $('#city').html('<option value="">==All==</option>');
            if(country_id == 0) {
                return;
            }
            var action = '/search_state/'+country_id;
            $.ajax({
                url: action,
                data: {},
                type: "GET",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        $('#state_id').html('<option value="">==All==</option>');
                        data.forEach( (element, index) => {
                            $('#state_id').append(`<option value="${element.id}"> 
                                    ${element.name} 
                                </option>`); 
                        });
                    }
                },
                error: function (data) {

                }
            });
        });
        $('#state_id').change(function(){ 
            
            var state_id = $(this).val();
            $('#city').html('<option value="">==All==</option>');
            if(country_id == 0) {
                return;
            }
            var action = '/search_city/'+state_id;
            $.ajax({
                url: action,
                data: {},
                type: "GET",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        $('#city').html('<option value="">==All==</option>');
                        data.forEach( (element, index) => {
                            $('#city').append(`<option value="${element.city}"> 
                                    ${element.city} 
                                </option>`); 
                        });
                    }
                },
                error: function (data) {

                }
            });
        });
        function refreshTable() {
            $('#cardTable').DataTable().ajax.reload();
        }
        
    </script>
@endpush