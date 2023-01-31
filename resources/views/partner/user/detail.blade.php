@extends('admin.layouts.iframe')
@section('content')
<form id="userForm" method="post" action="{{ route('partner.user.save', $userId) }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">회원 {{ $title }}</h1>
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
                        <h3 class="card-title text-sm">계정정보</h3>
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
                            <label for="str_id" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">아이디<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="str_id" name="str_id" value="{{ $user->str_id }}" placeholder="ID를 입력하세요" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="mb_name" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">이름<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="mb_name" name="mb_name" value="{{ $user->name }}" placeholder="이름을 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="nickname" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">닉네임<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="" name="nickname" value="{{ $user->nickname }}" placeholder="닉네임 입력하세요">
                            </div>
                        </div>
                        @if ($userId > 0)
                        <hr>
                            <div class="form-group row mb-0">
                                <label for="password" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">비번변경</code></label>
                                <div class="col-sm-8 col-md-5">
                                    <input type="password" class="form-control form-control-sm" id="password" name="password" value="" placeholder="특수문자를 포함하여 8자리이상 입력하세요">
                                </div>
                                <!-- <div class="col-sm-1 col-md-1">
                                    <button type="button" class="btn btn-danger btn-xs btnChangePassword">변경</button>
                                </div> -->
                            </div>
                        <hr>
                        @else
                            <div class="form-group row mb-0">
                                <label for="password" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">비번<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="password" class="form-control form-control-sm" id="password" name="password" value="" placeholder="특수문자를 포함하여 8자리이상 입력하세요">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="password_confirm" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">비번확인<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="password" class="form-control form-control-sm" id="password_confirm" name="password_confirm" value="" placeholder="비번을 확인하세요">
                                </div>
                            </div>
                        @endif
                        
                        <div class="form-group row mb-0">
                            <label for="email" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">메일<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ $user->email }}" placeholder="메일을 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="phone" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">휴대폰<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="tel" class="form-control form-control-sm" id="phone" name="phone" value="{{ $user->phone }}" placeholder="휴대폰번호를 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="money" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">예치금<code style="color:red !important;">[필수]</code></label>
                            
                            <div class="col-sm-5 col-md-3">
                            <input type="number" class="form-control form-control-sm" id="money" name="money" value="{{ $user->money }}" placeholder="예치금액을 입력하세요">
                            </div>
                            {{-- @if ($userId > 0)
                            <div class="col-sm-4 col-md-3">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-prepend">
                                        <button type="button" class="btn btn-sm btn-info btn-flat btnAddMoney">넣기</button>
                                    </span>
                                    <input type="number" class="form-control form-control-sm text-right" id="add_money" name="add_money" value="0">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm btn-info btn-flat btnSubMoney">빼기</button>
                                    </span>
                                </div>
                            </div>
                            @endif --}}
                        </div>
                        <div class="form-group row mb-0">
                            <label for="money" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">총입금액</label>
                            
                            <div class="col-sm-6 col-md-2 mt-2 text-right">
                            <span class="">{{ $user->deposit_sum }}원</span>
                            </div>
                            <label for="money" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">총출금액</label>
                            
                            <div class="col-sm-6 col-md-2 mt-1 text-right">
                            <span class="">{{ $user->withdraw_sum }}원</span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="money" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">총구매액</label>
                            
                            <div class="col-sm-6 col-md-2 mt-1 text-right">
                            <span class="">{{ $user->buy_sum }}원</span>
                            </div>
                            <label for="money" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">총배당액</label>
                            
                            <div class="col-sm-6 col-md-2 mt-1 text-right">
                            <span class="">{{ $user->profit_sum }}원</span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="level" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">등급<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                                <select class="custom-select form-control-border custom-select-sm" name="level" id="level">
                                    {{-- <option value="">= 선택 =</option>
                                    <option value="9" @if ( 9 == $user->level) selected @endif>관리자</option>
                                    <option value="1" @if ( 1 == $user->zs_level) selected @endif>신규</option>
                                    <option value="0" @if ( 0 == $user->level) selected @endif>일반</option> --}}
                                    <option value="1" @if ( 1 == $user->level) selected @endif>브론즈</option>
                                    <option value="2" @if ( 2 == $user->level) selected @endif>실버</option>
                                    <option value="3" @if ( 3 == $user->level) selected @endif>골드</option>
                                    <option value="4" @if ( 4 == $user->level) selected @endif>VIP</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="type" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">역할<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                                <select class="custom-select form-control-border custom-select-sm" name="type" id="type">
                                    
                                    <option value="ADMIN"   @if ( 'ADMIN' == $user->type) selected @endif>관리자</option>
                                    <option value="MANAGER" @if ( 'MANAGER' == $user->type) selected @endif>매니저</option>
                                    <option value="PARTNER" @if ( 'PARTNER' == $user->type) selected @endif>파트너</option>
                                    <option value="USER"    @if ( 'USER' == $user->type) selected @endif>회원</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">사용상태<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6 mt-1">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use1" name="is_use" value="1" @if( $user->is_use ) checked @endif>
                                    <label for="is_use1" class="custom-control-label pt-1" style="font-size:12px;" >사용</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use2" name="is_use" value="0" @if( !$user->is_use ) checked @endif>
                                    <label for="is_use2" class="custom-control-label pt-1" style="font-size:12px;">차단</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mb-0">
                            <label for="bank_id" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">은행명<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                                <select class="custom-select form-control-border custom-select-sm" name="bank_id" id="bank_id">
                                    @foreach($bank_list as $key => $bank)
                                        <option @if($bank->id == $user->bank_id) selected @endif value="{{$bank->id}}">{{$bank->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <label for="bank_user" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">예금주<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="bank_user" name="bank_user" value="{{ $user->bank_user }}" placeholder="예금주명을 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="bank_account" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">계좌번호<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="bank_account" name="bank_account" value="{{ $user->bank_account }}" placeholder="계좌번호를 입력하세요">
                            </div>
                        </div>
                        {{-- 
                            <div class="form-group row mb-0">
                                <label for="txtBusinessNumber" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">사업자등록번호<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessNumber" name="txtBusinessNumber" value="{{ $user->business_number }}" placeholder="예)123-12-12312">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessPhone" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업체전화번호<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessPhone" name="txtBusinessPhone" value="{{ $user->business_phone }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessType" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업태<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessType" name="txtBusinessType" value="{{ $user->business_type }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessKind" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업종<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessKind" name="txtBusinessKind" value="{{ $user->business_kind }}" placeholder="">
                                </div>
                            </div> 
                            <div class="form-group row mb-0">
                                <label for="mb_zip1" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">우편번호<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="mb_zip1" name="mb_zip1" value="{{ $user->mb_zip1 }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="mb_addr1" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업체주소<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="mb_addr1" name="mb_addr1" value="{{ $user->mb_addr1 }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="mb_addr2" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업체주소2</label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="mb_addr2" name="mb_addr2" value="{{ $user->mb_addr2 }}" placeholder="">
                                </div>
                            </div>
                        --}}
                        <div class="form-group row mb-0">
                            <label for="member_code" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">하부회원가입코드</label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="member_code" name="member_code" value="{{ $user->member_code }}" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="referer" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">추천인</label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="referer" name="referer" value="{{ $user->referer }}" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="rate" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">롤링요율<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-5 col-md-3">
                            <input type="number" step="0.01" max="100", min="0" class="form-control form-control-sm" id="rate" name="rate" value="{{ $user->rate }}" placeholder="">
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
                var str_id = $("#str_id").val();
                if(str_id == ""){
                    alert('아이디를 입력해주세요!');
                    return false;
                }
                var txtEmail = $("#email").val();
                if(txtEmail == ""){
                    alert('메일주소를 입력해주세요!');
                    return false;
                }
                
                if($("#id").val() > 0) 
                {

                }else{
                    var txtPWD1 = $("#password").val();
                    if(txtPWD1 == ""){
                        alert('비번을 입력해주세요!');
                        
                        return false;
                    }
                    const regex = new RegExp('(?=.*[A-Z])(?=.*[!@#\$&\*\^~%()])(?=.*[0-9])(?=.*[a-z].).{8,}');//^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*^])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}$
                    if(!regex.test(txtPWD1)){
                    //if(txtPWD1.length < 8){
                        alert('수자, 대소문자, 특수문자를 포함해서 8자이상이여야 합니다!');
                        return false;
                    }
                    var txtPWD2 = $("#password_confirm").val();
                    if(txtPWD1 != txtPWD2){
                        alert('비번이 일치하지 않습니다!');
                        return false;
                    }
                }
                

                var txtPhone = $("#phone").val();
                if(txtPhone == ""){
                    alert('휴대폰번호를 입력해주세요!');
                    return false;
                }
                var txtMoney = $("#money").val();
                if(txtMoney == ""){
                    alert('예치금을 입력해주세요!');
                    return false;
                }
                var sc_level = $("#level option:selected").val();
                if(sc_level == ""){
                    alert('등급을 선택해주세요!');
                    return false;
                }

                var rdoIsUsed = $("input[name='is_use']:checked").val();
                if(rdoIsUsed == undefined){
                    alert('사용상태를 선택해주세요!');
                    return false;
                }
                var txtNickName = $("#nickname").val();
                if(txtNickName == ""){
                    alert('닉네임을 입력해주세요!');
                    return false;
                }
                var bank_id = $("#bank_id option:selected").val();
                if(bank_id == ""){
                    alert('은행명을 입력해주세요!');
                    return false;
                }
                
                var bank_user = $("#bank_user").val();
                if(bank_user == ""){
                    alert('예금주를 입력해주세요!');
                    return false;
                }

                var bank_account = $("#bank_account").val();
                if(bank_account == ""){
                    alert('계좌번호를 입력해주세요!');
                    return false;
                }

                var rate = $("#rate").val();
                if(rate == ""){
                    alert('롤링요율을 입력해주세요!');
                    return false;
                }
                // var txtBusinessNumber = $("#txtBusinessNumber").val();
                // if(txtBusinessNumber == ""){
                //     alert('사업자등록번호를 입력해주세요!');
                //     return false;
                // }
                // var txtBusinessPhone = $("#txtBusinessPhone").val();
                // if(txtBusinessPhone == ""){
                //     alert('업체전화번호를 입력해주세요!');
                //     return false;
                // }

                // var txtBusinessType = $("#txtBusinessType").val();
                // if(txtBusinessType == ""){
                //     alert('업태를 입력해주세요!');
                //     return false;
                // }
                // var txtBusinessKind = $("#txtBusinessKind").val();
                // if(txtBusinessKind == ""){
                //     alert('업종을 입력해주세요!');
                //     return false;
                // }
                // var txtBusinessZip = $("#mb_zip1").val();
                // if(txtBusinessZip == ""){
                //     alert('우편번호를 입력해주세요!');
                //     return false;
                // }

                // var txtBusinessAddress1 = $("#mb_addr1").val();
                // if(txtBusinessAddress1 == ""){
                //     alert('주소를 입력해주세요!');
                //     return false;
                // }
                var referer = $("#referer").val();
                var userId = $("#id").val();
                var action ="/admin/user/check";
                if(userId != 0){
                    action = "/partner/user/edit/"+userId;
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
                        data: {str_id, email: txtEmail, referer },
                        type: "POST",
                        dataType: "json",
                        success: function({status, data}){
                            //console.log(data);
                            if(status == "success"){
                                if(data.email_check == 0){
                                    alert('중복된 메일이 존재합니다.');
                                    return;
                                }
                                if(data.referer_check == 0){
                                    alert('추천인코드가 정확하지 않습니다.');
                                    return;
                                }
                                if(data.str_id == 0){
                                    alert('현재 아이디를 사용할수 없습니다');
                                    return;
                                }

                                action = "/partner/user/edit/"+userId;
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
                                            $('#beforeImage').val(data.image);
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

