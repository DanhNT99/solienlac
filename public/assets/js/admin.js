$(document).ready(function () {

//HANLE SHOW IMAGES FOR CREATE STUDENT AND TEACH
    $('.adminFormAddContainsImg').click(function (e) { 
        e.preventDefault();
        $('.adminFormAddFileImg').click();
    });

    $('.adminFormAddFileImg').change(function (e) { 
        e.preventDefault();
        let fileName = $(this).prop('files')[0];
        let fileTypeImages = fileName.name.match(/\.(jpg|jpeg|png|gif)$/);
        console.log(fileTypeImages);
        switch(fileTypeImages) {
            case null: 
                $('.notiFileImg.hide').removeClass('hide'); break;
            default: 
                let fr = new FileReader();
                fr.addEventListener('load', function() {
                    $('.adminFormAddImg').attr('src', this.result);
                })
                fr.readAsDataURL(fileName);
                $('.notiFileImg').addClass('hide');
                break;
        }

    });
//END

//TOGGLE BOX TAB
    $('.adminMainTab').slideUp(0);
    $('.adminBoxTitleIconUp').click(function (e) { 
        e.preventDefault();
        let nextEle = $(this).parent().next();
        $(this).toggleClass('rotateIconUp');
        nextEle.slideToggle(500);
    });
//END

//SHOW AND HIDE NOTI BOX
    $('.notiBoxBtn').click(function (e) { 
        e.preventDefault();
        $('.notiBox').addClass('hideNotiBox');
    });

    function closeNotiBox() {
        setTimeout(()=> {
            $('.notiBox').addClass('hideNotiBox');
        }, 5000)
    }
    closeNotiBox();
//END


//CHANGE COLOR BTN SUBJECT ACTIVE
    $('.boxSubject').click(function (e) { 
        e.preventDefault();
        $(this).toggleClass('boxSubjectActive');
        if($(this).next().prop('checked')) {
            $(this).next().prop('checked', false);
        }
        else {
            $(this).next().prop('checked', true);
        }
    });
    if($('checkBox').prop('checked')) {
        $(this).prev().addClass('boxSubjectActive');
    }

    $('.boxLoad').hide();
//END


//CLEAR CHAR SPACE IN TEXT OF TEXTAREA
    $.fn.clearSpaceTextArea = function () {
         if( $(this).val()){
            let textAreaNoSpace = $(this).val().trim();
            $(this).val(textAreaNoSpace);
         }
    }
    $.each($('.textarea'), function (indexInArray, valueOfElement) { 
         $(valueOfElement).clearSpaceTextArea();
    });
//END

//NOTI CCONFIRM NEW PASSWORD
    $('.confirmPass').keyup(function (e) {
        console.log($(this).val());
        e.preventDefault();
        let valueNewPass = $('.newPass').val();
        let valueConfirmPass = $(this).val();
        switch(valueNewPass == valueConfirmPass) {
            case true: 
                    $('.iconConfirmTrue').addClass('iconConfirmShow'); break;
            default : 
                    $('.iconConfirmTrue').removeClass('iconConfirmShow'); break;
        }
    });
//END

//SHOW MODAL DELETE
    let idBtn;
    $('.btnButton').click(function (e) { 
        e.preventDefault();
        idBtn = $(this).attr('id');
    });

    $('.btnSubmit').click(function (e) { 
        $(`.formDelete${idBtn}`).submit();
    });
//END


//HANDLE IMPORT INFOR BY EXCEL
    $('.btnFormExcel').click(function (e) { 
        e.preventDefault();
        console.log('clicked');
        $('.formInputExcel').click();
    });

    $('.formInputExcel').change(function (e) { 
        e.preventDefault();
        $('.formImportExcel').submit();
    });
//END


//SHOW LIST HANDLE
    $('.boxHandleStudent').click(function (e) { 
        e.preventDefault();
        $('.listHandele').removeClass('showListHandele');
        $(this).children(".listHandele").toggleClass("showListHandele")
    });
//END

 
//CHANGE COLOR ACTIVE TAB 
    // $('.adminTabItemLink ').click(function (e) { 
     
    //     let getClass = '.'+ $(this).attr('class').split(' ')[0]
    //     let getIndex = $('.adminTabItemLink').index(this)
    //     let obj = {nameClass: getClass, index: getIndex}
    //     sessionStorage.setItem('objElement', JSON.stringify(obj))
    // });
    // function changeColorActiveTab() {
    //     let obj = JSON.parse(sessionStorage.getItem('objElement'))
    //     if(obj) {
    //         $($(obj.nameClass)[obj.index]).addClass('adminMainTabBgColor')
    //     }

    // }
    // changeColorActiveTab();


    // $(window).on('load', function () {
    //     let path = location.pathname.substr(1);
    //     path = `[href='${path}']`;
    //     $(path).addClass('adminMainTabBgColor')
    // })
//END

//HANDLE SHORT TEXT NHAN XET ON TD
    $.fn.shortText = function () {
        //lấy dữ liệu ra làm ngắn dữ liệu lại và cập nhật lại
        let content = $(this).html().trim();
        if(content.length > 20) {
            content = content.substr(0, 20) +'... ';
        }
        $(this).html(content)
    }
    $.each($('.containNhanXet'), function (indexInArray, valueOfElement) { 
        $(valueOfElement).shortText();
    });
//END

//CHECK ALL CHECKBOX STUDENT
    $('.input-group').click(function (e) { 
        e.preventDefault();
        let checkBox = $(this).find('.inputCheckAll');
        checkBox.prop('checked', !checkBox.prop('checked'));
        let checked = $(this).find('.inputCheckAll').is(":checked");
        switch(checked) {
            case true: $('.checkBoxStudent').prop('checked', true); break;
            case false: $('.checkBoxStudent').prop('checked', false); break;
        }
    });
//END

//HANDLE NOTI ENTER SOCRE

    $('.Diem').blur(function (e) { 
        e.preventDefault();
        let valInputScore = $(this).val();
        let convertScoreNumber = Number(valInputScore); // GET VALUE INPUT NUMBER
    //CHECK NUMBER FORM 1 TO 10
        if(convertScoreNumber < 1 || convertScoreNumber > 10) {
            $(this).next().text('Điểm chỉ được phép nhập từ 1 tới 10').removeClass('hide');
        }
    //CHECK NUMBER IS TYPE INT
        let numberTypeInt = convertScoreNumber === parseInt(convertScoreNumber, 10);
        if(!numberTypeInt) {
            $(this).next().text('Điểm không được là số thập phân').removeClass('hide');
        }

    //CHECK USER HAVE ENTER SCORE
        if(valInputScore == "") {
            $(this).next().text('Vui lòng nhập điểm').removeClass('hide');
        }
    });

//END

});
