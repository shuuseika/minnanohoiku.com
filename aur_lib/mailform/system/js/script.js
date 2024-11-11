// 関連する項目の表示・入力制御
if(Object.keys(relationItems).length > 0) {
  //console.log(relationItems);
  var relatinParentArray = [];
  
  // 紐付け先の要素を取得
  for(var i in relationItems) {
    relatinParentArray[i] = [];

    for(var j in relationItems[i]['relationItems']) {
      var relationParent = document.querySelectorAll('.input_' + j + ' *[id^=form]');
      
      if(relationParent) relatinParentArray[i].push(relationParent);
    }
  }

  // イベントハンドラー
  for (var i in relatinParentArray) {
    for (var j in relatinParentArray[i]) {
      relatinParentArray[i][j].forEach(function (element) {
        element.addEventListener('change', displayRelationItem(i), false);
      });
    }
  }
}

function displayRelationItem(indexName) {
  return function() {
    var enableFlag = false;
    var relationOperator = relationItems[indexName]['relationOperator'];
    var andFlag = false;
    
    for(var i in relatinParentArray[indexName]) {
      var parents = relatinParentArray[indexName][i];
      
      parents.forEach(function (element) {
        if (element.type === 'radio') {
          var checkedItem = document.querySelector('[name="' + element.name + '"]:checked');
          if(element.value && relationItems[indexName]['relationItems'][element.name].indexOf(checkedItem.value) !== -1) {
            document.querySelector('.input_' + indexName).classList.remove('relation_item');
            enableFlag = true;
          } else if (relationOperator === 'and') {
            andFlag = true;
          }
        } else if (element.type === 'checkbox') {
          var checkedItem = document.querySelectorAll('[name="' + element.name + '"]:checked');
          var checkedFlag = false;
          for(var k=0;k<checkedItem.length;k++) {
            if(relationItems[indexName]['relationItems'][element.name.replace(/\[\]/g,'')].indexOf(checkedItem[k].value) !== -1) {
              checkedFlag = true;
              break;
            }
          }
          if(checkedFlag) {
            document.querySelector('.input_' + indexName).classList.remove('relation_item');
            enableFlag = true;
          } else if (relationOperator === 'and') {
            andFlag = true;
          }
        } else if (element.type.match(/select/)) {
          if(element.value && relationItems[indexName]['relationItems'][element.name].indexOf(element.value) !== -1) {
            document.querySelector('.input_' + indexName).classList.remove('relation_item');
            enableFlag = true;
          } else if (relationOperator === 'and') {
            andFlag = true;
          }
        } else {
          if(element.value) {
            document.querySelector('.input_' + indexName).classList.remove('relation_item');
            enableFlag = true;
          } else if (relationOperator === 'and') {
            andFlag = true;
          }
        }
      });
    }

    if (andFlag || !enableFlag) initRelationItem(indexName);
  }
}

function inputCheckClear(node) {
  for(var i=0;i<node.length;i++) {
    if(node[i].type === 'radio' || node[i].type === 'checkbox') node[i].checked = false;
    else node[i].value = '';
  }
}
function initRelationItem(indexName) {
  var element = document.querySelector('.input_' + indexName);
  if(element) element.classList.add('relation_item');
  var inputs = document.querySelectorAll('.input_' + indexName + ' *[id^=form]');
  inputCheckClear(inputs);
}

// file input用のボタン
function fileUpload(element) {
  var id = element.id;
  var fileId = id.replace(/_btn/g,'');
  var fileElement = document.getElementById(fileId);
  if (fileElement) {
    fileElement.click();
    fileElement.addEventListener('change', renamePlaceholder(fileElement), false);
  }
}
// プレースホルダーのテキストを書き換え
function renamePlaceholder(fileElement) {
  return function() {
    var files = fileElement.files;
    var filename = files[0].name;
    var filetextId = fileElement.id + '_text';
    var filetext = document.getElementById(filetextId);
    if (filetext) filetext.innerHTML = filename;
  }
}