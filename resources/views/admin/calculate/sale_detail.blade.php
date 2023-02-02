@extends('admin.layouts.iframe')
@section('content')
<form id="userForm" method="post" action="{{ route('admin.user.save', $id) }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">Sale {{ $title }}</h1>
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
                        <h3 class="card-title text-sm">정산일정</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" id="id" value="{{$id}}">
                        <!-- <div class="form-group row mb-0" id="divVendorId">
                            <label for="divPrevImage" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label" style="font-size:12px;">이미지</label>
                            <div class="col-sm-10">
                                <div class="bg-gray border border-danger" style="height: 100px;width: 100px;" name="divPrevImage" id="divPrevImage">
                                    <img name="imgPreview" id="imgPreview" @if($trading->image != "") src="{{$trading->image}}" @else src="https://via.placeholder.com/300/FFFFFF?text=%20" @endif style="width:100%; height:100%;" alt="">
                                    <input type="hidden" name="beforeImage" id="beforeImage" value="{{$trading->image}}">
                                </div>
                                <input type="file" name="fileImage" id="fileImage" style="opacity: 0;">
                            </div>
                        </div> -->
                        <div class="form-group row mb-0">
                            <label for="start_time" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">회원명<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                                <select class="form-control form-control-sm select2" name="receiver_id" id="receiver_id" style="width: 100%;">
                                    @foreach($users as $key => $user)
                                        <option @if($trading->user_id == $user->id) selected @endif value="{{$user->id}}">{{$user->str_id}}-{{$user->name}}-{{$user->nickname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="coin_type" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">코인종목<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                                <select class="form-control form-control-sm select2" name="receiver_id" id="receiver_id" style="width: 100%;">
                                    @foreach($coins as $key => $coin)
                                        <option @if($trading->coin_type == $coin->key) selected @endif value="{{$coin->key}}">{{$coin->key}}-{{$coin->kor_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="created_at" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">구매시간<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="created_at" name="created_at" value="{{ $trading->created_at }}" placeholder="구매시간을 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="order_amount" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">구매금액<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="order_amount" name="order_amount" value="{{ $trading->order_amount }}" placeholder="구매금액을 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="cur_price" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">구매시가<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="cur_price" name="cur_price" value="{{ $trading->cur_price }}" placeholder="구매시가를 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">상태<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6 mt-1">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use0" name="is_use" value="2" @if( $trading->is_use == 2 ) checked @endif>
                                    <label for="is_use0" class="custom-control-label pt-1" style="font-size:12px;" >적특</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use1" name="is_use" value="1" @if( $trading->is_use == 1 ) checked @endif>
                                    <label for="is_use1" class="custom-control-label pt-1" style="font-size:12px;" >정산</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use2" name="is_use" value="0" @if( !$trading->is_use ) checked @endif>
                                    <label for="is_use2" class="custom-control-label pt-1" style="font-size:12px;">구매</label>
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
            $('#start_time').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 1,
                timePickerSeconds: true,
                locale: {
                    format: 'HH:mm:ss'
                }
            }).on('show.daterangepicker', function (ev, picker) {
                picker.container.find(".calendar-table").hide();
            });
            
            $('#end_time').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 1,
                timePickerSeconds: true,
                locale: {
                    format: 'HH:mm:ss'
                }
            }).on('show.daterangepicker', function (ev, picker) {
                picker.container.find(".calendar-table").hide();
            });

            $('#calculate_time').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 1,
                timePickerSeconds: true,
                locale: {
                    format: 'HH:mm:ss'
                }
            }).on('show.daterangepicker', function (ev, picker) {
                picker.container.find(".calendar-table").hide();
            });
            //설정 보관
            // $('body').on('click', '.btnSave', function () {
            $('#userForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                //var data = $('#divProductForm').serialize();
                var created_at = $("#created_at").val();
                if(created_at == ""){
                    alert('구매시간을 입력해주세요!');
                    return false;
                }
                var order_amount = $("#order_amount").val();
                if(order_amount == ""){
                    alert('구매금액을 입력해주세요!');
                    return false;
                }
                var cur_price = $("#cur_price").val();
                if(cur_price == ""){
                    alert('시가를 입력해주세요!');
                    return false;
                }
                var cur_price = $("#coin").val();
                if(cur_price == ""){
                    alert('시가를 입력해주세요!');
                    return false;
                }
                var rdoIsUsed = $("input[name='is_use']:checked").val();
                if(rdoIsUsed == undefined){
                    alert('상태를 선택해주세요!');
                    return false;
                }
                
                var scheduleId = $("#id").val();
                action = "/admin/calculate/schedule_edit/"+scheduleId;
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

