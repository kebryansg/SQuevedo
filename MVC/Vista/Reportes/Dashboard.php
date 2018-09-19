<?php
session_start();
$fecha = json_decode($_SESSION["login"]["fecha"], TRUE)["fecha"];
?>
<!DOCTYPE html>
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <hr class="style8">
</section>
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-3">
            <div class="info-box">
                <span class="info-box-icon bg-purple-active">
                    <i class="fa fa-user-circle"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Contribuyente(s)</span>
                    <span class="info-box-number" contribuyente></span>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="info-box">
                <span class="info-box-icon bg-purple-active">
                    <i class="fa fa-user-circle"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">N° Contribuyente(s) en Juicio C.</span>
                    <span class="info-box-number" contribuyente_jc></span>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-xs-3">
            <div class="info-box">
                <span class="info-box-icon bg-red">
                    <i class="fa fa-balance-scale"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Registro de Juicio(s)</span>
                    <span class="info-box-number" jc></span>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="info-box">
                <span class="info-box-icon bg-red">
                    <i class="fa fa-balance-scale"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Registro de Juicio(s) - <b Mes></b> </span>
                    <span class="info-box-number" jc_mes_actual></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <div class="info-box">
                <span class="info-box-icon bg-olive">
                    <i class="fa fa-map-marker"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Guía(s)</span>
                    <span class="info-box-number" guias></span>
                </div>
            </div>
        </div>
        
        <div class="col-xs-3">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fa fa-file-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Solicitud Permiso(s) Conexión</span>
                    <span class="info-box-number" sol_pconexion></span>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="recurso/Vista/Reportes/Dashboard.js" type="text/javascript"></script>
<script type="text/javascript">
    fecha = fechaMoment('<?php echo $fecha; ?>', fecha_format.save);
    $("b[Mes]").html(fecha.format('MMMM').toUpperCase());
</script>