@extends('include')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<p class="m-0" style="font-size: 20px; font-weight: bold;">총판목록</p>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- Main content -->
	<div class="content" style="margin-top: -10px;">
		<div class="container-fluid">
			<div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i>&nbsp;&nbsp;등록일자</span>
                            </div>
                            <input type="text" class="form-control" id="id_user_date_range" name="user_date_range">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 col-8">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-user"></i>&nbsp;&nbsp;아이디</span>
                            </div>
                            <input type="text" class="form-control" id="id_agentID">
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 col-4 ">
                    <div style="height: 5px;"></div>
                    <button type="button" class="btn btn-block bg-gradient-primary btn-sm" style="width: 100px;" onclick="getAgentList()">
                        <i class="fas fa-search"></i>&nbsp;&nbsp;검색하기
                    </button>
                </div>
                <div class="col-lg-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-table"></i>
                                TABLE
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"> <i class="fas fa-minus"></i> </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: calc(100vh - 235px); border-bottom: 1px solid #f4f6f9;">
                            <table class="table table-head-fixed text-nowrap table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">NO</th>
                                        <th style="text-align: left;">아이디</th>
                                        <th style="text-align: left;">총판명</th>
                                        <th style="text-align: left;">가입코드</th>
                                        <th style="text-align: left;">전화번호</th>
                                        <th style="text-align: right;">회원수</th>
                                        <th style="text-align: right;">보유머니</th>
                                        <th style="text-align: center;">등록시간</th>
                                        <th style="text-align: center;">상태</th>
                                        <th style="text-align: center;">기능</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="info in lstAgent track by $index">
                                        <td>!%$index + 1%!</td>
                                        <td style="text-align: left;">!%info.strID%!</td>
                                        <td style="text-align: left;">!%info.strName%!</td>
                                        <td style="text-align: left;">!%info.strMark%!</td>
                                        <td style="text-align: left;">!%info.strPhone%!</td>
                                        <td style="text-align: right;">!%numberFormat(info.nUserCnt)%!</td>
                                        <td style="text-align: right;">!%numberFormat(info.nMoney)%!</td>
                                        <td style="text-align: center;">!%info.strRegTime%!</td>
                                        <td style="text-align: center;">
                                            <span class="badge bg-info" ng-if="info.nStatus==0" style="font-size: 14px;">대기</span>
                                            <span class="badge bg-success" ng-if="info.nStatus==1" style="font-size: 14px;">승인</span>
                                            <span class="badge bg-danger" ng-if="info.nStatus==2" style="font-size: 14px;">차단</span>
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn bg-gradient-info btn-xs" style="width: 60px;" ng-click="onClickUpdate(info)" data-toggle="modal" data-target="#modal-info"><i class="fas fa-edit"></i>&nbsp;수정</button>
                                            <button type="button" class="btn bg-gradient-danger btn-xs" style="width: 60px;" ng-if="info.nStatus==1" ng-click="onSetStatus(info, 2)"><i class="fas fa-stop"></i>&nbsp;차단</button>
                                            <button type="button" class="btn bg-gradient-primary btn-xs" style="width: 60px;" ng-if="info.nStatus!=1" ng-click="onSetStatus(info, 1)"><i class="fas fa-play"></i></i>&nbsp;활동</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="width: 100%; margin-top: 10px; text-align: right; position: relative;">
                        <ul class="pagination" style="position: absolute; right: 0px;">
                            <li class="page-item"><a class="page-link" href="#" ng-click="onSelectPrevPage()">이전</a></li>
                            <li ng-repeat="infoPage in lstPage track by $index" ng-if="infoPage <= nPage" class="page-item" ng-class="{ active: infoPage==nCurPage }">
                                <a class="page-link" ng-click="onSelectCustomPage($index)" href="#">!%infoPage%!</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#" ng-click="onSelectNextPage()">다음</a></li>
                        </ul>
                    </div>
                </div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>

