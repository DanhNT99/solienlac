$(document).ready(function () {
    
    $('#formRestPass').slideUp(0);

    function closeNotiBox() {
        setTimeout(()=> {
            $('.notiBox').addClass('hideNotiBox');
        }, 5000)
    }
    closeNotiBox();
    
    $('.notiBoxBtn').click(function (e) { 
        e.preventDefault();
        $('.notiBox').addClass('hideNotiBox');
    });


//SHOW TEXT PASS 
    $('.hideEyes').slideUp(0);
    $('.showEyes').click(function (e) { 
        e.preventDefault();
        $(this).slideUp(0);
        $('.hideEyes').slideDown(0);
        let input = $(this).parent().prev();
        input.prop('type','text');
    });

    $('.hideEyes').click(function (e) { 
        e.preventDefault();
        $(this).slideUp(0);
        $('.showEyes').slideDown(0);
        let input = $(this).parent().prev();
        input.prop('type','password');
    });
//END
});