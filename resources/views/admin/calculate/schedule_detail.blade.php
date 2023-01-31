@extends('admin.layouts.iframe')
@section('content')
<form id="userForm" method="post" action="{{ route('admin.user.save', $id) }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">정산일정 {{ $title }}</h1>
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
                                    <img name="imgPreview" id="imgPreview" @if($schedule->image != "") src="{{$schedule->image}}" @else src="https://via.placeholder.com/300/FFFFFF?text=%20" @endif style="width:100%; height:100%;" alt="">
                                    <input type="hidden" name="beforeImage" id="beforeImage" value="{{$schedule->image}}">
                                </div>
                                <input type="file" name="fileImage" id="fileImage" style="opacity: 0;">
                            </div>
                        </div> -->
                        <div class="form-group row mb-0">
                            <label for="start_time" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">시작시간<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="start_time" name="start_time" value="{{ $schedule->start_time }}" placeholder="구매시작시간을 입력하세요" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="end_time" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">마감시간<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="end_time" name="end_time" value="{{ $schedule->end_time }}" placeholder="구매마감시간을 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="calculate_time" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">정산시간<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="calculate_time" name="calculate_time" value="{{ $schedule->calculate_time }}" placeholder="정산시간을 입력하세요">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">사용상태<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6 mt-1">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use1" name="is_use" value="1" @if( $schedule->is_use ) checked @endif>
                                    <label for="is_use1" class="custom-control-label pt-1" style="font-size:12px;" >사용</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="is_use2" name="is_use" value="0" @if( !$schedule->is_use ) checked @endif>
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
                var start_time = $("#start_time").val();
                if(start_time == ""){
                    alert('구매시작시간을 입력해주세요!');
                    return false;
                }
                var end_time = $("#end_time").val();
                if(end_time == ""){
                    alert('구매마감시간을 입력해주세요!');
                    return false;
                }
                var calculate_time = $("#calculate_time").val();
                if(calculate_time == ""){
                    alert('정산시간을 입력해주세요!');
                    return false;
                }
                var rdoIsUsed = $("input[name='is_use']:checked").val();
                if(rdoIsUsed == undefined){
                    alert('사용상태를 선택해주세요!');
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

