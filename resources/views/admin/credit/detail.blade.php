@extends('admin.layouts.iframe')
@section('content')
<form id="userForm" method="post" action="{{ route('admin.credit.save', $id) }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">Card {{ $title }}</h1>
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
                        <input type="hidden" name="id" id="id" value="{{$id}}">
                        <div class="form-group row mb-0">
                            <label for="user" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">USER</label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="user" name="user" value="{{ $creditInfo->user->str_id }}" @if ($id > 0) readonly @endif autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="wallet_address" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Address</label>
                            <div class="col-sm-5 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="wallet_address" name="wallet_address" value="{{ $creditInfo->wallet_address }}" readonly>
                            </div>                            
                        </div>
                        <div class="form-group row mb-0">
                            <label for="coin_price" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Exchange rate</label>
                            <div class="col-sm-5 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="coin_price" name="coin_price" readonly value="{{ $creditInfo->coin_price }}">
                            </div>                            
                        </div>
                        <div class="form-group row mb-0">
                            <label for="amount" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Credit</label>
                            <div class="col-sm-5 col-md-6">
                            <input type="number" class="form-control form-control-sm" id="amount" name="amount" value="{{ $creditInfo->amount }}">
                            </div>                            
                        </div>
                        
                        <div class="form-group row mb-0">
                            <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Status<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6 mt-1">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="status1" name="status" value="OPENED" @if( $creditInfo->status == "OPENED" ) checked @endif>
                                    <label for="status1" class="custom-control-label pt-1" style="font-size:12px;" >OPENED</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="status2" name="status" value="PAID" @if( $creditInfo->status == "PAID" ) checked @endif>
                                    <label for="status2" class="custom-control-label pt-1" style="font-size:12px;">PAID</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="status3" name="status" value="CLOSED" @if( $creditInfo->status == "CLOSED" ) checked @endif>
                                    <label for="status3" class="custom-control-label pt-1" style="font-size:12px;">CLOSED</label>
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
            
            //
            // $('body').on('click', '.btnSave', function () {
            $('#userForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                
                var amount = $("#amount").val();
                if(amount <= 0){
                    alert('Please input amount!');
                    return false;
                }
                
                
                var rdoIsUsed = $("input[name='status']:checked").val();
                if(rdoIsUsed == undefined){
                    alert('Choose a status');
                    return false;
                }
                
                
                var id = $("#id").val();
                action = "/admin/credit/edit/"+id;
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
                            window.opener.refreshTable();
                            window.close();
                        }
                    },
                    error: function (data) {
                    }
                });
                
                
                
            });
            
            $('.btnClose').on('click', function (e) {
                window.close();
            });
            
        });	  
    </script>
@endsection

