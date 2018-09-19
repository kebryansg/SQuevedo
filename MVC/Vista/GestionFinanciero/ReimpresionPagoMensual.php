<!DOCTYPE html>
<section class="content-header">
    <h1>
        Reimpresión Pago Mensual
    </h1>
    <hr class="style8">
</section>
<section class="content container-fluid">
    <div Registro>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-user"></i>
                            Contribuyente
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" Contribuyente>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group form-group-sm">
                                    <label for="" class="control-label">Identificación</label>
                                    <div class="searchComponent">
                                        <input name="id" type="text" class="hidden" readonly>
                                        <input name="detalleContribuyente" type="text" class="form-control" required readonly style="width: 60%;margin-right:10px;">
                                        <button type="button" class="btn btn-info btn-sm" style="margin-right:5px;" data-toggle="modal" data-target="#modal-contribuyente">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <button clear type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div table>
                            <table 
                                id="tbDetalleGuia"
                                data-ajax="tbDetalleGuiasxContribuyente"
                                data-query-params="fn_query">
                                <thead>
                                    <tr>
                                        <th data-field="lugar">Localización</th>
                                        <th data-field="ccaapp">Clave Agua</th>
                                        <th data-field="categoria" class="col-md-1">Categoría</th>
                                        <!--<th data-field="estado">Habilitada</th>-->
                                        <th data-field="descuento" data-formatter="formatNumPorcent" data-align="center" class="col-md-1">Descuento</th>
                                        <th data-field="MesUltimoPago" class="col-md-2" data-align="center">Mes Último Pago</th>

                                        <th data-field="ccpredio" class="col-md-1" data-align="center">Clave Predio</th>
                                        <th data-field="cMes" class="col-md-1" data-align="center" data-formatter="cMesformat">Cant. Mes (es)</th>
                                        <th data-field="jc" class="col-md-1" data-formatter="estadoJC" data-align="center">Juicio Cobranza</th>
                                        <th data-field="estadoDeuda" class="col-md-1" data-align="center" data-formatter="btnDetalle" data-events="evtSelect" >Acción</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row hidden" new>
        <div class="flex-column">
            <div class="flex-row">
                <div class="col-md-7">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-user"></i>
                                Detalle Pagos Mensuales
                            </h3>
                        </div>
                        <div class="box-body">
                            <table 
                                data-toolbar="#toolbar"
                                id="tbDetalleMensualidad"
                                data-ajax="tbDetMensualidad"
                                data-query-params="fnParams"
                                data-height="280">
                                <thead>
                                    <tr>
                                        <th data-field="fecha" data-align="center" class="col-md-2" data-formatter="formatViewComp">Fecha</th>
                                        <th data-field="fechamensualidad" data-align="center">Mensualidad</th>
                                        <th data-field="tipo" data-align="center" data-formatter="fnTipo">Tipo</th>
                                        <th data-field="cMes" data-align="center" class="col-md-1">Cant. Mes</th>
                                        <th data-field="valor" data-align="center">Valor</th>
                                        <th data-align="center" data-formatter="btnAccion" data-events="evtSelect">Acción</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
<!--                        <div class="box-footer">
                            <div class="pull-right">
                                <button clean  class="btn btn-sm btn-danger"><i class="fa fa-reply"></i> Cancelar</button>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="col-md-4 hidden" exec Reimpresion>
                    <div class="box box-info" >
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-dollar-sign"></i>
                                Reimpresión de comprobante
                            </h3>
                            <span class="box-title pull-right bold" style="color:red;">
                                TOTAL ($) <span id="totalRI" total></span>
                            </span>
                        </div>
                        <div class="box-body">
                            <table id="tbFormaPago">
                                <thead>
                                    <tr>
                                        <th data-field="descripcion">Forma de Pago</th>
                                        <th data-field="valor" data-formatter="imask" data-events="event_input" data-align="center" class="col-md-3">Valor</th>
                                        <th data-field="detalle" class="col-md-2" data-formatter="defaultInput" data-events="event_input_default">N° Comprobante</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="box-footer">
                            <div class="pull-right">
                                <button cleanReimpresion type="button" class="btn btn-danger btn-sm">
                                    <i class="fa fa-reply"></i> Cancelar
                                </button>
                                <button print type="button" class="btn btn-primary btn-sm">
                                    <i class="fa fa-save"></i> Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade in" id="modal-contribuyente" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-search"></i> Buscar Contribuyente</h4>
            </div>
            <div class="modal-body">
                <table
                    id="tbContribuyente"
                    class="table table-striped table-bordered table-hover"
                    init
                    data-ajax="tbContribuyentes">
                    <thead>
                        <tr>
                            <th data-field="nombre">Nombre</th>
                            <th data-field="cedula">Identificación</th>
                            <th data-field="direccion" data-formatter="reducirText">Dirección</th>
                            <th data-formatter="btnSelect" data-events="evtSelect" class="col-md-1">Selec.</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="recurso/Vista/GestionFinanciero/ReimpresionPagoMensual.js" type="text/javascript"></script>