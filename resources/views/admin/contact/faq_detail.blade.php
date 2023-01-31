@extends('admin.layouts.iframe')
@section('content')
<form id="userForm" method="post" action="" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">FAQ </h1>
            </div><!-- /.col -->
            <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                
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
                        <h3 class="card-title text-sm">FAQ</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" id="id" value="{{$id}}">
                        
                            
                        
                        
                        <div class="form-group row mb-0">
                            <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Question:</label>
                            <div class="col-sm-9 col-md-9 mt-1">
                                <span>{{ $faqInfo->question }}</span>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="form-group row mb-0">
                            <label for="inputEmail3" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Answer:</label>
                            
                            <div class="col-sm-9 col-md-9 mt-2" style="font-size:12px;">
                                {!! $faqInfo->answer !!}
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
            
            
            
            $('.btnClose').on('click', function (e) {
                window.close();
            });
            
        });	  
    </script>
@endsection

