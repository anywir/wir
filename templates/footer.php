<footer class="navbar navbar-inverse navbar-fixed-bottom">
    <div class="container-fluid">
        <span class="navbar-text">(C)2016 wir</span>
    </div>

</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="<?=SITE?>lib/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=SITE?>lib/summernote/summernote.min.js"></script>

<script language="javascript">

   $(document).ready(function(){
//при нажатию на любую кнопку, имеющую класс .modalbtn
       $(".modalbtn").click(function(e) {
           var id = e.target.id;// получаем ID
           if (id) {
               var myID = $("#" + id).attr("article_id"); //получить значение любого атрибута вьізвавшего ф-ю
               $("#id_article").attr('value',myID);
               $("#id_reply").attr('value',id);

               $("#modal").modal('show');
           }
       });
       $('#summernote').summernote();
   });

</script>

</div>
</body>
</html>