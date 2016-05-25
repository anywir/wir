function clickCity(e,id)
{

    $("#city").val(e.target.innerHTML);
    $("#cityId").val(id);
}



$(document).ready(function(){

    $("#city").on("input",function()
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

    $(".cityName").on("click",function()
    {
        var cityNameVal = $(this).text();
        $("#city").val()

    });

    $(".modalbtn").click(function(e) { //при нажатию на любую кнопку, имеющую класс .modalbtn
        var id = e.target.id;// получаем ID
        if (id) {
            var myID = $("#" + id).attr("article_id"); //получить значение любого атрибута вьізвавшего ф-ю
            $("#id_article").attr('value',myID);
            $("#id_reply").attr('value',id);

            $("#modal").modal('show');
        }
    });
    $('#summernote').summernote(); //


});

