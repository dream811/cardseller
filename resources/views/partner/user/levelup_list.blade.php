@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="">레벨업회원</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">관리자</a></li>
                    <li class="breadcrumb-item"><a href="#">회원관리</a></li>
                    <li class="breadcrumb-item active">레벨업회원</li>
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
                        <form id="divUserForm">
                            <table id="userTable" class="table  table-hover table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                
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
        var table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            scrollY: "100%",
            ajax: {
                url: "{{ route('admin.user.levelup_list') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "이름", data: 'name', name: 'name'},
                {title: "메일", data: 'email', name: 'email'},
                {title: "전화번호", data: 'phone', name: 'phone'},
                {title: "은행명", data: 'bank_name', name: 'bank_name'},
                {title: "은행계좌", data: 'bank_account', name: 'bank_account'},
                {title: "예금주", data: 'bank_user', name: 'bank_user'},
                {title: "예치금", data: 'money', name: 'money'},
                {title: "구매금", data: 'buy_sum', name: 'buy_sum'},
                {title: "등급", data: 'level', name: 'level', className: "text-center"},
                {title: "상태", data: 'level_state', name: 'level_state', className: "text-center"},
                {title: "레벨업", data: 'levelup', name: 'levelup', className: "text-right", width: '60px'},
                // {title: "조작", data: 'action', name: 'action', orderable:false, searchable: false, className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#userTable_wrapper .col-md-6:eq(0)');
        $('body').on('click', '.btnEdit', function () {
            var userId = $(this).attr('data-id');
            window.open('/admin/user/edit/' + userId, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('change', '.chk-is-use', function () {
            var status = $(this).is(':checked') ? 1 : 0;
            if(!confirm('회원등급을 레벨업하시겠습니까?')){$(this).prop('checked', status == 1 ? false : true);return}
            var userId = $(this).attr('data-id');
            var action = '/admin/user/levelup/' + userId;
            
            $.ajax({
                url: action,
                data: {status},
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        refreshTable();
                        alert('회원등급을 레벨업하였습니다.');
                    }else{
                        alert('레벨업에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });
        $('body').on('click', '.btnConfirm', function () {
            var status = 1;
            if(!confirm('회원등급을 레벨업하시겠습니까?')){return;}
            var userId = $(this).attr('data-id');
            var action = '/admin/user/levelup/' + userId;
            
            $.ajax({
                url: action,
                data: {status},
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        refreshTable();
                        alert('회원등급을 레벨업하였습니다.');
                    }else{
                        alert('레벨업에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });
        $('body').on('click', '.btnCancel', function () {
            var status = 2;
            if(!confirm('회원레벨업을 취소하시겠습니까?')){return;}
            var userId = $(this).attr('data-id');
            var action = '/admin/user/levelup/' + userId;
            
            $.ajax({
                url: action,
                data: {status},
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        refreshTable();
                        alert('회원레벨업을 취소하였습니다.');
                    }else{
                        alert('레벨업취소에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });
        // $('body').on('click', '.btnDelete', function () {
        //     if(!confirm('한번삭제한 회원정보는 되살릴수 없습니다. 정말삭제하시겠습니까?')){return}
        //     var userId = $(this).attr('data-id');
        //     var action = '/admin/user/edit/' + userId;
        //     $.ajax({
        //         url: action,
        //         data: {status},
        //         type: "DELETE",
        //         dataType: 'json',
        //         success: function ({status, data}) {
        //             if(status == "success"){
        //                 $('#userTable').DataTable().ajax.reload();
        //                 alert('회원을 삭제하였습니다.');
        //             }else{
        //                 alert('회원삭제에 실패하였습니다.');
        //             }
        //         },
        //         error: function (data) {
        //         }
        //     });
        // });
        // $('body').on('click', '.btnAdd', function () {
        //     window.open('/admin/user/edit/0', '회원추가', 'scrollbars=1, resizable=1, width=1000, height=620');
        //     return false;
        // });
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
        function refreshTable() {
            $('#userTable').DataTable().ajax.reload();
        }
    </script>
@endpush