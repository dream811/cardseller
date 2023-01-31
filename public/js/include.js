var myApp = angular.module("myApp", []);
myApp.controller("myController", function($scope, $http) {
    scope = $scope;
    http = $http;

    scope.alertError = alertError;
    scope.alertInfo = alertInfo;
    scope.alertWarning = alertWarning;
    scope.alertSuccess = alertSuccess;

    scope.toastError = toastError;
    scope.toastInfo = toastInfo;
    scope.toastWarning = toastWarning;
    scope.toastSuccess = toastSuccess;

    scope.numberFormat = numberFormat;

    // Page
    scope.nLimitPage = 5;
    scope.nCurPage = 1;
    scope.nPageSize = 50;
    scope.lstPage = [];
    for(var i =0; i < scope.nLimitPage; i++) {
        scope.lstPage[i] = i + 1;
    }
    scope.nPageFrame = 0;
    scope.onSelectPage = onSelectPage;
    scope.onSelectNextPage = onSelectNextPage;
    scope.onSelectPrevPage = onSelectPrevPage;
    scope.onSelectCustomPage = onSelectCustomPage;

    scope.websocket = null;
    scope.ConnectSocket = ConnectSocket;
    scope.SendPacket = SendPacket;
    scope.SendAuthPacket = SendAuthPacket;
    scope.RecvPacket = RecvPacket;

    scope.initialize = initialize;
    
    scope.user_exchange_a = false;
    scope.user_exchange = new Audio('/alram/user_exchange.mp3');
    scope.user_exchange.addEventListener('ended', function() {
        this.currentTime = 0;
        setTimeout(() => {
           if(scope.user_exchange_a == true)
               scope.user_exchange.play();
        }, 2000);
    }, false);

    scope.new_user_a = false;
    scope.new_user = new Audio('/alram/user_exchange.mp3');
    scope.new_user.addEventListener('ended', function() {
        this.currentTime = 0;
        setTimeout(() => {
           if(scope.new_user_a == true)
               scope.new_user.play();
        }, 2000);
    }, false);


        scope.initialize();
});


function RecvAdminMainAuth(packet)
{
    if(packet.nRet == RET_ERROR)
    {
        window.location = "/admin/onLogout";
    }
}


function alertError(strMsg)
{
    $('#id_msg_error').html(strMsg);
    $("#id_alert_error").click();
}

function alertInfo(strMsg)
{
    $('#id_msg_info').html(strMsg);
    $("#id_alert_info").click();
}

function alertWarning(strMsg)
{
    $('#id_msg_warning').html(strMsg);
    $("#id_alert_warning").click();
}

function alertSuccess(strMsg)
{
    $('#id_msg_success').html(strMsg);
    $("#id_alert_success").click();
}

function toastError(strMsg)
{
    toastr.error(strMsg)
}

function toastInfo(strMsg)
{
    toastr.info(strMsg)
}

function toastWarning(strMsg)
{
    toastr.warning(strMsg)
}

function toastSuccess(strMsg)
{
    toastr.success(strMsg)
}

// Number Format
function numberFormat(val) {
    var num = numeral(val).format('0,0');
    return num;
}

function onSelectPage(nPage) {
    scope.nCurPage = scope.nPageFrame * scope.nLimitPage + nPage + 1;
}

function onSelectNextPage() {
    if ((scope.nPageFrame + 1) * scope.nLimitPage >= scope.nPage) {
        return;
    }
    scope.nPageFrame++;
    scope.nCurPage = scope.nPageFrame * scope.nLimitPage + 1;
    for (var i = 0; i < scope.nLimitPage; i++) {
        scope.lstPage[i] = scope.nPageFrame * scope.nLimitPage + i + 1;
    }
}

function onSelectPrevPage() {
    if (scope.nPageFrame == 0 || scope.nPageFrame == undefined) {
        return;
    }
    scope.nCurPage = scope.nPageFrame * scope.nLimitPage;
    scope.nPageFrame--;
    for (var i = 0; i < scope.nLimitPage; i++) {
        scope.lstPage[i] = scope.nPageFrame * scope.nLimitPage + i + 1;
    }
}

function changeTimezone(date) {
    var localTIme = (new Date(date).getTime()) / 1000;
    var localOffset = new Date().getTimezoneOffset() * 60;
    var utc = localTIme + localOffset;
    utc = localTIme + localOffset + 9 * 3600;
    date = moment.unix(utc).format('YYYY/MM/DD');

    return date;
}

function dateDiff(date, diff) {
    var diffset = diff * 24 * 3600;
    var strampTime = new Date(date).getTime() / 1000;
    strampTime = strampTime + diffset;
    var date = moment.unix(strampTime).format('YYYY/MM/DD');

    return date;
}

function initialize()
{

}

function onSelectCustomPage()
{

}
