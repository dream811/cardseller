

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
    if(packet.m_nCmd == PKT_ADMIN_CHANGE_COIN_STATE)
    {
        var data = JSON.parse(packet.m_strPacket);
        toastSuccess(data.message);
        refreshTable();
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
  

  
  function ChangeCoinState() {
    var lstCoinInfo = scope.lstCoinData;
    // lstCoinInfo.forEach((element,key) =>{
    //   if(element.ne == scope.lstCoinData[scope.filterCondition.key].ne)
    //     scope.filterCondition.key = key;
    //     scope.filterCondition.value = element.ne;
    // })
  }
  

  $('body').on('click', '.chk-is-use', function () {
    var is_use = $(this).is(':checked') ? 1 : 0;
    if(!confirm('Change your state?')){$(this).prop('checked', is_use == 1 ? false : true);return}
    var coinId = $(this).attr('data-id');
    
    var packet = {
      "id"                :   coinId,
      "type"              :   0,//0:상태변경 1:정보수정
      "is_use"            :   is_use,
      "user_id"           :   scope.userInfo.id,
      "user_password"     :   scope.userInfo.password,
    }
    SendPacket(PKT_ADMIN_CHANGE_COIN_STATE, JSON.stringify(packet));
  });

