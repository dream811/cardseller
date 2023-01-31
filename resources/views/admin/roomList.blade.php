@extends('include')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<p class="m-0" style="font-size: 20px; font-weight: bold;">게임방목록</p>
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
                            <input type="text" class="form-control" id="id_date_range" name="date_range">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 col-8">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-user"></i>&nbsp;&nbsp;방네임</span>
                            </div>
                            <input type="text" class="form-control" id="id_roomName">
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 col-4 ">
                    <div style="height: 5px;"></div>
                    <button type="button" class="btn btn-block bg-gradient-primary btn-sm" style="width: 100px;" onclick="getRoomList()">
                        <i class="fas fa-search"></i>&nbsp;&nbsp;검색하기
                    </button>
                </div>
                <div class="col-lg-1 col-md-2 col-sm-4 col-xs-4 col-4 ">
                    <div style="height: 5px;"></div>
                    <button type="button" class="btn btn-block bg-gradient-danger btn-sm" style="width: 100px;" onclick="addRoomInfo()" data-toggle="modal" data-target="#modal-info">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;방만들기
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
                                        <th style="width: 100px;">방번호</th>
                                        <th style="text-align: left;">방네임</th>
                                        <th style="text-align: left;">비번</th>
                                        <th style="text-align: left;">종류</th>
                                        <th style="text-align: center;">생성시간</th>
                                        <th style="text-align: right;">좌석수</th>
                                        <th style="text-align: right;">수수료</th>
                                        <th style="text-align: right;">스테이크</th>
                                        <th style="text-align: right;">앤티</th>
                                        <th style="text-align: right;">바이인</th>
                                        <th style="text-align: center;">관전</th>
                                        <th style="text-align: center;">상태</th>
                                        <th style="text-align: center;">종료시간</th>
                                        <th style="text-align: center;">기능</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="info in lstRoom track by $index">
                                        <td>!%info.nSn%!</td>
                                        <td style="text-align: left;">!%info.strName%!</td>
                                        <td style="text-align: left;">!%info.strPW%!</td>
                                        <td style="text-align: left;">
                                            <span ng-if="info.nType==1">홀덤</span>
                                            <span ng-if="info.nType==2">토너먼트</span>
                                            <span ng-if="info.nType==3">바둑이</span>
                                        </td>
                                        <td style="text-align: center;">!%info.strCreateTime%!</td>
                                        <td style="text-align: right;">!%info.nSeatCnt%!</td>
                                        <td style="text-align: right;">!%info.fRate%!</td>
                                        <td style="text-align: right;">!%numberFormat(info.nStake)%!</td>
                                        <td style="text-align: right;">!%numberFormat(info.nAnti)%!</td>
                                        <td style="text-align: right;">!%numberFormat(info.nBuyin)%!</td>
                                        <td style="text-align: center;">
                                            <span class="badge bg-info" ng-if="info.nShow==0" style="font-size: 14px;">불가</span>
                                            <span class="badge bg-success" ng-if="info.nShow==1" style="font-size: 14px;">가능</span>
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="badge bg-info" ng-if="info.nStatus==0" style="font-size: 14px;">준비중</span>
                                            <span class="badge bg-success" ng-if="info.nStatus==1" style="font-size: 14px;">진행중</span>
                                            <span class="badge bg-danger" ng-if="info.nStatus==2" style="font-size: 14px;">종료</span>
                                        </td>
                                        <td style="text-align: center;">!%info.strEndTime%!</td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn bg-gradient-info btn-xs" style="width: 60px;"><i class="fas fa-edit"></i>&nbsp;관리</button>
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
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">방만들기</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="input-group">
                    <table class="table-form" style="min-width: 300px; width: 100%;">
                        <tr>
                            <td style="width: 150px;">
                                방네임
                            </td>
                            <td>
                                <input type="text" class="form-control my-form" ng-model="roomInfo.strName">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                비번
                            </td>
                            <td>
                                <input type="text" class="form-control my-form" ng-model="roomInfo.strPW">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                종류
                            </td>
                            <td>
                                <select class="form-control my-form" ng-model="roomInfo.nType">
                                    <option value="0"></option>
                                    <option value="1">홀덤</option>
                                    <option value="2">토너먼트</option>
                                    <option value="3">바둑이</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                좌석수
                            </td>
                            <td>
                                <input type="number" class="form-control my-form" style="text-align: right;" ng-model="roomInfo.nSeatCnt">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                수수료
                            </td>
                            <td>
                                <input type="number" class="form-control my-form" style="text-align: right;" ng-model="roomInfo.fRate">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                스테이크
                            </td>
                            <td>
                                <input type="number" class="form-control my-form" style="text-align: right;" ng-model="roomInfo.nStake">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                앤티
                            </td>
                            <td>
                                <input type="number" class="form-control my-form" style="text-align: right;" ng-model="roomInfo.nAnti">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px;">
                                바이인
                            </td>
                            <td>
                                <input type="number" class="form-control my-form" style="text-align: right;" ng-model="roomInfo.nBuyin">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal" style="display: none;" id="btn_close"></button>
            <button type="button" class="btn btn-success" onclick="onSaveRoomInfo()"><i class="fas fa-save"></i>&nbsp;만들기</button>
        </div>
        </div>
    </div>
</div>

<script>
function initialize()
{
	scope.getRoomList = getRoomList;

    var start = moment().subtract(7, 'days');
    var end = moment();
    $('#id_date_range').daterangepicker({
        startDate: start,
        endDate: end,
        timePicker: true,
        timePicker24Hour: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' ~ ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('input[name="date_range"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#id_date_range').val(start.format('YYYY-MM-DD') + ' ~ ' + end.format('YYYY-MM-DD'));

    scope.roomInfo = new Object();
	scope.getRoomList();
}

function getRoomList()
{
    var strTimeRange = $('#id_date_range').val();
    var strName = $('#id_roomName').val();
    var packet = {
        "strTime"       : strTimeRange,
        "strName"       : strName,
        "nPageIndex"    : scope.nCurPage,
        "nPageSize"     : scope.nPageSize
    }

    scope.SendPacket(PKT_ADMIN_GET_ROOM_LIST, JSON.stringify(packet));
}

function onSelectCustomPage(nPage)
{
    onSelectPage(nPage);
    getRoomList();
}

function addRoomInfo()
{
    scope.roomInfo.strName = "";
    scope.roomInfo.strPW = "";
    scope.roomInfo.nType = 0;
    scope.roomInfo.nSeatCnt = 0;
    scope.roomInfo.fRate = 0;
    scope.roomInfo.nStake = 0;
    scope.roomInfo.nAnti = 0;
    scope.roomInfo.nBuyin = 0;
}

function onSaveRoomInfo()
{
    scope.SendPacket(PKT_ADMIN_ACT_CREATE_ROOM, JSON.stringify(scope.roomInfo));
}

function RecvDataPacket(packet)
{
    if(packet.nCmd == PKT_ADMIN_GET_ROOM_LIST)
    {
        scope.lstRoom = JSON.parse(packet.strValue);
    }
    else if(packet.nCmd == PKT_ADMIN_ACT_CREATE_ROOM)
    {
        if(packet.nRet == 0x01)
        {
            $("#btn_close").click();
            scope.toastInfo(packet.strValue);
            getRoomList();
        }
        else
        {
            scope.alertError(packet.strValue);
        }
    }
}

</script>
@stop
