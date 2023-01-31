@extends('admin.layouts.app')
@section('script')
<script src="{{asset('admin_assets/js/coin/coin.js')}}"></script>
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
                        <!-- <ul class="nav float-right">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >새로 등록</a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="card-body" >
                        <form id="divCoinForm">
                            <table id="coinTable" class="table  table-hover table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                
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
        var table = $('#coinTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "640px",
            pageLength: 100,
            // fixedHeader: true,
            ajax: {
                url: "{{ route('admin.coin.list') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "이미지", data: 'image', name: 'image', width:"40px", orderable:false, searchable: false, },
                {title: "코인명", data: 'kor_name', name: 'kor_name'},
                {title: "아이디", data: 'key', name: 'key'},
                {title: "구매제한(%)", data: 'sell_limit', name: 'sell_limit'},
                {title: "사용상태", data: 'is_use', name: 'is_use', orderable:false, width: "50px", searchable: false},
                {title: "조작", data: 'action', name: 'action', orderable:false, searchable: false, width: "40px", className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#coinTable_wrapper .col-md-6:eq(0)');
        $('body').on('click', '.btnEdit', function () {
            var coinId = $(this).attr('data-id');
            window.open('/admin/coin/edit/' + coinId, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        
        // $('body').on('change', '.chk-is-use', function () {
        //     var status = $(this).is(':checked') ? 1 : 0;
        //     if(!confirm('사용상태를 변경하시겠습니까?')){$(this).prop('checked', status == 1 ? false : true);return}
        //     var coinId = $(this).attr('data-id');
        //     var action = '/admin/coin/state/' + coinId;
            
        //     $.ajax({
        //         url: action,
        //         data: {status},
        //         type: "POST",
        //         dataType: 'json',
        //         success: function ({status, data}) {
        //             if(status == "success"){
        //                 alert('사용상태가 변경되었습니다.');
        //             }else{
        //                 alert('사용상태 변경에 실패하였습니다.');
        //             }
        //         },
        //         error: function (data) {
        //         }
        //     });
        // });
        function refreshTable() {
            $('#coinTable').DataTable().ajax.reload();
        }
        
    </script>
@endpush