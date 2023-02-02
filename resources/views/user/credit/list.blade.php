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

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header pt-1 border-bottom-0" style="margin:auto;">
                        <ul class="nav " id="coin_body">
                            <li class=" pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-warning btnNew" style="width:150px;" data-id="BTC">BTC</a>
                            </li>
                            <li class=" pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-primary btnNew" style="width:150px;" data-id="LTC">LTC</a>
                            </li>
                            <li class=" pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-danger btnNew" style="width:150px;" data-id="DOGE">DOGE</a>
                            </li>
                        </ul>
                        <div class="bg-lightgray rounded text-center p-2 card card-danger card-outline d-none" id="pay_body">
                            <div class="well well-lg">
                                <span style="font-size: large">
                                    Type: <span id="coin_type">Bitcoin</span><br>Rate: $<span id="coin_price">23645</span> (<span id="coin_fee">10</span>% fee)<br>
                                    <span style="font-size: x-large" id="wallet_address">Address: 3294Jxjcg5YEztvTA56MFZkTUd4JbabV2k</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" >
                        <form id="divCardForm">
                            <table id="cardTable" class="table  table-hover table-bordered table-striped projects" cellspacing="0" width="100%">
                                
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
        var table = $('#cardTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "640px",
            pageLength: 100,
            // fixedHeader: true,
            ajax: {
                url: "{{ route('user.credit') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, width:'40px', 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "Status", data: 'status', name: 'status', width:"40px", className: "text-center"},
                {title: "Date", data: 'created_at', name: 'created_at', width:'80px', className: "text-center"},
                {title: "Wallet", data: 'wallet_address', name: 'wallet_address'},
                {title: "Amount", data: 'amount', name: 'amount', width:'80px', render(data){ return data ? data.toFixed(2) : '0.00';}},
                {title: "Action/Result", data: 'action', name: 'action', orderable:false, searchable: false, width: "40px", className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#coinTable_wrapper .col-md-6:eq(0)');
        // $('body').on('click', '.btnEdit', function () {
        //     var coinId = $(this).attr('data-id');
        //     window.open('/admin/coin/edit/' + coinId, '', 'scrollbars=1, resizable=1, width=1000, height=620');
        //     return false;
        // });
        $('body').on('click', '.btnCheck', function () {
            refreshTable();
        });
        $('body').on('click', '.btnNew', function () {
            
            var card = $(this);
            var coinType = $(this).attr('data-id');
            var action = '/credit/' + coinType;
            
            $.ajax({
                url: action,
                data: {status},
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        //card.parent().css("color", "blue")
                        $('#coin_body').addClass('d-none');
                        $('#pay_body').removeClass('d-none');
                        $('#coin_type').html(data.coin_type);
                        $('#coin_price').html(data.coin_price);
                        $('#coin_fee').html(data.fee);
                        $('#wallet_address').html(data.wallet_address);
                        //card.parent().html(data)
                    }else{
                        alert(data);
                    }
                },
                error: function (data) {
                    card.parent().css("color", "red")
                    card.parent().html('error, try again later')
                }
            });
        });
        function refreshTable() {
            $('#cardTable').DataTable().ajax.reload();
        }
        
    </script>
@endpush