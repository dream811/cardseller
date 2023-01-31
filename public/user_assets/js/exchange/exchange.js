function initialize() {
  scope.strSearchKey = 'strID';
  scope.strSearchValue = '';
  scope.strFromDate = dateDiff(changeTimezone(new Date()), -6);
  scope.strToDate = changeTimezone(new Date());

  scope.onSelectCustomPage = onSelectCustomPage;
  scope.openAddUserLetter = openAddUserLetter;
  scope.onUserLetterUpdate = onUserLetterUpdate;
  scope.onDeleteUserLetter = onDeleteUserLetter;
  scope.userInfo = {
    id: document.getElementById('user_id')? document.getElementById('user_id').value : 0,
    password: document.getElementById('user_password') ? document.getElementById('user_password').value :"",
    money: document.getElementById('user_money') ? document.getElementById('user_money').value : 0
  };

  getUserLetterList();
  scope.Math = Math;
  scope.lstCoinData;


  scope.amount = 0;

  scope.onDeposit = onDeposit;
  scope.onWithdraw = onWithdraw;

  scope.floatFormat = floatFormat;
}

function getUserLetterList() {
  var packet = {
      "strFromDate"       : scope.strFromDate,
      "strToDate"         : scope.strToDate,
      "strSearchKey"      : scope.strSearchKey,
      "strSearchValue"    : scope.strSearchValue,
      "nCurPage"          : scope.nCurPage,
      "nPageSize"         : 50
  };

  //SendPacket(SOCKET_ADMIN_PARTLETTER_LIST, JSON.stringify(packet));
}

function RecvDataPacket(packet)
{
  if(packet.m_nCmd == PKT_USER_COIN_DATA)
  {
    scope.lstCoinData = packet.m_strPacket;
    //scope.filterCondition.value = scope.lstCoinData[0].ne;
  }
  else if(packet.m_nCmd == PKT_USER_DEPOSIT_MONEY)
  {
      var objRet = JSON.parse(packet.m_strPacket);
      alert(objRet.message);
      //getUserLetterList();
  }
  else if(packet.m_nCmd == PKT_USER_WITHDRAW_MONEY)
  {
      var objRet = JSON.parse(packet.m_strPacket);
      alert(objRet.message);
      //getUserLetterList();
  }
  // else if(packet.m_nCode == SOCKET_ADMIN_PARTLETTER_DELETE)
  // {
  //     var objRet = JSON.parse(packet.m_strPacket);
  //     alert(objRet.strMsg);
  //     getUserLetterList();
  // }
}

function onSelectCustomPage(nCurPage) {
  onSelectPage(nCurPage);
  getUserLetterList();
}

function openAddUserLetter()
{
  onOpenUrl('/admin/sendLetter?strAdminID=&nSn=0', 1200, 750);
}

function onUserLetterUpdate(info)
{
  onOpenUrl("/admin/sendLetter?strAdminID=&nSn=" + info.nSn, 1200, 750);
}

function onDeleteUserLetter(info)
{
  if(confirm("삭제하시겠습니까?") == true)
      SendPacket(SOCKET_ADMIN_PARTLETTER_DELETE, info.nSn);
}

function onDeleteAll()
{
  if(confirm("전체 삭제하시겠습니까?") == true)
      SendPacket(SOCKET_ADMIN_PARTLETTER_DELETE, -1);
}

//-> 배팅금액선택
function moneyPlus(amount)
{
    if ( amount == "reset" )
    {
        $("#amount").val(0);
        scope.amount = 0;
    }
    else if ( amount == "all" )
    {
        $("#amount").val((scope.nUserMoney));
        scope.amount = 0;
    }
    else if ( amount == "ex" )
    {

    }
    else
    {
        var this_money = $("#amount").val().replace(/,/g,"");
        $("#amount").val((Number(this_money) + Number(amount)));
        scope.amount = Number(this_money) + Number(amount);
    }
    calHitMoney();
}

//-> 배팅금액수동입력
function moneyPlusManual(amount) {
  var this_money = amount.replace(/,/g,"");
  scope.amount = this_money*1;
  $("#amount").val((this_money));
  calHitMoney();
}

//-> 적중금액 계산
function calHitMoney() {

}

function ChangeCoinType() {
  var lstCoinInfo = scope.lstCoinData;
  // lstCoinInfo.forEach((element,key) =>{
  //   if(element.ne == scope.lstCoinData[scope.filterCondition.key].ne)
  //     scope.filterCondition.key = key;
  //     scope.filterCondition.value = element.ne;
  // })
}

function MoneyFormat(str)
{
    var re="";
    str = str + "";
    str=str.replace(/-/gi,"");
    str=str.replace(/ /gi,"");

    str2=str.replace(/-/gi,"");
    str2=str2.replace(/,/gi,"");
    str2=str2.replace(/\./gi,"");

    if(isNaN(str2) && str!="-") return "";
    try
    {
        for(var i=0;i<str2.length;i++)
        {
            var c = str2.substring(str2.length-1-i,str2.length-i);
            re = c + re;
            if(i%3==2 && i<str2.length-1) re = "," + re;
        }

    }catch(e)
    {
        re="";
    }
    if(str.indexOf("-")==0)
    {
        re = "-" + re;
    }
    return re;
}

//-> 입금신청
function onDeposit() {
  if(scope.amount <= 0 || scope.amount == undefined){
    alert('금액을 정확히 입력해주세요.');
    return;
  }
  if(confirm('입금신청하시겠습니까?')){
    var packet = {
        "user_id"           :   scope.userInfo.id,
        "user_password"     :   scope.userInfo.password,
        "amount"            :   scope.amount
    }
    SendPacket(PKT_USER_DEPOSIT_MONEY, JSON.stringify(packet));
    $('#amount').val(scope.amount = 0);
  }
}

//-> 출금신청
function onWithdraw() {
  if(scope.amount <= 0 || scope.amount == undefined){
    alert('금액을 정확히 입력해주세요.');
    return;
  }
  if(scope.amount > $('#user_money').text()) {alert('보유머니가 부족합니다.'); return;}
  if(confirm('출금신청하시겠습니까?')){
    var packet = {
        "user_id"           :   scope.userInfo.id,
        "user_password"     :   scope.userInfo.password,
        "amount"            :   scope.amount
    }
    SendPacket(PKT_USER_WITHDRAW_MONEY, JSON.stringify(packet));
    $('#amount').val(scope.amount = 0);
  }
}

function floatFormat(value, decimal = 6) {
  return parseFloat(value).toFixed(decimal);
}