documentos = {
    rows: [
        {id: "SI", descripcion: "Simple"},
        {id: "DE", descripcion: "Desglozado"},
        {id: "RTOTALESDESGLOSE", descripcion: "Totales Desglozado"}
    ]
};

$(function () {
    $("select[name='documentos']").selectpicker();
    loadCbo(documentos, "select[name='documentos']");
    $("div[Contribuyente] input[name='nombres']").val($("input[nombres]").val());    
    $("#tbUsuario").bootstrapTable(TablePaginationDefault);
    
    $("#generarReporte").click(function () {
        idusuario = "";
        if ($('#daterange-btn span').data("fecha") === undefined)
        {
            MsgError({
                title: "Advertencia",
                content: ["Escoja una fecha, por favor."]
            });
        } else
        {
            form = document.createElement("form");
            form.target = "_blank";
            form.method = "POST";
            form.action = getURL("_reporte");
            form.style.display = "none";
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = "datos";
            dt = {
                op: "RECAUDXUSUARIO",
                doc: $("select[name='documentos']").selectpicker("val"),
                idusuario: idusuario              
            };
            input.value = JSON.stringify($.extend({}, dt, {
                fechas: $('#daterange-btn span').data("fecha")
            }));
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    });
    $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Ultimo 7 dias': [moment().subtract(6, 'days'), moment()],
                    'Ultimo 30 dias': [moment().subtract(29, 'days'), moment()],
                    'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                    'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(MPrimera(start.format('MMMM D, YYYY')) + ' - ' + MPrimera(end.format('MMMM D, YYYY')));
                $('#daterange-btn span').data("fecha", {
                    inicio: start.format(fecha_format.save),
                    fin: end.format(fecha_format.save)
                });
            }
    );
    $("div[Contribuyente] button[clear]").click(function () {
        $("input[name='nombres']").val("");
        $("div[Contribuyente] input[name='id']").val("");
    });
});