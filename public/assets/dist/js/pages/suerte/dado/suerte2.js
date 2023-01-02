$(document).ready(function() {
    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });

    countdown();
    var start_time=setInterval('countdown()',1000);


    $('#dd_fecha').daterangepicker({
        "showDropdowns": true,
        "timePicker": true,
        "showWeekNumbers": true,
        "autoApply": true,
        "singleDatePicker": true,
        "startDate": moment().startOf('hour minute').add(5, 'minute'),
        "locale": {
            "format": "DD/MM/YYYY HH:mm:SS",
            "separator": " / ",
            "applyLabel": "OK",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizado",
            "weekLabel": "S",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        "linkedCalendars": false,
        "showCustomRangeLabel": false,
        "drops": "up"
    });
});

function countdown () {// Cuenta regresiva
    let segundos = $("#segundos").val();
    end_time = segundos; // Hora de finalización
    var curr_time = parseInt(Date.parse(new Date())/1000);
        var diff_time = parseInt (end_time-curr_time); // diferencia de tiempo de cuenta regresiva
    var h = Math.floor(diff_time / 3600);
    var m = Math.floor((diff_time / 60 % 60));
    var s = Math.floor((diff_time % 60));
    $("#timer").html(h + "hora" + m + "minuto" + s + "segundo");
    if (diff_time<=0) {
    $("#timer").html(0 + "Hora" + 0 + "Minuto" + 0 + "Segundo");
    };
    if(s==1)
    {
        window.location.reload();
    }
}

