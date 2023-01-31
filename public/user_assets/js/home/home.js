function initialize() {
  scope.strSearchKey = 'strID';
  scope.strSearchValue = '';
  scope.strFromDate = dateDiff(changeTimezone(new Date()), -6);
  scope.strToDate = changeTimezone(new Date());

  scope.onSelectCustomPage = onSelectCustomPage;
  scope.openAddUserLetter = openAddUserLetter;
  scope.onUserLetterUpdate = onUserLetterUpdate;
  scope.onDeleteUserLetter = onDeleteUserLetter;
  

  getUserLetterList();
  scope.Math = Math;
  scope.lstCoinData;
  scope.lstCoinOption = [];
  scope.filterCondition = {
    value: '',
    key: -1
  };

  scope.ChangeCoinType = ChangeCoinType;
  scope.orderAmount = 0;


  scope.floatFormat = floatFormat;
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
  if(confirm("You want to delete?") == true)
      SendPacket(SOCKET_ADMIN_PARTLETTER_DELETE, info.nSn);
}

function onDeleteAll()
{
  if(confirm("You want to delete all?") == true)
      SendPacket(SOCKET_ADMIN_PARTLETTER_DELETE, -1);
}

//-> 
function moneyPlus(amount)
{
    if ( amount == "reset" )
    {
        $("#order_amount").val(0);
        scope.orderAmount = 0;
    }
    else if ( amount == "all" )
    {
        $("#order_amount").val((scope.nUserMoney));
        scope.orderAmount = 0;
    }
    else if ( amount == "ex" )
    {

    }
    else
    {
        var this_money = $("#order_amount").val().replace(/,/g,"");
        $("#order_amount").val((Number(this_money) + Number(amount)));
        scope.orderAmount = Number(this_money) + Number(amount);
    }
    calHitMoney();
}

//-> 
function moneyPlusManual(amount) {
  var this_money = amount.replace(/,/g,"");
  scope.orderAmount = this_money*1;
  $("#order_amount").val((this_money));
  calHitMoney();
}

//-> 
function calHitMoney() {

}

function ChangeCoinType() {
  var lstCoinInfo = scope.lstCoinData;

}

function getCoinOption(data) {
    var newCoinOption = data.map((element, index)=>{
      
      return {nk:element.nk, ne:element.ne};
    });

    if(scope.lstCoinOption.toString() !== newCoinOption.toString()){
      scope.lstCoinOption = newCoinOption;
      console.log(scope.lstCoinOption);
    }
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

//-> 
function BuyCoin() {
  if(scope.filterCondition.key == -1){ alert('.'); return;}
  if(scope.orderAmount <= 0 ) {alert(''); return;}
  if(scope.orderAmount > $('#user_money').text()) {alert('.'); return;}
  if(confirm('?')){
    var packet = {
        "coin_type"         :   scope.lstCoinData[scope.filterCondition.key].ne,
        "coin_id"           :   scope.filterCondition.key,
        "user_id"           :   scope.userInfo.id,
        "user_password"     :   scope.userInfo.password,
        "order_amount"      :   scope.orderAmount
    }
    SendPacket(PKT_USER_COIN_BUY, JSON.stringify(packet));
    $('#order_amount').val(scope.orderAmount = 0);
  }
}

function floatFormat(value, decimal = 6) {
  return parseFloat(value).toFixed(decimal);
}