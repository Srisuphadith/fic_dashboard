function openCity(evt, page) {
    window.scrollTo(0, 0);
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(page).style.display = "block";
    evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();

function phase_data(id, name, surname) {
    document.getElementById("id").value = id;
    document.getElementById("name").value = name;
    document.getElementById("surname").value = surname;
}

$(document).ready(function () {
    window.scrollTo(0, 0);



    $("#b2").click(function () {
        $.ajax({ url: "user_query.php", success: function (data) { $("#user").html(data); } });
    });
    $("#b3").click(function () {
        $.ajax({ url: "status_query.php", success: function (data) { $("#content_status").html(data); } });
        $.ajax({ url: "sensor_query.php", success: function (data) { $("#content_sensor").html(data); } });
    });
    $("#re_status").click(function () {
        $.ajax({ url: "status_query.php", success: function (data) { $("#content_status").html(data); } });
        $.ajax({ url: "sensor_query.php", success: function (data) { $("#content_sensor").html(data); } });
    });
    $("#butt").click(function () {
        document.getElementById("id").value = document.getElementById("butt").value;
    });

    $("#submit").click(function () {

        const id = document.getElementById("id").value;
        const name = document.getElementById("name").value;
        const surname = document.getElementById("surname").value;
        const role = document.getElementById("inputState").value;
        $.ajax({
            type: 'POST',
            url: 'update.php',
            data: { id: id, name: name, surname: surname, role: role },
            success: function (response) {
                console.log(response);
                $.ajax({ url: "user_query.php", success: function (data) { $("#user").html(data); } });
            }
        });
    });


});
