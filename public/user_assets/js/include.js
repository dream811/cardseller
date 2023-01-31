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

    if(document.getElementById("id_strAddress") != null)
        scope.ConnectSocket();
    else
        scope.initialize();
});

function ConnectSocket()
{
    var strAddress = document.getElementById("id_strAddress").value;
    scope.websocket = new WebSocket(strAddress);
    scope.websocket.onopen = () => {
        scope.SendAuthPacket();
        scope.initialize();
    }

    scope.websocket.onerror = (error) => {
        console.log(`Connect error: ${error}`);
    }
    scope.websocket.onclose = (e) => {
        setTimeout(function() {
            ConnectSocket();
        }, 1000);
    }
    scope.websocket.onmessage = (e) => {
        scope.$apply(scope.RecvPacket(e.data));
    }
}

function SendPacket(nCmd, strPacket)
{
    var packet = {
        "m_nCmd"      : nCmd,
        "strValue"  : strPacket
    }

    scope.websocket.send(JSON.stringify(packet));
}

function SendAuthPacket()
{
    //메인페이지
    if(document.getElementById("main_table") != null)
    {
        //실유저
        if(document.getElementById("user_id") != null)
        {
            var user_id = document.getElementById("user_id").value;
            var user_level = document.getElementById("user_level").value;
            
            scope.SendPacket(PKT_USER_ACT_MAIN_AUTH, JSON.stringify({user_id, user_level}));
        }
        else//게스트
        {
            var user_id = 0;
            var user_level = 0;
            scope.SendPacket(PKT_USER_ACT_MAIN_AUTH, JSON.stringify({user_id, user_level}));
        }
    }
    else
    {
        //실유저
        if(document.getElementById("user_id") != null)
        {
            var user_id = document.getElementById("user_id").value;
            var user_level = document.getElementById("user_level").value;
            scope.SendPacket(PKT_USER_ACT_SUB_AUTH, JSON.stringify({user_id, user_level}));
        }
        else//게스트
        {
            var user_id = 0;
            var user_level = 0;
            scope.SendPacket(PKT_USER_ACT_SUB_AUTH, JSON.stringify({user_id, user_level}));
        }
    }
}

var strSocketMessage = ""; // 파켓렬
function ReceiveSplitData(strPacket)
{
    try {
        var objPacket = JSON.parse(strPacket);
        if(objPacket.nCode == -1) {
            if(objPacket.strPacket == "") {
                scope.ReceiveData(objPacket.strPacket);
            } else {
                if(objPacket.nEnd == 0) {
                    strSocketMessage += objPacket.strPacket;
                } else if(objPacket.nEnd == 1) {
                    var strMessage = strSocketMessage + objPacket.strPacket;
                    strSocketMessage = "";
                    scope.ReceiveData(strMessage);
                }
            }
        }
        else
        {
            scope.ReceiveData(strPacket);
        }
    }
    catch(err) {
        console.log(err.message);
    }
}

function RecvPacket(strPacket)
{
    var packet = JSON.parse(strPacket);
    var m_nCmd = parseInt(packet.m_nCmd);
    
    switch(m_nCmd)
    {
        case PKT_USER_DEPOSIT_CONFIRM:
            var data = JSON.parse(packet.m_strPacket);
            toastSuccess(data.message);
            break;
        case PKT_USER_DEPOSIT_CANCEL:
            var data = JSON.parse(packet.m_strPacket);
            toastError(data.message);
            break;
        case PKT_USER_WITHDRAW_CONFIRM:
            var data = JSON.parse(packet.m_strPacket);
            toastSuccess(data.message);
            break;
        case PKT_USER_WITHDRAW_CANCEL:
            var data = JSON.parse(packet.m_strPacket);
            toastError(data.message);
            break;
        // case PKT_ADMIN_REV_LIVE_DATA:
        //     RecvAdminLiveData(packet);
        //     break;

        // case PKT_ADMIN_ACT_MAIN_AUTH:
        //     RecvAdminMainAuth(packet);
        //     break;
        case 0x9999:
            scope.strServerTime = packet.strValue;
            break;
        default:
            RecvDataPacket(packet);
            break;
    }
}

function RecvAdminMainAuth(packet)
{
    if(packet.nRet == RET_ERROR)
    {
        window.location = "/admin/onLogout";
    }
}

function RecvAdminLiveData(packet)
{

}
//재정의되는 함수
// function RecvDataPacket(packet)
// {
//     //재정의되는 함수
// }

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
