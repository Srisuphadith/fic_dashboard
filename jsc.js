function openCity(evt, page){
    var i , tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("content");
    for(i=0;i<tabcontent.length;i++){
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for(i=0;i<tablinks.length;i++){
        tablinks[i].className = tablinks[i].className.replace(" active","");
    }
    document.getElementById(page).style.display = "block";
    evt.currentTarget.className +=" active";   
}
document.getElementById("defaultOpen").click();
$(document).ready(function(){

    $("#b2").click(function(){
        $.ajax({url: "user_debug.php", success: function(result){
          $("#User").html(result);
        }});
      });


  });
