@extends('admin.layouts.iframe')
@section('content')
<form id="userForm" method="post" action="{{ route('admin.user.save', $id) }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">쪽지 {{ $title }}</h1>
            </div><!-- /.col -->
            <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                <button type="submit" class="btn btn-primary btn-xs btnSave">전송</button>
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
                        <h3 class="card-title text-sm">쪽지</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" id="id" value="{{$id}}">
                        
                        <div class="form-group row mb-0">
                            <label for="receiver_id" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">수신인<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <select class="form-control form-control-sm select2" name="receiver_id" id="receiver_id" style="width: 100%;">
                                @foreach($users as $key => $user)
                                    <option @if($msgInfo->receiver_id == $user->id) selected @endif value="{{$user->id}}">{{$user->str_id}}-{{$user->name}}-{{$user->nickname}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        @if($id == 0)
                        <div class="form-group row mb-0">
                            <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">전체<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6 mt-1">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="chk_all1" name="chk_all" value="all" >
                                    <label for="chk_all1" class="custom-control-label pt-1" style="font-size:12px;" >전체</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="chk_all2" name="chk_all" value="0"  checked >
                                    <label for="chk_all2" class="custom-control-label pt-1" style="font-size:12px;">개별</label>
                                </div>
                                @foreach($levels as $key=> $level)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="chk_all{{2 + $loop->iteration}}" name="chk_all" value="{{$level->level}}"  checked >
                                        <label for="chk_all{{2 + $loop->iteration}}" class="custom-control-label pt-1" style="font-size:12px;">{{$level->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="form-group row mb-0">
                            <label for="subject" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">제목<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="subject" name="subject" value="{{ $msgInfo->subject }}" placeholder="최대 50문자를 초과할수 없습니다" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="key" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">내용<code style="color:red !important;">[필수]</code></label>
                            <div class="col-sm-9 col-md-6">
                                <textarea name="content" id="content">
                                </textarea>
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
            
            $('.select2').select2({
            theme: 'bootstrap4'
            })

            $('#content').summernote({
                height: '300px',
                
                callbacks: {
                    onBlurCodeview: function() {
                        let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                        $(this).val(codeviewHtml);
                    },
                    onImageUpload: function(files, editor, welEditable) {
                        var url= sendFile(files, editor, welEditable);
                    },
                    onMediaDelete : function(target) {
                        //deleteSNImage(target[0].src);
                    }
                }
            });
            $('#content').summernote('code', {!! json_encode($msgInfo->content) !!});
            function sendFile(files, editor, welEditable) {
                data = new FormData();
                //data.append("file", file);
                var i = 0, len = files.length, img, reader, file;
                for (var i = 0; i < len; i++) {
                    file = files[i];
                    data.append("file[]", file);
                }

                $.ajax({
                data: data,
                type: "POST",
                url: "/uploadImages",
                cache: false,
                contentType: false,
                processData: false,
                success: function({success, data}) {
                    data.forEach((element)=>{
                        var image = $('<img>').attr('src', element ).addClass("img-fluid");
                        $('#content').summernote("insertNode", image[0]);
                    });
                    
                }
                });
            }
            
            //설정 보관
            // $('body').on('click', '.btnSave', function () {
            $('#userForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                //var data = $('#divProductForm').serialize();
                var subject = $("#subject").val();
                if(subject == ""){
                    alert('제목을 입력해주세요!');
                    return false;
                }
                var content = $("#content").val();
                if(content == ""){
                    alert('내용을 입력해주세요!');
                    return false;
                }
                var msgId = $("#id").val();
                if(msgId > 0){//수정이라면
                    var user_id = $("#receiver_id").val();
                    if(user_id == ""){
                        alert('수신인을 선택해주세요!');
                        return false;
                    }
                }else{
                    var chk_all = $("input[name='chk_all']:checked").val();
                    if(chk_all == undefined){
                        alert('사용상태를 선택해주세요!');
                        return false;
                    }
                }
                
                action = "/admin/contact/msg/"+msgId;
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
                            alert("성공적으로 발송되었습니다");
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

