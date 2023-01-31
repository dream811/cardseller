@extends('user.layouts.app')
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
                    <li class="breadcrumb-item"><a href="#">*</a></li>
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
                                <button type="button" class="btn btn-success btn-sm btnSave" >보관</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" >
                        <form id="divUserForm" method="POST" action="{{route('admin.setting.guide')}}">
                            @csrf
                            <div class="form-group row mb-0">
                                <label for="str_id" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">ID</label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="str_id" name="str_id" value="{{ Auth::user()->str_id }}" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row mb-0">
                                <label for="password" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">New Password<code style="color:red !important;">[*]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="password" class="form-control form-control-sm" id="password" name="password" value="" placeholder="Please type your password">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <label for="password" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">New Password<code style="color:red !important;">[*]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="password" class="form-control form-control-sm" id="password_new" name="password_new" value="" placeholder="Please type your new password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="password_confirm" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Confirm Password<code style="color:red !important;">[*]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="password" class="form-control form-control-sm" id="password_confirm" name="password_confirm" value="" placeholder="Please confirm your password">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row mb-0">
                                <label for="money" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Credit</label>
                                <div class="col-sm-5 col-md-3">
                                <input type="number" class="form-control form-control-sm" id="money" name="money" value="{{ Auth::user()->money }}" readonly>
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
            var password = $('#password').val();
            var password_new = $('#password_new').val();
            var password_confirm = $('#password_confirm').val();

            if(password == ""){
                alert('Please input your current password.');
                return;
            }
            if(password_new == ""){
                alert('Please input your new password.');
                return;
            }
            if(password_new != password_confirm){
                alert('Passwords do not match!');
                return;
            }

            
            var action = '/check_password';
            //var data = $('#divProductForm').serialize();
            var data = { password }
            $.ajax({
                url: action,
                data: data,
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        var data = { password_new }
                        $.ajax({
                            url: "/change_password",
                            data: data,
                            type: "POST",
                            dataType: 'json',
                            success: function ({status, data}) {
                                if(status == "success"){
                                    alert(data.message);
                                    location.reload();
                                }else{
                                    alert(data.message);
                                }
                            },
                            error: function (data) {
                            }
                        });
                    }else{
                        alert(data.message);
                    }
                },
                error: function (data) {
                }
            });
        });

        
        
    </script>
@endpush


