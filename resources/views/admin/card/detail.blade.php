@extends('admin.layouts.iframe')

@section('content')
<form id="userForm" method="post" action="{{ route('admin.user.save', $coinId) }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">코인 {{ $title }}</h1>
            </div><!-- /.col -->
            <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                <button type="button" class="btn btn-primary btn-xs btnSave">설정저장</button>
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
                        <h3 class="card-title text-sm">코인정보</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" id="id" value="{{$coinId}}">
                        <!-- <div class="form-group row mb-0" id="divVendorId">
                            <label for="divPrevImage" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label" style="font-size:12px;">이미지</label>
                            <div class="col-sm-10">
                                <div class="bg-gray border border-danger" style="height: 100px;width: 100px;" name="divPrevImage" id="divPrevImage">
                                    <img name="imgPreview" id="imgPreview" @if($coin->image != "") src="{{$coin->image}}" @else src="https://via.placeholder.com/300/FFFFFF?text=%20" @endif style="width:100%; height:100%;" alt="">
                                    <input type="hidden" name="beforeImage" id="beforeImage" value="{{$coin->image}}">
                                </div>
                                <input type="file" name="fileImage" id="fileImage" style="opacity: 0;">
                            </div>
                        </div> -->
                        <div class="form-group row mb-0">
                            <label for="key" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">키워드<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="key" name="key" value="{{ $coin->key }}" placeholder="ID를 입력하세요" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="kor_name" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">이름<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="kor_name" name="kor_name" value="{{ $coin->kor_name }}" placeholder="이름을 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="sell_limit" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">구매제한<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="number" step="0.01" max="100" class="form-control form-control-sm" id="sell_limit" name="sell_limit" value="{{ $coin->sell_limit }}" placeholder="이름을 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">사용상태<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6 mt-1">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use1" name="is_use" value="1" @if( $coin->is_use ) checked @endif>
                                    <label for="is_use1" class="custom-control-label pt-1" style="font-size:12px;" >사용</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use2" name="is_use" value="0" @if( !$coin->is_use ) checked @endif>
                                    <label for="is_use2" class="custom-control-label pt-1" style="font-size:12px;">차단</label>
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
<script src="{{asset('admin_assets/js/coin/coin.js')}}"></script>   
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
                var txtName = $("#kor_name").val();
                if(txtName == ""){
                    alert('이름을 입력해주세요!');
                    return false;
                }
                var str_id = $("#str_id").val();
                if(str_id == ""){
                    alert('아이디를 입력해주세요!');
                    return false;
                }
                
                var rdoIsUsed = $("input[name='is_use']:checked").val();
                if(rdoIsUsed == undefined){
                    alert('사용상태를 선택해주세요!');
                    return false;
                }
                var referer = $("#referer").val();
                var coinId = $("#id").val();
                action = "/admin/coin/edit/"+coinId;
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
            
            $('body').on('click', '.btnClose', function () {
                window.close();
            });
            
        });	  
    </script>
@endsection

