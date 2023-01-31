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
    scope.filterCondition = {
      value: '',
      key: 0
    };
  
    scope.ChangeCoinType = ChangeCoinType;
    scope.orderAmount = 0;
  
    scope.BuyCoin = BuyCoin;
  
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
    var m_nCmd = parseInt(packet.m_nCmd);
    switch(m_nCmd)
    {
        case PKT_ADMIN_DEPOSIT_CONFIRM:
            var data = JSON.parse(packet.m_strPacket);
            toastSuccess(data.message);
            refreshTable();
            break;
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
    scope.amount = this_money = amount.replace(/,/g,"");
    $("#order_amount").val((this_money));
    calHitMoney();
  }
  
  //-> 
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
  

  
  function floatFormat(value, decimal = 6) {
    return parseFloat(value).toFixed(decimal);
  }