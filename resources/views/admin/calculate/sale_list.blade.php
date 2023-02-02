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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Sale</a></li>
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
                            <table id="tradingTable" class="table  table-hover table-bordered table-striped projects " cellspacing="0" width="100%">
                                
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
                url: "{{ route('admin.calculate.sale_list') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, width: '50px', 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "User", data: 'user_info', name: 'user_info', },
                {title: "Info", data: 'info', name: 'info', orderable: false, searchable: false, className: "text-center"},
                {title: "Date", data: 'created_at', name: 'created_at',  orderable: false, searchable: false, className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#coinTable_wrapper .col-md-6:eq(0)');
        $('body').on('click', '.btnEdit', function () {
            var id = $(this).attr('data-id');
            window.open('/admin/calculate/sale_edit/' + id, 'Edit', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        
        $('body').on('click', '.btnDelete', function () {
            if(!confirm('You really want to delete?')){return}
            var id = $(this).attr('data-id');
            var action = '/admin/calculate/sale_edit/' + id;
            
            $.ajax({
                url: action,
                type: "DELETE",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        refreshTable();
                        alert('Successfully deleted.');
                    }else{
                        alert('Failed to delete.');
                    }
                },
                error: function (data) {
                }
            });
        });

        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/calculate/sale_edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
        function refreshTable(){
            $('#tradingTable').DataTable().ajax.reload();
        }
        
    </script>
@endpush