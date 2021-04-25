$(document).ready(function () {
    
    $('.tab_listItem').click(function (e) { 
        e.preventDefault();
        $('.tab_listItem').removeClass('tab_listItemActive');
        $(this).addClass('tab_listItemActive');
    });

    $('.tab_listItem:nth-child(1)').click(function (e) { 
        e.preventDefault();
        let indexStudent = $('.student').offset().top - $('.tab').height();
        $('html, body').animate({scrollTop: indexStudent}, 1000);
    });

    $('.tab_listItem:nth-child(2)').click(function (e) { 
        e.preventDefault();
        let indexScores = $('.scores').offset().top - $('.tab').height();
        $('html, body').animate({scrollTop: indexScores}, 1000);
    });

    $('.tab_listItem:nth-child(3)').click(function (e) { 
        e.preventDefault();
        let indexPractise = $('.practise').offset().top - $('.tab').height();
        $('html, body').animate({scrollTop: indexPractise}, 1000);
    });



    // $(window).scroll(function() {
    //     if($(window).scrollTop() > 10) {
    //         $('.tab').addClass('tab_fixed');
    //     }
    // }) 

});