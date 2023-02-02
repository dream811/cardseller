@extends('admin.layouts.iframe')

@section('content')
<form id="userForm" method="post" action="{{ route('admin.card.save', $id) }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">Card {{ $title }}</h1>
            </div><!-- /.col -->
            <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                <button type="submit" class="btn btn-primary btn-xs btnSave">Save</button>
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
                        <h3 class="card-title text-sm">Card {{$title}}</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="id" id="id" value="{{$id}}">
                        <div class="form-group row mb-0">
                            <label for="type" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Type<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                                <select class="custom-select form-control-border custom-select-sm" name="type" id="type" required>
                                    <option value="">= Select =</option>
                                    <option value="AMERICAN_EXPRESS" @if ( "AMERICAN_EXPRESS" == $card->type) selected @endif>AMEX</option>
                                    <option value="MASTER_CARD" @if ( "MASTER_CARD" == $card->type) selected @endif>Master Card</option>
                                    <option value="VISA_CARD" @if ( "VISA_CARD" == $card->type) selected @endif>Visa Card</option>
                                    <option value="DISC" @if ( "DISC" == $card->type) selected @endif>Visa Card</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="cvv" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Cvv<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="cvv" name="cvv" value="{{ $card->cvv }}" placeholder="Please input bin" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="exp_date" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Exp date<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="exp_date" name="exp_date" value="{{ $card->exp_date }}" placeholder="Please input exp date" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="category" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Category<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="category" name="category" value="{{ $card->category }}" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="price" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Price<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="number" step="0.1" max="100" class="form-control form-control-sm" id="price" name="price" value="{{ $card->price }}" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="card_number" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Owner Name<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $card->name }}" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="card_number" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Email<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ $card->email }}" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="card_number" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Phone<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="phone" name="phone" value="{{ $card->phone }}" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="card_number" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Card Number<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="card_number" name="card_number" value="{{ $card->card_number }}" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="card_address" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Card Address<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="card_address" name="card_address" value="{{ $card->card_address }}" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="card_address" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Country<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                                {{-- <select class="custom-select form-control-border custom-select-sm" name="country_id" id="country_id">
                                    <option value="">= Select =</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id}}" @if ( $country->id == $card->country_id) selected @endif>{{$country->name}}</option>
                                    @endforeach
                                </select> --}}
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
                                        <option value="{{$country->id}}" @if ( $country->id == $card->country_id) selected @endif>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="card_address" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">State<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                                
                                <select name="state_id" id="state_id" class="form-control select2bs4 " style="font-size:10px !important; width: 100%;" required>
                                    <option value="">==Select==</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}" @if ( $state->id == $card->state_id) selected @endif>{{$state->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <label for="city" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">City<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="city" name="city" value="{{ $card->city }}" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="zip" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">Zip<code style="color:red !important;">[*]</code></label>
                            <div class="col-sm-9 col-md-6">
                            <input type="text" class="form-control form-control-sm" id="zip" name="zip" value="{{ $card->zip }}" placeholder="" required>
                            </div>
                        </div>
                        
                        {{-- <div class="form-group row mb-0">
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
                        </div> --}}
                        
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
            
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $('#exp_date').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
            
            $('body').on('click', '.btnClose', function () {
                window.close();
            });
            
        });	  
    </script>
@endsection

