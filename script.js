$(document).ready(function()
{


$('a').on('click',function(e)
{
  if(this.hash != '')
  {
    e.preventDefault();
    const hash = this.hash;
    console.log(hash);
    $('html,body').animate(
      {
        scrollTop:$(hash).offset().top-50
      },800);
      
  }
});


$('.scrollbutton').on('click',function(e)
{
  console.log("kirti");
})



$('.scrollbutton').on('click',function(e)
{
  console.log("kirti");
  e.preventDefault();
  $('html,body').animate(
    {
      scrollTop:$('#categories').offset().top-50
    },800
  );
});


$('.home').on("click", function(e) {
  e.preventDefault();  
  window.location.href = 'index.php'; 
});


$('.home-page-class').on('click',function()
{
  window.location.href = 'index.php';
})















});