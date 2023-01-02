$(document).ready(function() {
    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });

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

function agregar_insumo() {
    error = 0;
    let cara = $("#cara").val();
    let linea = $("#linea").val();
    linea = +linea + 1;
    $("#linea").val(linea);

    $("#tblCaras").append(`
                <tr id="tr-${linea}">
                    <td>
                        <input type="hidden" name="cara[]" value="${cara}"/>
                        ${cara}
                    </td>
                    <td><button type="button" class="btn-danger" onclick="eliminar_cara(${linea})">
                        <i class="far fa-trash-alt"></button></td>
                </tr>
            `);
};

function eliminar_cara(linea) {
    $("#tr-" + linea).remove();
}
