function clickCity(e,id) //отработка вибору міста окремою функцією завантажується до виклику
{
    $("#city").val(e.target.innerHTML);
    $("#cityId").val(id);
    $("#select").attr('class',"hidden");
}

function alertShow(id,message,attrclass) //показує алерт з відповідним id повідомленням та класом
{
    $(id).html(message);
    $(id).attr('class',attrclass);
    $(id).fadeIn("slow");
}


$(document).ready(function(){

    // Вешаем функцию на событие change и отправляем AJAX запрос с данными файлов

    $('#avatar_pre').change(function( event ){
        event.stopPropagation(); // Остановка происходящего
        event.preventDefault();  // Полная остановка происходящего

        var files = this.files; //получим імена файлів

        // Создадим данные формы и добавим в них данные файлов из files
        var data = new FormData();
        $.each( files, function( key, value ){
            data.append( key, value );
        });

        $.ajax({
            url: PATH+"api/user/loadAva?upload",
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){
                // Если все ОК
                var respond = JSON.parse(respond); //розвернемо відповідь
                if( typeof respond.error === 'undefined' )
                {
                    // Файлы успешно загружены, делаем что нибудь здесь
                    var files_path = respond.files;
                    console.log(respond.imginf); //показать тип зображення.
                    $("#alertAva").fadeOut("slow");
                    $('.img-responsive').attr('src',PATH+"avatares/"+files_path);//показуємо тимчасове зображення
                    $('#avauser').attr('value',files_path);
                }
                else
                {
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                    if (respond.error == 'isnotimage')
                    {
                        alertShow("#alertAva"," <strong>ERROR</strong> this is not a image File!","alert alert-danger");
                    }
                    else
                    {
                        alertShow("#alertAva"," <strong>ERROR</strong> unable to upload file!","alert alert-danger")
                    }
                }
            },
            error: function ( jqXHR, textStatus, errorThrown ){

                console.log('ОШИБКИ AJAX запроса: ' + textStatus );
            }
        });

    });



    $("#email").blur("input",function() //перевірка на наявність зареєстрованого користувача на виході з поля вводу
        {
            var email = $("#email").val();
            var url = PATH+"api/user/isExistUser?email="+email;
            $.get(url,function(data)
                {
                    if (JSON.parse(data))
                    {
                        $("#email_f").attr("class","form-group has-error");
                        $("#subtn").attr('disabled', true);
                        alertShow("#alertEmail","<strong>ERROR</strong> this address is exist","alert alert-danger");

                    }
                });
        }
    );

    $("#email").focus("input",function() //заходимо в поле скидуємо алерт
    {

        $("#alertEmail").fadeOut("slow");
        $("#subtn").attr('disabled', false);
        $("#email_f").attr("class","form-group");


    });

    $(":submit").focus("input",function() //перевірка на ідентичність та наявність паролів, наявність емейлу
    {
        var passb = $("#pass_b").val();
        var passa = $("#pass_a").val();
        if (passa!=passb)
        {
            $("#pass_f").attr("class","form-group has-error");
            $("#subtn").attr('disabled', true);
            alertShow("#alertPass","<strong>ERROR</strong> passwords is not equal","alert alert-danger");
        }
        if ((passa=="")||(passb==""))
        {
            $("#pass_f").attr("class","form-group has-error");
            $("#subtn").attr('disabled', true);
            alertShow("#alertPass","<strong>Please</strong> enter password","alert alert-warning");
        }
        if (($("#email").val())=="")
        {
            $("#email_f").attr("class","form-group has-error");
            $("#subtn").attr('disabled', true);
            alertShow("#alertEmail","<strong>Please</strong> enter eMail","alert alert-warning");
        }
    });

    $(":password").focus("input",function()
    {
        $("#alertPass").fadeOut("slow");
        $("#subtn").attr('disabled', false);
        $("#pass_f").attr("class","form-group");
    });


    
    $("#city").on("input",function() //випадаюче меню з інтерактивним списком міст
    {
        var inputVal = $("#city").val();
        var url = PATH+"api/city/getall?city="+inputVal;
        $.get(url,function(data)
        {
            $("#cityList").html("");
            var arr = JSON.parse(data);
            $("#select").attr('class',"");
            for (var i=0; i<arr.length; i++)
            {
             var city = arr[i];
                $("#cityList").append("<li class='cityName' onclick='clickCity(event,\""+city.id+"\")'>"+city.name+"</li>");
            }

        });

    });
/*
    $(".cityName").on("click",function() //вибір міста
    {
        var cityNameVal = $(this).text();
        $("#city").val()


    });*/

    $(".modalbtn").click(function(e) { //при нажатию на любую кнопку, имеющую класс .modalbtn викливається модальне вікно
        var id = e.target.id;// получаем ID
        if (id) {
            var myID = $("#" + id).attr("article_id"); //получить значение любого атрибута вьізвавшего ф-ю
            $("#id_article").attr('value',myID);
            $("#id_reply").attr('value',id);

            $("#modal").modal('show');
        }
    });

    $('#summernote').summernote(); //редактор для повідомлень


});

