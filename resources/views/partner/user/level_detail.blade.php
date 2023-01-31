@extends('admin.layouts.iframe')
@section('content')
<form id="userForm" method="post" action="{{ route('admin.user.save', $levelId) }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">등급 {{ $title }}</h1>
            </div><!-- /.col -->
            <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                <button type="submit" class="btn btn-primary btn-xs btnSave">설정저장</button>
                <button type="button" class="btn bg-indigo btn-xs btnClose">닫기</button>
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
                        <h3 class="card-title text-sm">등급정보</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" id="id" value="{{$levelId}}">
                        <!-- <div class="form-group row mb-0">
                            <label for="key" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">순위<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="key" name="key" value="{{ $level->level }}" placeholder="" autocomplete="off">
                            </div>
                        </div> -->
                        <div class="form-group row mb-0">
                            <label for="name" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">이름<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $level->name }}" placeholder="ID를 입력하세요" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="pay_percent" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">지급요율<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="pay_percent" name="pay_percent" value="{{ $level->pay_percent }}" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="levelup_amount" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">레벨업금액<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="number" step="1" class="form-control form-control-sm" id="levelup_amount" name="levelup_amount" value="{{ $level->levelup_amount }}" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="min_limit" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">최소구매금액<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="number" step="1" class="form-control form-control-sm" id="min_limit" name="min_limit" value="{{ $level->min_limit }}" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="max_limit" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">최대구매금액<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="number" step="1" class="form-control form-control-sm" id="max_limit" name="max_limit" value="{{ $level->max_limit }}" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">구매가능<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6 mt-1">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="can_buy1" name="can_buy" value="1" @if( $level->can_buy ) checked @endif>
                                    <label for="can_buy1" class="custom-control-label pt-1" style="font-size:12px;" >가능</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="can_buy2" name="can_buy" value="0" @if( !$level->can_buy ) checked @endif>
                                    <label for="can_buy2" class="custom-control-label pt-1" style="font-size:12px;">불가</label>
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
                //var data = $('#divProductForm').serialize();
                var txtName = $("#name").val();
                if(txtName == ""){
                    alert('이름을 입력해주세요!');
                    return false;
                }
                var pay_percent = $("#pay_percent").val();
                if(pay_percent <= 0 ){
                    alert('지급요율을 입력해주세요!');
                    return false;
                }
                var levelup_amount = $("#levelup_amount").val();
                if(levelup_amount <= 0 ){
                    alert('레벨업금액을 입력해주세요!');
                    return false;
                }
                var min_limit = $("#min_limit").val();
                if(pay_percent <= 0 ){
                    alert('지급요율을 입력해주세요!');
                    return false;
                }
                var max_limit = $("#max_limit").val();
                if(pay_percent <= 0 ){
                    alert('지급요율을 입력해주세요!');
                    return false;
                }
                var can_buy = $("input[name='can_buy']:checked").val();
                if(can_buy == undefined){
                    alert('구매상태를 선택해주세요!');
                    return false;
                }
                
                var levelId = $("#id").val();
                action = "/admin/user/level_edit/"+levelId;
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
                            alert("성공적으로 등록되었습니다");
                            //$('#beforeImage').val(data.image);
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

