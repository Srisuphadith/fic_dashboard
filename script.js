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
function phase_json_to_input(jdata) {
    const obj = JSON.parse(jdata);
    const pump_max_temp = obj["pump_max_temp"];
    const pump_min_temp = obj["pump_min_temp"];
    const pump_max_humi = obj["pump_max_humi"];
    const fan_min_temp = obj["fan_min_temp"];
    const fan_min_humi = obj["fan_min_humi"];
    document.getElementById("pump_max_temp").value = pump_max_temp;
    document.getElementById("pump_min_temp").value = pump_min_temp;
    document.getElementById("pump_max_humi").value = pump_max_humi;
    document.getElementById("fan_min_temp").value = fan_min_temp;
    document.getElementById("fan_min_humi").value = fan_min_humi;
}
$(document).ready(function () {
    window.scrollTo(0, 0);
    $.ajax({
        url: "parameter_query.php", success: function (data) {
            phase_json_to_input(data);
        }
    });
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
    $("#update_parameter").click(function () {
        const pump_max_temp = document.getElementById("pump_max_temp").value;
        const pump_min_temp = document.getElementById("pump_min_temp").value;
        const pump_max_humi = document.getElementById("pump_max_humi").value;
        const fan_min_temp = document.getElementById("fan_min_temp").value;
        const fan_min_humi = document.getElementById("fan_min_humi").value;
        $.ajax({
            type: 'POST',
            url: 'parameter.php',
            data: { pump_max_temp: pump_max_temp, pump_min_temp: pump_min_temp, pump_max_humi: pump_max_humi, fan_min_temp: fan_min_temp, fan_min_humi: fan_min_humi },
            success: function (response) {
                //console.log(response);
                alert("Update successfully");
                $.ajax({
                    url: "parameter_query.php", success: function (data) {
                        phase_json_to_input(data);
                    }
                });
            }
        });

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
                //console.log(response);
                $.ajax({ url: "user_query.php", success: function (data) { $("#user").html(data); } });
            }
        });
    });


});
