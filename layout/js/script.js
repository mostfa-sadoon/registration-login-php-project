$('.form-page h1 span').click(function(){
    $(this).addClass('selected').siblings().removeClass('selected');
    $('.form-page form').hide();
    $('.' +$(this).data('class')).fadeIn(100);
 
 });
 $('.live-name').keyup(function()
 {
   $('.live-preview h5').text($(this).val());
 });
 $('.live-description').keyup(function()
 {
   $('.live-preview  .description').text($(this).val());
 });
 $('.live-price').keyup(function()
 {
   $('.live-preview  .price').text($(this).val());
 });
  