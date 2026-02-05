jQuery(document).ready(function($){

    // Show button on scroll
    $(window).on('scroll', function(){
        if($(window).scrollTop() > 200){
            $('#tb-float-btn').fadeIn();
        }
    });

    // Open modal
    $('#tb-float-btn').on('click', function(){
        $('#tb-overlay').fadeIn();
    });

    // Close modal
    $('#tb-close').on('click', function(){
        $('#tb-overlay').fadeOut();
    });

    // AJAX submit
    $('#tb-form').on('submit', function(e){
        e.preventDefault();

        let form = $(this);

        $.ajax({
            url: tb_ajax.ajax_url,
            type: 'POST',
            data: form.serialize() + '&action=tb_mail',
            success: function(){
                form.find('.tb-success').fadeIn();

                setTimeout(function(){
                    form[0].reset();
                    $('#tb-overlay').fadeOut();
                    form.find('.tb-success').hide();
                },2000);
            }
        });
    });

});
