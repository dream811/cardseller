
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
      id: document.getElementById('admin_id')? document.getElementById('admin_id').value : 0,
      password: document.getElementById('user_password') ? document.getElementById('user_password').value :"",
    };
  
    getUserLetterList();
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
		case PKT_ADMIN_DEPOSIT_CHECK:
			var data = JSON.parse(packet.m_strPacket);
			toastSuccess(data.message);
			refreshTable();
			break;
        case PKT_ADMIN_DEPOSIT_CANCEL:
            var data = JSON.parse(packet.m_strPacket);
            toastError(data.message);
			refreshTable();
            break;
        case PKT_ADMIN_WITHDRAW_CONFIRM:
            var data = JSON.parse(packet.m_strPacket);
            toastSuccess(data.message);
			refreshTable();
            break;
        case PKT_ADMIN_WITHDRAW_CANCEL:
            var data = JSON.parse(packet.m_strPacket);
            toastError(data.message);
			refreshTable();
            break;
		case PKT_ADMIN_WITHDRAW_CHECK:
            var data = JSON.parse(packet.m_strPacket);
            toastSuccess(data.message);
			refreshTable();
            break;
    }
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
  
  //-> 배팅금액수동입력
  function moneyPlusManual(amount) {
    scope.amount = this_money = amount.replace(/,/g,"");
    $("#order_amount").val((this_money));
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
  
  //-> 배팅금액수동입력
  function BuyCoin() {
    if(confirm('코인을 구매하시겠습니까?')){
      var packet = {
          "coin_type"         :   scope.lstCoinData[scope.filterCondition.key].ne,
          "coin_id"           :   scope.filterCondition.key,
          "user_id"           :   scope.userInfo.id,
          "user_password"     :   scope.userInfo.password,
          "order_amount"      :   scope.orderAmount
      }
      SendPacket(PKT_USER_COIN_BUY, JSON.stringify(packet));
    }
  }
  
  function floatFormat(value, decimal = 6) {
    return parseFloat(value).toFixed(decimal);
  }

  $('body').on('click', '.btnConfirm', function () {
    if(!confirm('승인하시겠습니까?')){return}
    var id = $(this).attr('data-id');
    var type = $(this).data('type');
    var action = '/admin/cash/cash_state/' + id;
    var status = 1;
    var packet = {
      "id"                :   id,
      "user_id"           :   scope.userInfo.id,
      "user_password"     :   scope.userInfo.password,
    }
    SendPacket(type == 0 ? PKT_ADMIN_DEPOSIT_CONFIRM : PKT_ADMIN_WITHDRAW_CONFIRM, JSON.stringify(packet));
  });
  $('body').on('click', '.btnCancel', function () {
    if(!confirm('취소하시겠습니까?')){return}
    var id = $(this).attr('data-id');
    var type = $(this).data('type');
    var action = '/admin/cash/cash_state/' + id;
    var status = 2;
    var packet = {
      "id"                :   id,
      "user_id"           :   scope.userInfo.id,
      "user_password"     :   scope.userInfo.password,
    }
    SendPacket(type == 0 ? PKT_ADMIN_DEPOSIT_CANCEL : PKT_ADMIN_WITHDRAW_CANCEL, JSON.stringify(packet));
  });
  $('body').on('click', '.btnCheck', function () {
    if(!confirm('대기상태로 전환시겠습니까?')){return}
    var id = $(this).attr('data-id');
    var type = $(this).data('type');
    var status = 3;
    var packet = {
      "id"                :   id,
      "user_id"           :   scope.userInfo.id,
      "user_password"     :   scope.userInfo.password,
    }
    SendPacket(type == 0 ? PKT_ADMIN_DEPOSIT_CHECK : PKT_ADMIN_WITHDRAW_CHECK, JSON.stringify(packet));
  });