@extends('include')
@section('content')
<div class="hold-transition login-page" style="width: 100%; height: calc(100vh - 0px);">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center"> <a href="#" class="h2"><b>POKER</b>&nbsp;&nbsp;관리자</a> </div>
			<div class="card-body">
				<p class="login-box-msg">!%strMsg%!</p>
				<form action="../../index3.html" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="AgentID" style="font-family: 'inherit'" ng-model="strID">
						<div class="input-group-append">
							<div class="input-group-text"> <span class="fas fa-user"></span> </div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="Password" style="font-family: 'inherit'" ng-model="strPW">
						<div class="input-group-append">
							<div class="input-group-text"> <span class="fas fa-lock"></span> </div>
						</div>
					</div>
				</form>
				<div style="height: 10px;"></div>
				<div class="social-auth-links text-center mt-2 mb-3">
					<a href="#" class="btn btn-block btn-primary" ng-click="onLogin()"> <i class="fas fa-sign-in-alt"></i> <span style="font-weight: bold">로&nbsp;그&nbsp;인</span> </a>
				</div>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->
</div>
<script>
function initialize() {
	scope.strMsg = "계정정보를 입력하세요."
	scope.onLogin = onLogin;
}

function onLogin() {
	if(scope.strID == undefined || scope.strID == '') {
		scope.alertInfo("아이디를 입력해주세요.");
		return;
	}
	if(scope.strPW == undefined || scope.strPW == '') {
		scope.alertInfo("비번을 입력해주세요.");
		return;
	}
	var url = `/admin/onLogin?strID=${scope.strID}&strPW=${scope.strPW}`;
	http.get(url).success(function(response) {
		if(response.success == 0x01) {
			window.location = '/';
		} else {
			scope.alertError(response.message);
		}
	});
}
</script>
@stop
