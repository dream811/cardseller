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
                    <li class="breadcrumb-item"><a href="#">설정관리</a></li>
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
                            <li class="pull-right float-right mx-3 pt-1" style="">
                                <button type="button" class="btn btn-success btn-sm btnSave" >Save</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" >
                        <form id="divSettingForm" method="POST" action="{{route('admin.setting.bank')}}">
                            @csrf
                            <div class="row col-12">
                                <label>APIRONE ACCOUNT</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <code style=""></code>
                                        <div class="input-group input-group-sm mb-2 mr-sm-2">
                                            <input type="text" id="apirone_account" name="apirone_account" value="{{$setting->apirone_account}}" class="form-control" placeholder="Apirone Account">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12">
                                <label>APIRONE TRANSFER KEY</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <code style=""></code>
                                        <div class="input-group input-group-sm mb-2 mr-sm-2">
                                            <input type="text" id="apirone_trans_key" name="apirone_trans_key" value="{{$setting->apirone_trans_key}}" class="form-control" placeholder="Apirone Transfer Key">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
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


        $('body').on('click', '.btnSave', function () {
            $('#divSettingForm').submit();
        });
        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/user/userManage/edit/0', '', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
    </script>
@endpush