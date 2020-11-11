$(document).ready(function()
{

// CSRF Preparation
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//Check Current Password - Update Informatio
$('#current_em_password').on('keyup', function()
{
    $.ajax(
        {
        type:'post',
        url: '/cp_chk_pwd',
        data: {current_pwd: $('#current_em_password').val()},
        success:function(resp)
        {
            if(resp =='true')
            {
                $('#current_em_password').css('border-color', 'MediumSeaGreen')
            }
            else
            {
                $('#current_em_password').css('border-color', 'tomato')
            }

        },error:function()
        {
            alert('Error');
        }

    });
});
//Check Current Password - Update Password
$('#oldpassword').on('keyup', function()
{
    $.ajax(
        {
        type:'post',
        url: '/cp_chk_pwd_ch',
        data: {current_pwd: $('#oldpassword').val()},
        success:function(resp)
        {
            if(resp =='true')
            {
                $('#oldpassword').css('border-color', 'MediumSeaGreen');
            }
            else
            {
                $('#oldpassword').css('border-color', 'tomato');
            }

        },error:function()
        {
            alert('Error');
        }

    });

});

$('#removeAdminImage').on('click', function()
{
    $.ajax(
        {
        type:'post',
        url: '/cp_profimage_rm',
        success:function(resp)
        {
            if(resp =='true')
            {
                location.reload();
            }
            else
            {
                $('#oldpassword').css('border-color', 'tomato');
            }

        },error:function()
        {
            alert('Error');
        }

    });

});


//Add Subcategories fields
    $('.createSubCates').click(function(){

        $('.inputs').append('<div class="inputsub"><input type="text" class="form-control" id="subcatename" name="subcatename[]" placeholder="Enter sub-categorey name"><a class="btn btn-sm btn-primary rmSubCates"><i class="fas fa-minus text-white"></i></a></div>');

    });

//Remove Subcategories fields
    $(document).on('click', '.rmSubCates',function(){

        $(this).closest('div').remove();

    });

//Show Subcategories in post creation
    $('.catelist').on('change', function(e)
    {
        var catename = $(this).val();
        $('.subcatelist').html("");

        $.ajax
        ({

            type: 'POST',
            url: '/showsubcategories',
            data: {catename: catename},
            success:function(resp)
            {
                $('.subcatelist').append("<option disabled selected value> -- select an option -- </option>");
                for(var i=0; i<resp.length; i++)
                {
                    $('.subcatelist').append("<option>"+resp[i]+"</option>");
                }
            },
            error:function(resp)
            {
                alert('Error');
            }

        })

    })

//Remove video btn from Text Editor
    $('.note-icon-video').parent().remove();

//Video upload way choose
    $('#choose-btn-1').on('click', function(){

        $('.video-link input').val('');
        $('.video-link').removeClass('sop').fadeOut(1);
        $('.upload-video').fadeIn(300).addClass('sop');

        if($('#dwoption').val() === 'Yes' && $('.video-link').hasClass('sop'))
        {
            $('.downlink-div').fadeIn(300);
        }
        else
        {
            $('.downlink-div').fadeOut(1);
        }

    });

    $('#choose-btn-2').on('click', function()
    {

        $('.upload-video input').val('');
        $('.upload-video').removeClass('sop').fadeOut(1);
        $('.video-link').fadeIn(300).addClass('sop');

        if($('#dwoption').val() === 'Yes' && $('.video-link').hasClass('sop'))
        {
            $('.downlink-div').fadeIn(300);
        }
        else
        {
            $('.downlink-div').fadeOut(1);
        }

    });

//Show 'Enter download link box'
    $('#dwoption').on('change', function(){

        if($('#dwoption').val() === 'Yes' && $('.video-link').hasClass('sop'))
        {
            $('.downlink-div').fadeIn(300);
        }
        else
        {
            $('.downlink-div').fadeOut(1);
        }

    });

//Image upload way choose
$('#choose_img-btn-1').on('click', function(){

    $('.image-link input').val('');
    $('.image-link').removeClass('sop').fadeOut(1);
    $('.upload-image').fadeIn(300).addClass('sop');

});

$('#choose_img-btn-2').on('click', function()
{

    $('.upload-image input').val('');
    $('.upload-image').removeClass('sop').fadeOut(1);
    $('.image-link').fadeIn(300).addClass('sop');

});

    //Show reply sender message
    $('#replymessage').on('click', function(e)
    {
        e.preventDefault();

        $(this).parent('form').html('');


    });

});