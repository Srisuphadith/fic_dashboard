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
function phase_data(id,name,surname){
    document.getElementById("id").value = id;
    document.getElementById("name").value = name;
    document.getElementById("surname").value = surname;
}
document.getElementById("defaultOpen").click();
$(document).ready(function(){
    window.scrollTo(0, 0);
    // $("#butt").click(function(){
    //     document.getElementById("id").value = document.getElementById("butt").value; 
    // });
    // $("#b2").click(function(){
      
    //     $.ajax({url: "user_query.php", success: function(result){
    //       $("#User").html(result);
    //     }});
    //   });
    $("#submit").click(function(){
        
        const id = document.getElementById("id").value;
        const name = document.getElementById("name").value;
        const surname = document.getElementById("surname").value;
        const role = document.getElementById("inputState").value;
        $.ajax({
            type: 'POST',
            url: 'update.php',
            data: { id: id, name: name,surname:surname,role:role },
            success: function(response) {
                console.log(response);
            }
        });
    });


  });
