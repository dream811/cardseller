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
                                <button type="button" class="btn btn-success btn-sm btnSave" >보관</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" >
                        <form id="divUserForm" method="POST" action="{{route('admin.setting.guide')}}">
                            @csrf
                            <textarea name="guide" id="guide">
                            </textarea>
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

        
        $('#guide').summernote({
            height: '650px',
            
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
        $('#guide').summernote('code', {!! json_encode($guide) !!});
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
                    $('#guide').summernote("insertNode", image[0]);
                });
                
            }
            });
        }

        $('body').on('click', '.btnSave', function () {
            $('#divUserForm').submit();
        });
        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/user/userManage/edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
    </script>
@endpush