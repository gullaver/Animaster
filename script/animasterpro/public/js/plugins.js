$(document).ready(function()
{
/* Start Navbar */
/* End Navbar */

/* Start Latest Episodes */
/*
$('.card-container').hover(function()
{
    $(this).find('.layerx').toggleClass('layerxvisible');
    $(this).find('.layerx').find('.btn-primary').toggleClass('d-none');
})
*/
/* End Latest Episodes */

/* Start Page Load */
$(window).on('load', function(){

    $('.pageload').fadeOut(1000);

});
/* End Page Load */
//Adjust series sizes
var winwidth= window.innerWidth
var seriesinfo = $(".seriesinfo").height();
var other_episodes = $(".other_episodes").height();

if(winwidth > 991)
{
    if(seriesinfo > other_episodes)
    {
        $('.other_episodes').css("height", seriesinfo +"px");
    }
    else if(seriesinfo < other_episodes)
    {
        $('.seriesinfo').css("height", other_episodes +"px");
    }

}

    //Select video server
    $('.servers .row a').on('click', function(e)
    {

        console.log('hello');
        e.preventDefault();
        console.log($(this).data("class"));

        $('.view_vid').html('');

        $('.view_vid').html($(this).data("class"));

    });


});