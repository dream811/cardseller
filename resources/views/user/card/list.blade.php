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
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <!-- <ul class="nav float-right">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >N</a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="card-body" >
                        <form id="divCardForm">
                            <table id="cardTable" class="table  table-hover table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                
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
                url: "{{ route('user.card') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "Type", data: 'type', name: 'type', width:"40px", orderable:false, searchable: false, },
                {title: "Bin", data: 'bin', name: 'bin'},
                {title: "Exp Date", data: 'exp_date', name: 'exp_date'},
                {title: "Category", data: 'category', name: 'category'},
                {title: "Country", data: 'country_id', name: 'country_id'},
                {title: "State", data: 'state_id', name: 'state_id'},
                {title: "City", data: 'city', name: 'city'},
                {title: "Zip", data: 'zip', name: 'zip'},
                {title: "Action/Result", data: 'action', name: 'action', orderable:false, searchable: false, width: "40px", className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#coinTable_wrapper .col-md-6:eq(0)');
        // $('body').on('click', '.btnEdit', function () {
        //     var coinId = $(this).attr('data-id');
        //     window.open('/admin/coin/edit/' + coinId, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
        //     return false;
        // });
        
        $('body').on('click', '.btnEdit', function () {
            
            if(!confirm('You want to buy this card?')){return}
            var card = $(this);
            var cardId = $(this).attr('data-id');
            var action = '/card/' + cardId;
            
            $.ajax({
                url: action,
                data: {status},
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        card.parent().css("color", "blue")
                        card.parent().html(data)
                    }else{
                        card.parent().css("color", "red")
                        card.parent().html(data)
                    }
                },
                error: function (data) {
                    card.parent().css("color", "red")
                    card.parent().html('You must buy more credit to get this card')
                }
            });
        });
        function refreshTable() {
            $('#cardTable').DataTable().ajax.reload();
        }
        
    </script>
@endpush