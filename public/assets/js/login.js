$(document).ready(function () {
    
    $('#formRestPass').slideUp(0);

    $('.wrapLogin__formLink').click(function (e) { 
        e.preventDefault();
        $('#formLogin').slideUp(0);
        $('#formRestPass').slideDown(0);
    });

    $('.wrapLogin__ContainsBtnLink').click(function (e) { 
        e.preventDefault();

        $('#formRestPass').slideUp(0);
        $('#formLogin').slideDown(0);
    });

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
});