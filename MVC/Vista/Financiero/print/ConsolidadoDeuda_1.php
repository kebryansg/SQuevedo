<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$user = $_SESSION["login"]["user"];
?>
﻿<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?php
        include '../../../../MVC/Vista/Recursos/styleComprobante.php';
        include '../../../../MVC/Vista/Recursos/scriptComprobante.php';
        ?>
        <style type="text/css">
            @page 
            {
                size:  auto;   /* auto es el valor inicial */
                margin: 10mm 0;  /* afecta el margen en la configuración de impresión */
                margin-left: 15mm;
                margin-right: 5mm;
            }
            @media print {
                /* Indicamos el salto de pagina */
                .saltoDePagina {
                    display: block;
                    page-break-before: always;
                }
            }
            .rhead {
                font-weight: bold;
            }
            #tbDatos td{
                padding-bottom: 1em;
            }

            hr.s10 {
                border-top: 1px dotted #8c8b8b;
                border-bottom: 0;
            }

        </style>
    </head>
    <body>
        <br>
        <div inicio></div>
        <div id="area" style="height: 1123px;width: 780px;">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h3 class="bold">DETALLE DE LA DEUDA</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-user"></i>
                                Contribuyente
                            </h3>
                        </div>
                        <div class="box-body" Contribuyente style="padding-bottom: 0px;padding-top: 5px;">
                            <table id="tbDatos" style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td class="rhead">Identificación</td>
                                        <td identificacion></td>
                                        <td class="rhead">Contribuyente</td>
                                        <td contribuyente></td>
                                    </tr>
                                    <tr>
                                        <td class="rhead">CIU</td>
                                        <td ciu></td>
                                        <td class="rhead">Categoría</td>
                                        <td categoria></td>
                                    </tr>
                                    <tr>
                                        <td class="rhead">Clave Agua</td>
                                        <td ccaapp></td>
                                        <td class="rhead">Clave Predio</td>
                                        <td ccprecio></td>
                                    </tr>
                                    <tr>
                                        <td class="rhead">Dirección</td>
                                        <td colspan="3" direccion></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h4 class="box-title">
                                <i class="fa fa-list"></i>
                                PERIODO DE LA DEUDA
                            </h4>
                        </div>
                        <div class="box-body" >
                            <div desglose>
                                <div class="row hidden" example style="margin-bottom: 10px;">
                                    <div class="col-xs-7">
                                        <table fechas>
                                            <thead>
                                                <tr>
                                                    <th data-field="fecha" data-align="center" >Año - Mes</th>
                                                    <th data-field="mes" data-align="center" >Cant. Mes</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-xs-5">
                                        <table valores>
                                            <thead>
                                                <tr>
                                                    <th data-field="detalle" >Detalle</th>
                                                    <th data-field="tarifa" data-align="right" >V. Unit.</th>
                                                    <th data-field="total" data-align="right" data-formatter="formatDolarMask" >V. Total</th>

                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <span class="pull-left bold" style="font-size: 15px;" mora ></span>
                                <span class="pull-right bold" style="font-size: 15px;" cobranza ></span>
                            </div>
                        </div>
                        <div class="box-footer with-border">
                            <span class="bold" style="font-size: 15px;">
                                Cant. Meses 
                                <i class="fa fa-slack"></i>
                                <span totalMeses></span>
                            </span>
                            <span class="box-title pull-right bold" style="color:red; font-size: 15px;">
                                Total
                                <i class="fa fa-dollar"></i>
                                <span total></span>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
            <div style="text-align: center;">             
                <span class="" usuario_firma ><b>EMITIDO POR: </b><?php echo $user["nombres"]; ?></span>            
            </div>         
        </div>
    </body>

    <script type="text/javascript">

        function formatMonthAbr(data) {
            fecha = moment(data, "YYYY-MM-DD HH:mm:ss");
            fechafor = fecha.format('MMM, YYYY');
            return MPrimera(fechafor);
        }
        function formatDolarMask(value, row, index) {
            return "$ " + formatInputMask(value);
        }

        function formatPorcentVal(value, row, index) {
            return formatInputMask(value) + " %";
        }

        rowActual = <?php echo $_POST["datos"]; ?>;

        rows = getJson({
            data: {
                op: "CONSOLIDADO.DEUDA",
                accion: "get",
                guia: rowActual.id
            },
            url: "../../../../" + getURL("_financiero")
        });

        permiso = ["AL", "ME", "EM"];

        detalles = {
            "AL": "Alcantarillado",
//            "MO": "Mora",
//            "CO": "Cobranza",
            "ME": "Tarifa",
            "EM": "Costo Fijo"
        };

        totalMeses = total = 0;
        //console.log(rows);

        $.each(rows, function (i, row) {
            div = $("div[example]").clone();
            $(div).removeClass("hidden");
            $(div).removeAttr("example");
            row.detalle = JSON.parse(row.detalle);
            items = [];
            subtotal = 0;
            mora = 0; 
            cobranza = 0;
            for (clave in row.tb) {
                // Solo permitidos    
                if (permiso.indexOf(clave) !== -1) {
                    subtotal += row.tb[clave];
                    items.push({
                        detalle: detalles[clave],
                        tarifa: formatDolarMask(row.detalle[clave]),
                        total: row.tb[clave]
                    });
                }
                mora += row.tb["MO"];
                cobranza += row.tb["CO"];

            }
            items.push({
                detalle: "SUBTOTAL",
                total: subtotal
            });
            fechas = {
                fecha: `${ formatMonthAbr(row.fini) } - ${ formatMonthAbr(row.ffin) }`,
                mes: row.mes
            };

            $(div).find("table[valores]").bootstrapTable({data: items});
            $(div).find("table[fechas]").bootstrapTable({data: [fechas]});


            $("div[desglose]").append(div);
            $("span[mora]").html(`Mora: ${ formatDolarMask(mora) }`);
            $("span[cobranza]").html(`Cobranza: ${ formatDolarMask(cobranza) }`);

            _row = row.tb;
            _row.total = roundNumber(_row.ME + _row.EM + _row.AL + _row.MO + _row.CO, 2);
            total += _row.total;
            totalMeses += convertFloat(row.mes);
            
        });
        $("span[total]").html(roundNumber(total, 2));
        $("span[totalMeses]").html(totalMeses);

        dt = getJson({
            data: {
                op: "GUIA",
                accion: "get",
                id: rowActual.id
            },
            url: "../../../../" + getURL("_guia")
        });
        for (clave in dt) {
            $("table tbody td[" + clave + "]").html(dt[clave]);
        }


        window.print();
        window.close();
    </script>
</html>