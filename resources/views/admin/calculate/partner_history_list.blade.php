@extends('admin.layouts.iframe')
@section('content')
<div class="">
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
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <!-- <ul class="nav float-right">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >새로 등록</a>
                            </li>
                        </ul> -->
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
        var table = $('#tradingTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "550px",
            pageLength: 100,
            
            ajax: {
                url: "{{ route('admin.calculate.partner_history', [$id, $fromDate, $toDate]) }}",
                data: function ( d ) {
                    // d.txtFrom   = '{{$fromDate}}';
                    // d.txtTo     = '{{$toDate}}';
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
       
        function refreshTable(){
            $('#tradingTable').DataTable().ajax.reload();
        }
    </script>
@endpush