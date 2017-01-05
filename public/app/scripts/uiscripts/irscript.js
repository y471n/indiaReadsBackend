// header
function dropDown() {
  console.log('s');
  // $('.alCatDD').on('click',function(event) {
    console.log('see');
      $('.alCatDD').parent('div').siblings('.mainLink').toggle();
      $('.alCatDD').siblings('.pCatCont').slideToggle('fast');
    // });
    // $('.pCatDD').on('click',function(event) {
      // $('.pCatDD').parent('div').siblings('.pCat').toggle();
      
    // }); 
}

function pCatDD1() {
  // $('.pCatDD').parent('div').siblings('.pCat').toggle();
  // row = $('#' + id_f);
  // var this.id = id_f;
  $('#literaturedd1').siblings('.cCatCont').slideToggle('fast');
  // $(id).siblings('.cCatCont').slideToggle('fast');
}
function pCatDD2() {
  // $('.pCatDD').parent('div').siblings('.pCat').toggle();
  // row = $('#' + id_f);
  // var this.id = id_f;
  $('#literaturedd2').siblings('.cCatCont').slideToggle('fast');
  // $(id).siblings('.cCatCont').slideToggle('fast');
}
function pCatDD3() {
  // $('.pCatDD').parent('div').siblings('.pCat').toggle();
  // row = $('#' + id_f);
  // var this.id = id_f;
  $('#literaturedd3').siblings('.cCatCont').slideToggle('fast');
  // $(id).siblings('.cCatCont').slideToggle('fast');
}
function pCatDD4() {
  // $('.pCatDD').parent('div').siblings('.pCat').toggle();
  // row = $('#' + id_f);
  // var this.id = id_f;
  $('#literaturedd4').siblings('.cCatCont').slideToggle('fast');
  // $(id).siblings('.cCatCont').slideToggle('fast');
}
function pCatDD5() {
  // $('.pCatDD').parent('div').siblings('.pCat').toggle();
  // row = $('#' + id_f);
  // var this.id = id_f;
  $('#literaturedd5').siblings('.cCatCont').slideToggle('fast');
  // $(id).siblings('.cCatCont').slideToggle('fast');
}
function pCatDD6() {
  // $('.pCatDD').parent('div').siblings('.pCat').toggle();
  // row = $('#' + id_f);
  // var this.id = id_f;
  $('#literaturedd6').siblings('.cCatCont').slideToggle('fast');
  // $(id).siblings('.cCatCont').slideToggle('fast');
}function pCatDD7() {
  // $('.pCatDD').parent('div').siblings('.pCat').toggle();
  // row = $('#' + id_f);
  // var this.id = id_f;
  $('#literaturedd7').siblings('.cCatCont').slideToggle('fast');
  // $(id).siblings('.cCatCont').slideToggle('fast');
}
function pCatDD8() {
  // $('.pCatDD').parent('div').siblings('.pCat').toggle();
  // row = $('#' + id_f);
  // var this.id = id_f;
  $('#literaturedd8').siblings('.cCatCont').slideToggle('fast');
  // $(id).siblings('.cCatCont').slideToggle('fast');

}


$(window).bind('scroll',function(){
  var windowPosY = $(window).scrollTop();
  var widthscreen = $( window ).width();
  if( windowPosY > 100 && widthscreen > 768){
  $('.h3NavSticky').css({'position':'fixed'}).slideDown('fast');
  }else{
  $('.h3NavSticky').hide();
  }
});
