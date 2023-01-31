@extends('admin.layouts.iframe')
@section('content')
<form id="userForm" method="post" action="{{ route('admin.user.save', $userId) }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">User {{ $title }}</h1>
            </div><!-- /.col -->
            <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                <button type="submit" class="btn btn-primary btn-xs btnSave">Save</button>
                <button type="button" class="btn bg-indigo btn-xs btnClose">Close</button>
            </div>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title text-sm">User Info</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" id="id" value="{{$userId}}">
                        <!-- <div class="form-group row mb-0" id="divVendorId">
                            <label for="divPrevImage" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label" style="font-size:12px;">이미지</label>
                            <div class="col-sm-10">
                                <div class="bg-gray border border-danger" style="height: 100px;width: 100px;" name="divPrevImage" id="divPrevImage">
                                    <img name="imgPreview" id="imgPreview" @if($user->mb_profile != "") src="{{$user->mb_profile}}" @else src="https://via.placeholder.com/300/FFFFFF?text=%20" @endif style="width:100%; height:100%;" alt="">
                                    <input type="hidden" name="beforeImage" id="beforeImage" value="{{$user->mb_profile}}">
                                </div>
                                <input type="file" name="fileImage" id="fileImage" style="opacity: 0;">
                            </div>
                        </div> -->
                        <div class="form-group row mb-0">
                            <label for="str_id" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">ID<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="str_id" name="str_id" value="{{ $user->str_id }}" placeholder="Please input a unique id" @if ($userId > 0) readonly @endif autocomplete="off">
                            </div>
                        </div>
                        
                        @if ($userId > 0)
                        <hr>
                            <div class="form-group row mb-0">
                                <label for="password" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Password</code></label>
                                <div class="col-sm-8 col-md-5">
                                    <input type="password" class="form-control form-control-sm" id="password" name="password" value="" placeholder="Please input a new password">
                                </div>                                
                            </div>
                        <hr>
                        @else
                            <div class="form-group row mb-0">
                                <label for="password" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Password<code style="color:red !important;">[*]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="password" class="form-control form-control-sm" id="password" name="password" value="" placeholder="Please type a new password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="password_confirm" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Password confirm<code style="color:red !important;">[*]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="password" class="form-control form-control-sm" id="password_confirm" name="password_confirm" value="" placeholder="Please confirm new password">
                                </div>
                            </div>
                        @endif
                        
                        
                        <div class="form-group row mb-0">
                            <label for="money" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Credit</label>
                            
                            <div class="col-sm-5 col-md-3">
                            <input type="number" class="form-control form-control-sm" id="money" name="money" value="{{ $user->money }}">
                            </div>
                            
                        </div>
                        
                        <div class="form-group row mb-0">
                            <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">State<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6 mt-1">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use1" name="is_use" value="0" @if( !$user->is_use ) checked @endif>
                                    <label for="is_use1" class="custom-control-label pt-1" style="font-size:12px;" >Block</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use2" name="is_use" value="1" @if( $user->is_use ) checked @endif>
                                    <label for="is_use2" class="custom-control-label pt-1" style="font-size:12px;">Enable</label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')    
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#divPrevImage').on('click', function (e) {
                $('#fileImage').trigger('click'); 
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imgPreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#fileImage").change(function() {
                readURL(this);
            });
            
            //설정 보관
            // $('body').on('click', '.btnSave', function () {
            $('#userForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                
                var str_id = $("#str_id").val();
                if(str_id == ""){
                    alert('Please input a user id!');
                    return false;
                }
                
                if($("#id").val() > 0) 
                {

                }else{
                    var txtPWD1 = $("#password").val();
                    if(txtPWD1 == ""){
                        alert('Please input a new password!');
                        
                        return false;
                    }
                    if(txtPWD1.length < 8){
                        alert('Must be at least 8 characters!');
                        return false;
                    }
                    var txtPWD2 = $("#password_confirm").val();
                    if(txtPWD1 != txtPWD2){
                        alert('Password didn\'t match!');
                        return false;
                    }
                }
                

                
                var rdoIsUsed = $("input[name='is_use']:checked").val();
                if(rdoIsUsed == undefined){
                    alert('Choose a state');
                    return false;
                }
                
                
                var userId = $("#id").val();
                var action ="/admin/user/check";
                if(userId != 0){
                    action = "/admin/user/edit/"+userId;
                    //formData.submit();
                    $.ajax({
                        url: action,
                        data: formData,
                        type: "POST",
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function ({status, data}) {
                            if(status="success"){
                                alert("Successfully updated!");
                                $('#beforeImage').val(data.image);
                                window.opener.refreshTable();
                                window.close();
                            }
                        },
                        error: function (data) {
                        }
                    });
                }else{
                    $.ajax({
                        url: action,
                        data: {str_id },
                        type: "POST",
                        dataType: "json",
                        success: function({status, data}){
                            //console.log(data);
                            if(status == "success"){

                                if(data.str_id == 0){
                                    alert('Successfully registered!');
                                    return;
                                }

                                action = "/admin/user/edit/"+userId;
                                //formData.submit();
                                $.ajax({
                                    url: action,
                                    data: formData,
                                    type: "POST",
                                    dataType: 'JSON',
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function ({status, data}) {
                                        if(status="success"){
                                            alert("Successfully registered!");
                                            // $('#beforeImage').val(data.image);
                                            window.opener.refreshTable();
                                            window.close();
                                        }
                                    },
                                    error: function (data) {
                                    }
                                });
                                
                            }
                        }
                    });
                }
                
                
            });
            
            $('.btnClose').on('click', function (e) {
                window.close();
            });
            
        });	  
    </script>
@endsection

