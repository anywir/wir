function clickCity(e,id) //отработка вибору міста окремою функцією завантажується до виклику
{
    $("#city").val(e.target.innerHTML);
    $("#cityId").val(id);
}

$(document).ready(function(){

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

