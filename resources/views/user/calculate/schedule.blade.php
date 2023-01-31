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
                    <li class="breadcrumb-item"><a href="#">코인관리</a></li>
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
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >새로 등록</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" >
                        <form id="divScheduleForm">
                            <table id="scheduleTable" class="table  table-hover table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                
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
        var table = $('#scheduleTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "100%",
            pageLength: 100,
            ajax: {
                url: "{{ route('admin.calculate.schedule_list') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "구매시작시간", data: 'start_time', name: 'start_time'},
                {title: "구매마감시간", data: 'end_time', name: 'end_time'},
                {title: "결제시간", data: 'calculate_time', name: 'calculate_time' },
                {title: "사용상태", data: 'chk-is-use', name: 'chk-is-use', width: '50px', orderable: false, searchable: false, className: "text-center"},
                {title: "조작", data: 'action', name: 'action', width: '80px', orderable: false, searchable: false, className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#coinTable_wrapper .col-md-6:eq(0)');
        $('body').on('click', '.btnEdit', function () {
            var id = $(this).attr('data-id');
            window.open('/admin/calculate/schedule_edit/' + id, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('change', '.chk-is-use', function () {
            var status = $(this).is(':checked') ? 1 : 0;
            if(!confirm('사용상태를 변경하시겠습니까?')){$(this).prop('checked', status == 1 ? false : true);return}
            var id = $(this).attr('data-id');
            var action = '/admin/calculate/schedule_state/' + id;
            
            $.ajax({
                url: action,
                data: {status},
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        alert('사용상태가 변경되었습니다.');
                    }else{
                        alert('사용상태 변경에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });
        $('body').on('click', '.btnDelete', function () {
            if(!confirm('한번삭제한 자료는 되살릴수 없습니다. 정말삭제하시겠습니까?')){return}
            var id = $(this).attr('data-id');
            var action = '/admin/calculate/schedule_edit/' + id;
            
            $.ajax({
                url: action,
                type: "DELETE",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        refreshTable();
                        alert('일정이 삭제되었습니다.');
                    }else{
                        alert('일정삭제에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });

        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/calculate/schedule_edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
        function refreshTable(){
            $('#scheduleTable').DataTable().ajax.reload();
        }
    </script>
@endpush