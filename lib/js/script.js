function clickCity(e,id) //отработка вибору міста окремою функцією завантажується до виклику
{
    $("#city").val(e.target.innerHTML);
    $("#cityId").val(id);
}

$(document).ready(function(){

    // Переменная куда будут располагаться данные файлов

    var files;

// Вешаем функцию на событие
// Получим данные файлов и добавим их в переменную

    $('input[type=file]').change(function(){
        files = this.files;
    });

    // Вешаем функцию ан событие change и отправляем AJAX запрос с данными файлов

    $('#avatar').change(function( event ){
        event.stopPropagation(); // Остановка происходящего
        event.preventDefault();  // Полная остановка происходящего

        // Создадим данные формы и добавим в них данные файлов из files

        var data = new FormData();

        $.each( files, function( key, value ){
            data.append( key, value );
        });

        // Отправляем запрос
        //var url = PATH+"api/user/isExistUser?email
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
                    // ======== выведем пути к загруженным файлам в блок '.ajax-respond'
                    /*
                    var files_path = JSON.parse(respond).files;
                    var html = '';
                    $.each( files_path, function(key,  val ){
                        html += val +'<br>';
                    });
                    $('.ajax-respond').html( html );
                    */
                    //==============
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
            for (var i=0; i<arr.length; i++)
            {
             var city = arr[i];
                $("#cityList").append("<li class='cityName' onclick='clickCity(event,"+city.id+")'>"+city.name+"</li>");
            }

        });

    });

    $(".cityName").on("click",function() //вибір міста
    {
        var cityNameVal = $(this).text();
        $("#city").val()

    });

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

