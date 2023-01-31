@extends('admin.layouts.iframe')
@section('content')
<div class="content-wrapper iframe-mode" style="margin-left:0px;" data-widget="iframe" data-loading-screen="850">
	<div class="tab-content">
		<div>
			<!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="">회원목록</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">관리자</a></li>
                            <li class="breadcrumb-item"><a href="#">회원관리</a></li>
                            <li class="breadcrumb-item active">회원목록</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                
                                <ul class="nav float-right">
                                    <li class="pull-right float-right pr-1 pt-1" style="">
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >새로 등록</a>
                                    </li>
                                </ul>
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
            </div>
        </div>
		
	</div>
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
                url: "{{ route('admin.user.list') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "이름", data: 'name', name: 'name'},
                {title: "메일", data: 'email', name: 'email'},
                {title: "전화번호", data: 'phone', name: 'phone'},
                {title: "예치금", data: 'money', name: 'money'},
                {title: "등급", data: 'level', name: 'level', className: "text-center"},
                {title: "사용상태", data: 'state', name: 'state', className: "text-right"},
                {title: "조작", data: 'action', name: 'action', orderable:false, searchable: false, className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#userTable_wrapper .col-md-6:eq(0)');
        $('body').on('click', '.btnEdit', function () {
            var userId = $(this).attr('data-id');
            window.open('/admin/user/userManage/edit/' + userId, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/user/userManage/edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
    </script>
@endpush