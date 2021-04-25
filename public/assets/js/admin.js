$(document).ready(function () {
    
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
});