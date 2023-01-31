@extends('admin.layouts.app')
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
                    <li class="breadcrumb-item"><a href="#">회원관리</a></li>
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
                        
                        <ul class="nav float-right">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <!-- <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >새로 등록</a> -->
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" >
                        <form id="divUserForm">
                            <table id="levelTable" class="table  table-hover table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                
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
        var table = $('#levelTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            scrollY: "100%",
            ajax: {
                url: "{{ route('admin.user.level_list') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "이름", data: 'name', name: 'name'},
                {title: "지급요율(%)", data: 'pay_percent', name: 'pay_percent'},
                {title: "레벨업금액", data: 'levelup_amount', name: 'levelup_amount'},
                {title: "최소구매금액", data: 'min_limit', name: 'min_limit'},
                {title: "최대구매금액", data: 'max_limit', name: 'max_limit', className: "text-center"},
                {title: "구매가능", data: 'can_buy', name: 'can_buy', className: "text-right", width: '50px'},
                {title: "조작", data: 'action', name: 'action', orderable:false, searchable: false, className: "text-center", width: '80px'},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
        $('body').on('click', '.btnEdit', function () {
            var coinId = $(this).attr('data-id');
            window.open('/admin/user/level_edit/' + coinId, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('change', '.chk-can-buy', function () {
            var status = $(this).is(':checked') ? 1 : 0;
            if(!confirm('구매가능상태를 변경하시겠습니까?')){$(this).prop('checked', status == 1 ? false : true);return}
            var coinId = $(this).attr('data-id');
            var action = '/admin/user/level_buy_state/' + coinId;
            
            $.ajax({
                url: action,
                data: {status},
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        alert('구매가능상태가 변경되었습니다.');
                    }else{
                        alert('구매가능상태 변경에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });
        $('body').on('click', '.btnDelete', function () {
            if(!confirm('한번삭제한 등급정보는 되살릴수 없습니다. 정말삭제하시겠습니까?')){return}
            var coinId = $(this).attr('data-id');
            var action = '/admin/user/level_edit/' + coinId;
            $.ajax({
                url: action,
                data: {status},
                type: "DELETE",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        $('#levelTable').DataTable().ajax.reload();
                        alert('등급을 삭제하였습니다.');
                    }else{
                        alert('등급삭제에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });
        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/user/edit/0', '회원추가', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        function refreshTable() {
            $('#levelTable').DataTable().ajax.reload();
        }
    </script>
@endpush