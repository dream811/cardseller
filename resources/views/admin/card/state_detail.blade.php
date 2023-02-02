@extends('admin.layouts.iframe')
@section('content')
<form id="userForm" method="post" action="" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">State </h1>
            </div><!-- /.col -->
            <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                
                <button type="submit" class="btn bg-success btn-xs btnSave">Save</button>
                <button type="button" class="btn bg-danger btn-xs btnClose">Close</button>
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
                        <h3 class="card-title text-sm">State</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-0">
                            <label for="inputEmail3" class="text-left col-12 col-form-label">Country:</label>
                            <div class="col-12">
                                <style>
                                    .select2-selection__rendered {
                                        line-height: 31px !important;
                                    }
                                    .select2-container .select2-selection--single {
                                        height: 31px !important;
                                    }
                                    .select2-selection__arrow {
                                        height: 0px !important;
                                    }
                                </style>
                                <select name="country_id" id="country_id" class="form-control select2bs4 " style="font-size:10px !important; width: 100%;"  required>
                                    <option value="">==Select==</option>
        
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}" @if ( $country->id == $state->country_id) selected @endif>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="inputEmail3" class="text-left col-12 col-form-label">Name:</label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $state->name }}">
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
            
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            
            $('.btnClose').on('click', function (e) {
                window.close();
            });
            
        });	  
    </script>
@endsection

