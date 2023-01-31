@extends('partner.layouts.app')
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
                    <li class="breadcrumb-item"><a href="#">관리자</a></li>
                    <li class="breadcrumb-item"><a href="#">정산관리</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
    <div class="row">
            <table class="ml-2">
                <thead style="height:40px; text-align: center;">
                    <tr style="width:100%; text-align: center;">
                        <th class="text-right" style="font-size:12px; width:70px;">날짜검색:</th>
                        <th style="font-size:12px; width:150px;">
                            <div style="display:inline-block">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm float-right txtCalendar" name="txtFrom" id="txtFrom"  value="{{$fromDate}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>
                            <!-- /.input group -->
                            </div>
                        </th>
                        <th style="font-size:12px;">~</th>
                        <th style="font-size:12px; width:150px;">
                            <div style="display:inline-block">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm float-right txtCalendar" name="txtTo" id="txtTo"  value="{{$toDate}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>
                            <!-- /.input group -->
                            </div>
                        </th>
                        <th width="120px;">
                            <button type="submit" class="btn btn-primary btn-xs btnSearch"><i class="fas fa-search"></i>검색</button>
                        </th>
                    </tr>  
                </thead>
            </table>
            
        </div>
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        
                    </div>
                    <div class="card-body" >
                        <form id="divScheduleForm">
                            <table id="tradingTable" class="table  table-hover table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                
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
        $('#txtFrom').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
            format: 'YYYY-MM-DD'
            },
            minYear: parseInt(moment().format('YYYY'),10)-1,
            // startDate: moment().subtract(29, 'days'),
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
        });
        $('#txtTo').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
            format: 'YYYY-MM-DD'
            },
            minYear: parseInt(moment().format('YYYY'),10)-1
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
            
        });
        var table = $('#tradingTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "550px",
            pageLength: 100,
            
            ajax: {
                url: "{{ route('partner.calculate.history_list') }}",
                data: function ( d ) {
                    d.txtFrom   = $('#txtFrom').val();
                    d.txtTo     = $('#txtTo').val();
                }
            },
            columns: [
                {title: "회원명", data: 'name', name: 'name', width: '150px',},
                {title: "충전금액", data: 'deposit_amt', name: 'deposit_amt', className: "text-right", render: $.fn.dataTable.render.number( ',', '.', 0, '' )},
                {title: "환전금액", data: 'withdraw_amt', name: 'withdraw_amt', className: "text-right", render: $.fn.dataTable.render.number( ',', '.', 0, '' )},
                {title: "베팅금액", data: 'ord_amt', name: 'ord_amt', className: "text-right", render: $.fn.dataTable.render.number( ',', '.', 0, '' )},
                {title: "배당금액", data: 'pay_amt', name: 'pay_amt', className: "text-right", render: $.fn.dataTable.render.number( ',', '.', 0, '' )},
                {title: "보유금액", data: 'money', name: 'money', className: "text-right", render: $.fn.dataTable.render.number( ',', '.', 0, '' )},
                {title: "손수익", data: 'profit_amt', name: 'profit_amt', className: "text-right", render: $.fn.dataTable.render.number( ',', '.', 0, '' )},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#coinTable_wrapper .col-md-6:eq(0)');

        $('body').on('click', '.btnSearch', function () {
            refreshTable();
        });

        function refreshTable(){
            $('#tradingTable').DataTable().ajax.reload();
        }
    </script>
@endpush