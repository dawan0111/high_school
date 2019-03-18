/*
  map-marker
*/
function mapMarker(){
  var positionObj = $('.position');
  var markermove = function(pos){
    if(pos[0]=='') return false;

    $('#marker').css({
      'left'  : (pos[0]-10)+"px",
      'top'   : (pos[1]-31)+"px"
    });
    positionObj.val(pos[0]+', '+pos[1]);
  }
  markermove(positionObj.val().split(','));
  $('#map').on('mouseup', function(e){
    markermove([e.offsetX, e.offsetY])
  });
}


/*
  order 위치토글
*/
var chkNum;
function posToggle(){
  $('.custom-switch-input').on('click', function(e){
    thisNum = $('.custom-switch-input').index($(this));
    if(chkNum === thisNum){
      $(this).prop('checked', false);
      chkNum = '';
    }else{
      chkNum = thisNum;
    }
  });
}


/*
  order 검색토글
*/
var chkNum1;
function searchToggle(){
  $('.custom-controls-stacked input').on('click', function(e){
    thisNum = $('.custom-controls-stacked input').index($(this));
    if(chkNum1 === thisNum){
      $(this).prop('checked', false);
      chkNum1 = '';
    }else{
      chkNum1 = thisNum;
    }
  });
}


/*
  수량input
 */
function qt(){
  $('.qt').on('change keyup', function(){
    if($(this).val() == 0){
      $(this).val(1);
    }
   var sumPrice = $(this).parent().prev().data('price') * $(this).val();
   $(this).parent().next().find('.price').val(sumPrice);
  });
}

function loc(url) {
  location.href = url;
};

$(function() {
  $(".ok-btn").on("click", function() {
    var val = $(this).prev().val();
    location.href = '?user='+val;
  });
})