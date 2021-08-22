
$(document).ready(function () {

//API FILTER CLASS BY GRADE
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


    // $('#khoi').change(function (e) { 
    //     e.preventDefault();
    //     //get id of grade
    //     let id  = {'id' : $(this).val()};
    //     //call funciton filterClasss
    //         filterClass(id);
    // });

    // if($('#khoi').val()) {
    //     filterClass({'id' : $('#khoi').val()})
    // }
//EMD

//GET CODE SEMESTER BY NIENKHOA
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
                console.log(response['count']);
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
                    alert('Niên khóa này đã đủ 2 học kì')
                }
            }
        });
    }
//END

//API FILTER STUDENT BY CLASS
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
                let listStudent = response['hs'].map(hocsinh => {
                    return `<tr class = "trAddByClass"><td><input type="text" class="d-none solienlac" name="idHocSinh[]" value = ${hocsinh['id']} > ${hocsinh['HoHS']} ${hocsinh['TenHS']}</td>
                                <td><input type="text" name="MucDatDuoc[]" class="formInput"></td>
                                <td><input type="text" name="Diem[]" class="formInput"></td></tr>`
                });
                $('.trAddByClass').remove();
                $('.tableListStudent').append(listStudent.join(''));
            }
        });
    });

    // $('#lop').change(function (e) { 
    //     e.preventDefault();
    //     let id = {'id' : $(this).val()}
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type: "post",
    //         url: "http://127.0.0.1:8000/api/filterStudent",
    //         data: id,
    //         success: function (response) {
    //             let stt = 1;
    //             console.log(response['hs']);
    //             let listStudentByClass = response['hs'].map(item => {
    //                 return ` <tr class = 'trRemove'>
    //                         <td>${stt++}</td>
    //                         <td>${item['MaHS']}</td>
    //                         <td>${item['HoHS']} ${item['TenHS']}</td>
    //                         <td>${item['TenLop']} </td>
    //                         <td>${response['nienkhoa']['NamBatDau']} - ${response['nienkhoa']['NamKetThuc']}</td>
    //                         <td>
    //                             <a href="admin/hoc/${item['id_hocsinh']}/edit"><i class="fas fa-edit"></i></a>
    //                             <form action="{{route('hoc.destroy','')}}/${item['id_hocsinh']}" method = "post" class="adminFormAdd {{'formDelete' . $item->id}} d-inline" >
    //                                 @method('DELETE') @csrf
    //                             <button type="button" class="bg-none border-0 btnButton" id="{{$item->id}}" data-toggle="modal" data-target="#exampleModal">
    //                               <i class="fas fa-trash text-danger"></i>
    //                             </button>
    //                         </form>
    //                         </td>
    //                 </td>
    //             </tr>`
    //             });
    //             $('.trRemove').remove();
    //             $('.adminTable').append(listStudentByClass);
    //             console.log(listStudentByClass);

    //         }
    //     });
    // });
//END


//FILTER SCORE BY SUBJECT AND TYPE SEMESTER

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
                // console.log(response['nhapdiem1'], response['nhapdiem2']);
                if(response['nhapdiem1'] || response['nhapdiem2']) {
                    $('.Diem').removeClass('formInputMa');
                }
                else {
                    $('.Diem').addClass('formInputMa');
                }
            }
        });
    }
//END

//FILTER RATING BY pcnl AND TYPE SEMESTER
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
                let listRating = $('.xeploai'); //get dom input have name = "XepLoai[]"
        
                $.each( listIdSll, function (indexInArray, valueOfElement) { 
                    $(listRating[indexInArray]).val('');
                    response.forEach(element => {
                        //check solienlac
                         if($(listIdSll[indexInArray]).val() == element['id_sll']){
                            let getRating = element['XepLoai']
                            //GET LIST OPTION OF SELCT
                            console.log(getRating);
                            let listOption = $(listRating[indexInArray]).children("option");
                            listOption.removeAttr('selected').filter(`[value = "${getRating}"]`).prop('selected', true);
                        }
                    });
                });
            }
        });
  
    }
//END

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
//END


//API DELET ALL
    $("[name = 'deleteList']").click(function (e) { 
        e.preventDefault();
        let array = [];
        if(confirm('Bạn có chắc xóa không?')) {
            $.each($('.checkBoxStudent'), function (indexInArray, valueOfElement) { 
                let checked = $(valueOfElement).prop('checked');
                if(checked) {
                    array.push($(valueOfElement).val());
                }
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "http://127.0.0.1:8000/api/removeAll",
                data: {array},
                success: function (response) {
                    location.reload()
                }
            });
        }

    });
//END
});