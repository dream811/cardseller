

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

  $('body').on('click', '.btnSave', function () {
    
    var kor_name = $("#kor_name").val();
    if(kor_name == ""){
        alert('이름을 입력해주세요!');
        return false;
    }
    var key = $("#key").val();
    if(key == ""){
        alert('아이디를 입력해주세요!');
        return false;
    }
    var sell_limit = $("#sell_limit").val();
    if(sell_limit == ""){
        alert('구매제한값을 입력해주세요!');
        return false;
    }

    var is_use = $("input[name='is_use']:checked").val();
    if(is_use == undefined){
        alert('사용상태를 선택해주세요!');
        return false;
    }

    var coinId = $('#id').val();
    var packet = {
      "id"                :   coinId,
      "type"              :   1,//0:change state 1: change info
      "is_use"            :   is_use,
      "kor_name"          :   kor_name,
      "key"               :   key,
      "name"               :   key,
      "sell_limit"        :   sell_limit,

      "user_id"           :   scope.userInfo.id,
      "user_password"     :   scope.userInfo.password,
    }
    SendPacket(PKT_ADMIN_CHANGE_COIN_STATE, JSON.stringify(packet));
  });