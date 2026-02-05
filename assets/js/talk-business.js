jQuery(document).ready(function($){
    // Show button after scroll
    $(window).on('scroll', function(){
        if($(window).scrollTop() > 200){
            $('#tb-float-btn').fadeIn();
        }
    });

    // Open modal
    $('#tb-float-btn').on('click', function(){
        $('#tb-overlay').fadeIn();
        $('#tb-modal').css('animation', 'tbSlideDown .5s ease forwards');
    });

    // Close modal
    $('#tb-close').on('click', function(){
        $('#tb-overlay').fadeOut();
    });

    // AJAX form submit
    $('#tb-form').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: tb_vars && tb_vars.ajax_url ? tb_vars.ajax_url : '<?php echo admin_url("admin-ajax.php"); ?>',
            method: 'POST',
            data: form.serialize() + '&action=tb_mail',
            success: function(){
                form.find('.tb-success').fadeIn();
                setTimeout(function(){
                    form[0].reset();
                    $('#tb-overlay').fadeOut();
                    form.find('.tb-success').fadeOut();
                },2000);
            }
        });
    });
});
