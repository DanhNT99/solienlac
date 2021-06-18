
$(document).ready(function () {

    //api filter table class by khối
    function filterClass(obj) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "http://127.0.0.1:8000/api/filterClass",
            data: obj,
            success:function(response) {
                let listClass = response['Class'].map(item => {
                    return `<option class = "formBoxSelectOption" value = ${item['id']}>${item['TenLop']}</option>`;
                })
                $('.formBoxSelectOption').remove();
                $('#lop').append(listClass.join(''));
            }
        });
    }
    if($('#khoi').val()) {
        filterClass({'id' : $('#khoi').val()})
    }
    // filterClass({'id' : $('#khoi').val()})
    $('#khoi').change(function (e) { 
        e.preventDefault();
        //get id of grade
        let id  = {'id' : $(this).val()};
        //call funciton filterClasss
            filterClass(id);
      });


    //get ma hoc ky by niên khóa
    $('#nienkhoa').change(function () { 

        let id  = {'id' : $(this).val()};
        getCodeSemester(id);
    });

    function getCodeSemester(obj) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "http://127.0.0.1:8000/api/getMaHK",
            data: obj,
            success:function(response) {
                let indexKeyK = response['nienkhoa']['MaNK'].search('K') + 1;
                let year = response['nienkhoa']['MaNK'].substring(indexKeyK);
                if(response['count'] >= 0 && response['count'] < 2) {
                        response['count'] += 1;
                    //CODE SEMESTER FOR CASE HAVE 0 AND 1 HỌC KỲ LÀ 1
                        let ma = 'HK' + year + '0' +  response['count'];
                    //CODE SEMESTER FOR CASE HAVE 1 HỌC KỲ LÀ 2
                        if(response['hocky']) {
                            if(response['hocky']) {
                                //GET LAST KEYCHAR OF CODE SEMESTER
                                let maHK = response['hocky']['MaHK'].substring( response['hocky']['MaHK'].length - 1);
                                if(maHK == 2) {
                                    maHK =  parseInt(maHK) - 1;
                                    ma = 'HK' + year + '0' + maHK;
                                }
                            }
                        }
                        $('.filterMaHK').val(ma);
                }else {
                    alert('Năm học này đã đủ 2 học kỳ. Vui lòng chọn năm học khác')
                }
            }
        });
    }
    
    //api filter student by class
    $('#lop').change(function (e) { 
        e.preventDefault();
        let id = {'id' : $(this).val()}
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "http://127.0.0.1:8000/api/filterStudent",
            data: id,
            success: function (response) {
                let listStudent = response['hocsinh'].map(hocsinh => {
                    return `<tr class = "trAddByClass"><td><input type="text" class="d-none solienlac" name="idHocSinh[]" value = ${hocsinh['id']} > ${hocsinh['HoHS']} ${hocsinh['TenHS']}</td>
                                <td><input type="text" name="MucDatDuoc[]" class="formInput"></td>
                                <td><input type="text" name="Diem[]" class="formInput"></td></tr>`
                });
                $('.trAddByClass').remove();
                $('.tableListStudent').append(listStudent.join(''));
            }
        });
    });

    //fillter score by subject and semester
    $('#subject').change(function (e) { 
        e.preventDefault();
        //check user selected semester?
        if($('#loaiHK').val()) {
            let id = {'idSubject' : $(this).val(), 'idSemester' : $('#loaiHK').val()};
            if($('#khoi').val())
                id = {'idSubject' : $(this).val(), 'idSemester' : $('#loaiHK').val(), 'idGrade': $('#khoi').val()};
            getScore(id);
        }

    });

    $('#loaiHK').change(function (e) { 
        e.preventDefault();
        //check user selected subject?
        if($('#subject').val()) {
            let id = {'idSubject' : $('#subject').val(), 'idSemester' : $(this).val()};
            if($('#khoi').val())
                id = {'idSubject' :  $('#subject').val(), 'idSemester' : $('#loaiHK').val(), 'idGrade': $('#khoi').val()};
            getScore(id);
        }
        //check user selected pcnl?
        if($('#pcnl').val()) {
            let id = {'idSemester' : $(this).val(), 'idPCNL' : $('#pcnl').val()};
            getRating(id);
        }

    
    });
    
    function getScore(obj) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "http://127.0.0.1:8000/api/filterScore",
            data: obj,
            success: function (response) {
            //GET DOM HTML BY CLASS
                let listMucDatDuoc = $('.MucDatDuoc'); //HTML SELECT
                let listDiem = $('.Diem'); //HTML INPUT
                let listIdSll = $('.solienlac'); //HTML INPUT
            //END
            //GET INOUT IN LITST INPUT
                $.each( listIdSll, function (indexInArray, valueOfElement) { 

                        $(listMucDatDuoc[indexInArray]).val('');
                        $(listDiem[indexInArray]).val('');
                    //GET DATA FROM CONTROLLER SEND
                        response['kqht'].forEach(element => {
                        //CHECK INPUT SLL WITH IDSLL?
                            if($(listIdSll[indexInArray]).val() == element['id_sll']){
                                let mucDatDuc = element['MucDatDuoc']; //GET VALUE MUCDATDUOC BY IDSLL
                                let diem = element['Diem']; //GET VALUE SCORE BY IDSLL
                            //GET LIST OPTION OF SELCT
                                let listOption = $(listMucDatDuoc[indexInArray]).children("option");
                                listOption.removeAttr('selected').filter(`[value= ${mucDatDuc}]`).prop('selected', true);
                            //ADD VALUE SCORE TO INPUT
                                $(listDiem[indexInArray]).val(diem);
                            }
                        });
                });
                console.log(response['nhapdiem1'], response['nhapdiem2']);
                if(response['nhapdiem1'] || response['nhapdiem2']) {
                    $('.Diem').removeClass('formInputMa');
                }
                else {
                    $('.Diem').addClass('formInputMa');
                }
            }
        });
    }

    //end

    //filter rating by pcnl and semester
    $('#pcnl').change(function (e) { 
        e.preventDefault();
        //check user selected semester?
        if($('#loaiHK').val()) {
            let id = {'idPCNL' : $(this).val(), 'idSemester' : $('#loaiHK').val()};
            getRating(id);
        }
    });
    
    function getRating(obj) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "http://127.0.0.1:8000/api/filterRating",
            data: obj,
            success: function (response) {
                let listIdSll = $('.solienlac'); //get dom input have name = "solienlac[]"
                let listRating = $('.XepLoai'); //get dom input have name = "XepLoai[]"
        
                $.each( listIdSll, function (indexInArray, valueOfElement) { 
                    response.forEach(element => {
                        //check solienlac
                         if($(listIdSll[indexInArray]).val() == element['id_sll']){
                                 let getRating = element['XepLoai']
                            //GET LIST OPTION OF SELCT
                                let listOption = $(listRating[indexInArray]).children("option");
                                listOption.removeAttr('selected').filter(`[value= ${getRating}]`).prop('selected', true);
                            //ADD VALUE SCORE TO INPUT
                        }
                        // console.log(getRaing);
                    });
                });
            }
        });
  
    }
    //enter score for student


    //FILTER RATING BY DIEM
    // $('.Diem').change(function (e) { 
    //     e.preventDefault();
    //     let listRating = $('.MucDatDuoc');
    //     let index = $('.Diem').index($(this));
    //     console.log($(this).val())
    //     if($(this).val())
    //         $(listRating[index]).addClass('formInputMa');
    //     else 
    //         $(listRating[index]).removeClass('formInputMa');
    //     let diem = {'diem': $(this).val()}
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type: "post",
    //         url: "http://127.0.0.1:8000/api/filterRatingByScore",
    //         data: diem,
    //         success: function (response) {
    //             $.each(listRating[index], function (indexInArray, ElementOption) { 
    //                 //UPDATE ALL OPTION SELECT IS FALSE
    //                 $(ElementOption).attr('selected', false);
    //                   //CHECL VALUE OPTION WITH MUCDATDUOC
    //                if( $(ElementOption).val() === response) {
    //                    //ADD ATTRIBUTE TO OPTION
    //                     $(ElementOption).attr('selected', true);
    //                }
    //                console.log(response)
    //             });
    //         }
    //     });
    // });


    //GET SEMESTER BY NIEN KHOA
    $('#yeaOfCourse').change(function () {
        let id = {'idYearOfCourse' : $(this).val()}
        getSemester(id);
    })

    function getSemester(obj) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "http://127.0.0.1:8000/api/filterSemester",
            data: obj,
            success: function (response) {
                let  listSemester = [`<option class = "formBoxSelectOption" selected disabled>Không có</option>`];
                if(response['semester'].length) {
                     listSemester = response['semester'].map(item => {
                        return `<option class = "formBoxSelectOption" value = ${item['id']}>${item['TenHK']}</option>`;
                    })
                }

                $('.formBoxSelectOption').remove();
                $('#semester').append(listSemester.join(''));
                $('.codeTypeSemester').val(response['codeTypeSemester']);
            }
        });
    }

    // $('.btnSubmit').click(function (e) { 
    //    $('.formDelete').submit();
    // }); 
    let idBtn;
    $('.btnButton').click(function (e) { 
        e.preventDefault();
        idBtn = $(this).attr('id');
    });

    $('.btnSubmit').click(function (e) { 
        $(`.formDelete${idBtn}`).submit();
    }); 

    // $('.btnSubject').click(function (e) { 
    //     e.preventDefault();
    //     $('.btnSubject').removeClass('boxSubjectActive');
    //     $(this).addClass('boxSubjectActive');
    //     let inputValue = $(this).next().val();
    //     console.log(inputValue);
    //     let idSubject  = {'idSubject': $(this).next().val(), 'idClass' : $('.inputClass').val()}
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type: "post",
    //         url: "http://127.0.0.1:8000/api/filterScoreBySubject",
    //         data: idSubject,
    //         success: function (response) {
    //             let kqht = response['kqht'];
    //             let loaihocky = response['loaihocky'];
    //             $.each(loaihocky, function (indexInArray, loaihk) { 
    //                  $kqht = kqht.map(item=> {
    //                      return `<td>${item['TenHS']}</td>`;
    //                  })
    //                  console.log($kqht);
    //             });
    //         }
    //     });
    // });



    $('.btnFormExcel').click(function (e) { 
        e.preventDefault();
        $('.formImprotExcel').click();
    });

    $('.formImprotExcel').change(function (e) { 
        e.preventDefault();
        if($(this).val()) {
            $('.formImportExcel').submit();
        }
    });

});