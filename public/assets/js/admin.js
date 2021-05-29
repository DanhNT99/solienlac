$(document).ready(function () {

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


    $('.btnActi').click(function (e) { 
        e.preventDefault();
        let NumberPhone = $('.NumberPhone');
        console.log($(NumberPhone[1]).val().length);
        // if($(NumberPhone[0]).val().length < 10 || $(NumberPhone[0]).val().length > 11) {
        //     $(NumberPhone[0]).next().text('Số điện thoại phải từ 10 đến 11 số')
        //     $(NumberPhone[0]).next().removeClass('hide');
        // }
        // if($(NumberPhone[1]).val().length < 10 || $(NumberPhone[1]).val().length > 11) {
        //     console.log('true')
        //     $(NumberPhone[1]).next().text('Số điện thoại phải từ 10 đến 11 số')
        //     $(NumberPhone[1]).next().removeClass('hide');
        // }
        $.each( NumberPhone, function (index, value) { 
           if($(NumberPhone[index]).val().length < 10 || $(NumberPhone[index]).val().length > 11 || 
              $(NumberPhone[index + 1]).val().length < 10 || $(NumberPhone[index + 1]).val().length > 11) {
            $(NumberPhone[index]).next().text('Số điện thoại phải từ 10 đến 11 số')
               $(value).next().removeClass('hide');
           }
           else {
                $('.adminFormAdd').submit();
           }
        });
    });
    // $(window).click(function (e) { 
    //     e.preventDefault();
    //     let clickNameClass =  '.' + e.target.className;
    //     console.log(clickNameClass);
    //     let checkNameClass = $(clickNameClass).hasClass('trContainsBox') ||$(clickNameClass).hasClass('tdContainsBox');
    //     console.log(!checkNameClass);
    //     if(checkNameClass) {
    //         $('.tdBoxDrop').removeClass('showTdBoxDrop');
    //     }
    // });
    // $('.trContainsBox').click(function () { 
    //     $(this).find('.tdBoxDrop').toggleClass('showTdBoxDrop');
    // });

});