<div class="modal fade" id="modal-info">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">총판수정</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-heading"></i>&nbsp;&nbsp;제목</span>
                    </div>
                    <input type="text" class="form-control" id="id_title">
                </div>
            </div>

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" ng-click="onSendAgentLetter()"><i class="fas fa-envelope"></i>&nbsp;보내기</button>
        </div>
        </div>
    </div>
</div>

<script>
function initialize()
{
	scope.getAgentList = getAgentList;
    scope.onSetStatus = onSetStatus;
    scope.onClickCharge = onClickCharge;
    scope.onClickExcharge = onClickExcharge;
    scope.onAgentCharge = onAgentCharge;
    scope.onAgentExcharge = onAgentExcharge;
    scope.onClickLetter = onClickLetter;
    scope.onSendAgentLetter = onSendAgentLetter;

    var start = moment().subtract(7, 'days');
    var end = moment();
    $('#id_user_date_range').daterangepicker({
        startDate: start,
        endDate: end,
        timePicker: true,
        timePicker24Hour: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('input[name="user_date_range"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' ~ ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('input[name="user_date_range"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#id_user_date_range').val(start.format('YYYY-MM-DD') + ' ~ ' + end.format('YYYY-MM-DD'));

	scope.getAgentList();
}

function getAgentList()
{
    var strTimeRange = $('#id_user_date_range').val();
    var strAgentID = $('#id_agentID').val();
    var strUrl = `/agent/getAgentList?strTimeRange=${strTimeRange}&strAgentID=${strAgentID}&nPageIndex=${scope.nCurPage}&nPageSize=${scope.nPageSize}`;
	http.get(strUrl).success(function(response) {
		if(response.nRetCode == 0x00) {
			scope.alertError(response.strValue);
		} else {
            var objRet = JSON.parse(response.strValue);
			scope.lstAgent = objRet.lstPacket;
            scope.nPage = objRet.nPage;
		}
	});
}

function onSelectCustomPage(nPage)
{
    onSelectPage(nPage);
    getAgentList();
}

function onSetStatus(info, nStatus)
{
    var strUrl = `/agent/setAgentStatus?nAgent=${info.nSn}&nStatus=${nStatus}`;
    http.get(strUrl).success(function(response) {
		if(response.nRetCode == 0x00) {
			scope.toastError(response.strValue);
		} else {
            scope.toastSuccess(response.strValue);
            getAgentList();
		}
	});
}

function onClickCharge(info)
{
    scope.nAgent = info.nSn;
}

function onClickExcharge(info)
{
    scope.nAgent = info.nSn;
}

function onClickLetter(info)
{
    scope.nAgent = info.nSn;
}

function onAgentCharge()
{
    var nAmount = $('#id_charge_amount').val();
    var strUrl = `/agent/agentCharge?nAgent=${scope.nAgent}&nAmount=${nAmount}`;
    http.get(strUrl).success(function(response) {
		if(response.nRetCode == 0x00) {
			scope.toastError(response.strValue);
		} else {
            scope.toastSuccess(response.strValue);
            $('#id_charge_amount').val(0);
            getAgentList();
		}
	});
}

function onAgentExcharge()
{
    var nAmount = $('#id_excharge_amount').val();
    var strUrl = `/agent/agentExcharge?nAgent=${scope.nAgent}&nAmount=${nAmount}`;
    http.get(strUrl).success(function(response) {
		if(response.nRetCode == 0x00) {
			scope.toastError(response.strValue);
		} else {
            scope.toastSuccess(response.strValue);
            $('#id_excharge_amount').val(0);
            getAgentList();
		}
	});
}

function onSendAgentLetter()
{
    var strTitle = $('#id_title').val();
    var strLetter = $('#summernote').val();
    var strUrl = `/agent/sendAgentLetter?nAgent=${scope.nAgent}&strTitle=${strTitle}&strLetter=${strLetter}`;

    http.get(strUrl).success(function(response) {
		if(response.nRetCode == 0x00) {
			scope.toastError(response.strValue);
		} else {
            scope.toastSuccess(response.strValue);
            $('#summernote').summernote('code', "");
            $('#id_title').val("");
		}
	});
}
</script>
@stop
