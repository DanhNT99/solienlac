$(document).ready(function () {
    $('.adminContainsFormSearch').slideUp(1000);
    $('.adminBoxTitleIconUp').click(function (e) { 
        e.preventDefault();
        let nextEle = $(this).parent().next();
        $(this).toggleClass('rotateIconUp');
        nextEle.slideToggle(500);
    });

    $('.adminFormAddContainsImg').click(function (e) { 
        e.preventDefault();
        $('.adminFormAddFileImg').click();
    });

    $('.adminFormAddFileImg').change(function (e) { 
        e.preventDefault();
        let fileName = $(this).prop('files')[0];
        if(fileName) {
            let fr = new FileReader();
            fr.addEventListener('load', function() {
                 $('.adminFormAddImg').attr('src', this.result);
            })
            fr.readAsDataURL(fileName);
        }
    });

    
    function closeNotiBox() {
        setTimeout(()=> {
            $('.notiBox').addClass('hideNotiBox');
        }, 2000)
    }
    closeNotiBox();


    $('.notiBoxBtn').click(function (e) { 
        e.preventDefault();
        $('.notiBox').addClass('hideNotiBox');
    });
});