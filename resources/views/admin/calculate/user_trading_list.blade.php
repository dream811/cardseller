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
            scrollY: "620px",
            pageLength: 100,
            ajax: {
                url: "{{ route('admin.calculate.user_trading_list', $userId) }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, width: '50px', 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "구매시간", data: 'created_at', name: 'created_at', width: '120px',},
                {title: "등급", data: 'level', name: 'level',width: '50px',},
                {title: "회원", data: 'user_info', name: 'user_info', },
                {title: "코인종목", data: 'coin_type', name: 'coin_type', orderable: false, searchable: false, className: "text-center"},
                {title: "매수가격", data: 'cur_price', name: 'cur_price', orderable: false, searchable: false, className: "text-center"},
                {title: "매수수량", data: 'coin_quantity', name: 'coin_quantity', orderable: false, searchable: false, className: "text-center"},
                {title: "배당율", data: 'payout_rate', name: 'payout_rate', orderable: false, searchable: false, className: "text-center"},
                {title: "총구매액", data: 'order_amount', name: 'order_amount',  orderable: false, searchable: false, className: "text-center"},
                {title: "상태", data: 'state_info', name: 'state_info',  orderable: false, searchable: false, className: "text-center"},
                {title: "조작", data: 'action', name: 'action', width: '140px', orderable: false, searchable: false, className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#coinTable_wrapper .col-md-6:eq(0)');
        $('body').on('click', '.btnEdit', function () {
            var id = $(this).attr('data-id');
            window.open('/admin/calculate/trading_edit/' + id, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('click', '.btnState', function () {
            var state = $(this).attr('data-state');
            if(!confirm('상태를 변경하시겠습니까?')){return}
            var id = $(this).attr('data-id');
            var action = '/admin/calculate/trading_state/' + id;
            
            $.ajax({
                url: action,
                data: {state},
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        alert('상태가 변경되었습니다.');
                    }else{
                        alert('상태 변경에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });
        $('body').on('click', '.btnDelete', function () {
            if(!confirm('한번삭제한 자료는 되살릴수 없습니다. 정말삭제하시겠습니까?')){return}
            var id = $(this).attr('data-id');
            var action = '/admin/calculate/trading_edit/' + id;
            
            $.ajax({
                url: action,
                type: "DELETE",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        refreshTable();
                        alert('성공적으로 삭제되었습니다.');
                    }else{
                        alert('삭제에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });

        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/calculate/trading_edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
        function refreshTable(){
            $('#tradingTable').DataTable().ajax.reload();
        }
        $('body').on('click', '.btnEditMember', function () {
            var id = $(this).attr('data-id');
            window.open('/admin/user/edit/'+id, '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
        $('body').on('click', '.btnGotoDeposit', function () {
            var id = $(this).attr('data-id');
            window.open('/admin/cash/user_cash/0/'+id, '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
        $('body').on('click', '.btnGotoWithdraw', function () {
            var id = $(this).attr('data-id');
            window.open('/admin/cash/user_cash/1/'+id, '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
        $('body').on('click', '.btnGotoTrading', function () {
            var id = $(this).attr('data-id');
            window.open('/admin/calculate/user_trading/'+id, '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
        $('body').on('click', '.btnGotoResult', function () {
            var id = $(this).attr('data-id');
            window.open('/admin/calculate/user_result/'+id, '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
    </script>
@endpush