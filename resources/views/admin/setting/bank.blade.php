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
                        <form id="divSettingForm" method="POST" action="{{route('admin.setting.bank')}}">
                            @csrf
                            <div class="row col-12">
                                <label>입금계좌정보</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <code style=""></code>
                                        <div class="input-group input-group-sm mb-2 mr-sm-2">
                                            <input type="text" id="bank_info" name="bank_info" value="{{$setting->bank_info}}" class="form-control" placeholder="은행명을 입력하세요">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12">
                                <label>입금시간</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <code style="">시작시간</code>
                                        <div class="input-group input-group-sm mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                            </div>
                                            <input type="text" id="deposit_from" name="deposit_from" value="{{$setting->deposit_from}}" class="form-control" placeholder="Input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <code style="">마감시간</code>
                                        <div class="input-group input-group-sm mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                            <input type="text" id="deposit_to" name="deposit_to" value="{{$setting->deposit_to}}" class="form-control" placeholder="Input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>출금시간</label></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <code style="">시작시간</code>
                                        <div class="input-group input-group-sm mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                            </div>
                                            <input type="text" id="withdraw_from" name="withdraw_from" value="{{$setting->withdraw_from}}" class="form-control" placeholder="Input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <code style="">마감시간</code>
                                        <div class="input-group input-group-sm mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                            <input type="text" id="withdraw_to" name="withdraw_to" value="{{$setting->withdraw_to}}" class="form-control" placeholder="Input">
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <!-- <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="txtCalFunction" id="txtCalFunction" value="{{$setting->strCalFunction}}" placeholder="">
                                    </div>
                                </div>
                                <code>
                                    ※ 계산식은 숫자, +-*/() , 그리고 다음 글자로만 구성 가능합니다. (원가, 환율, 구매수수료, 해외배송비, 판매수수료, 마진율)<br>
                                    ex) ((환율*원가*(1+구매수수료))+해외배송비)*(1+판매수수료)*(1+마진율)<br>
                                </code>
                            </div> -->
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

        $('#deposit_from').daterangepicker({
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

        $('#deposit_to').daterangepicker({
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

        $('#withdraw_from').daterangepicker({
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

        $('#withdraw_to').daterangepicker({
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
        

        $('body').on('click', '.btnSave', function () {
            $('#divSettingForm').submit();
        });
        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/user/userManage/edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
    </script>
@endpush