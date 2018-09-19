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
            .rhead{
                font-weight: bold;
            }
            #tbDatos td{
                padding-bottom: 1em;
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
                            <h3 class="box-title pull-right bold" style="color:red;">
                                <span pag></span>
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
                <!--<div class="col-xs-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-list"></i>
                                PERIODO DE LA DEUDA
                            </h3>
                        </div>
                        <div class="box-body">
                            <table detalle>
                                <thead>
                                    <tr>
                                        <th data-field="año" data-align="center">Año</th>
                                        <th data-field="Meses" data-align="center">Meses</th>
                                        <th data-field="cantMes" data-align="center" class="col-md-1">Cant. Mes</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>-->
                <div class="col-xs-12">
                    <div class="box box-info" Cobranza dr="COBROMENSUALJC">
                        <div class="box-body row">
                            <div class="col-xs-12">
                                <table tbValores id="tbValores" >
                                    <thead>
                                        <tr>
                                            <th data-field="fechas" >Detalle</th>
                                            <th data-field="meses" data-align="center" >Mes(s)</th>
                                            <th data-field="ME" data-halign="center" data-align="right" data-formatter="formatDolarMask" >Tarifa</th>
                                            <th data-field="EM" data-halign="center" data-align="right" data-formatter="formatDolarMask" >Costo Fijo</th>
                                            <th data-field="AL" data-halign="center" data-align="right" data-formatter="formatDolarMask" >Alcant.</th>
                                            <th data-field="MO" data-halign="center" data-align="right" data-formatter="formatDolarMask" >Mora</th>
                                            <th data-field="CO" data-halign="center" data-align="right" data-formatter="formatDolarMask"  >Cobranza</th>
                                            <th data-field="total" data-halign="center" data-align="right" data-formatter="formatDolarMask" >Total</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-danger" Cobranza dr="COBROMENSUALJC">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Cant. Meses 
                                <i class="fa fa-slack"></i>
                                <span totalMeses></span>
                            </h3>
                            <span class="box-title pull-right bold" style="color:red;">
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
        
        $("#tbValores").bootstrapTable();
        totalMeses = total = 0;
        console.log(rows);
        rows.reverse();

        $.each(rows, function (i, row) {
            _row = row.tb;
            _row.fechas =  `${ formatMonth(row.fini) } - ${ formatMonth(row.ffin) }`;
            _row.meses = row.mes;
            _row.total = roundNumber(_row.ME + _row.EM + _row.AL + _row.MO + _row.CO, 2);
            total += _row.total;
            totalMeses += convertFloat(row.mes);
            $("#tbValores").bootstrapTable("prepend", _row);
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