function clickCity(e,id) //отработка вибору міста окремою функцією завантажується до виклику
{
    $("#city").val(e.target.innerHTML);
    $("#cityId").val(id);
    $("#select").attr('class',"hidden");
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
            url: PATH+"api/images/loadAvatar?uploadfiles",
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
            success: function( respond, textStatus, jqXHR ){

                // Если все ОК
                //alert(respond);
                if( typeof respond.error === 'undefined' ){
                    // Файлы успешно загружены, делаем что нибудь здесь
                    var files_path = JSON.parse(respond).files;
                    $('.img-responsive').attr('src',PATH+"avatares/"+files_path);
                    $('#avauser').attr('value',files_path);
                }
                else{
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                }
            },
            error: function ( jqXHR, textStatus, errorThrown ){
                console.log('ОШИБКИ AJAX запроса: ' + textStatus );
            }
        });

    });



    $("#email").change("input",function() //перевірка на наявність зареєстрованого користувача
        {
            var email = $("#email").val();
            var url = PATH+"api/user/isExistUser?email="+email;
            $.get(url,function(data)
                {
                    if (JSON.parse(data))
                    {
                        $("#email_f").attr("class","form-group has-error");
                        $("#alert").fadeIn("slow");
                    }
                    else
                    {
                        $("#alert").fadeOut("slow");
                        $("#email_f").attr("class","form-group");


                    }

                });
        }
    );


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

