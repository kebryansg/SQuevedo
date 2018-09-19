<?php

class Calculator {

    public static function _calcularPeriodo($tarifario, $mes, $estado) {
        $resultado = [];
        $subtotal = 0;
        //set @DESC = IF(getVal(tarifario, 'DESC') = 0, 1 , (getVal(tarifario, 'DESC') / 100));
        $DESC = $tarifario["DESC"] = 0 ? 1 : 1 - ($tarifario["DESC"] / 100);

        array_push($resultado, array(
            "descripcion" => "Emisión",
            "valor" => $tarifario["EM"],
            "total" => $tarifario["EM"] * $mes
        ));
        array_push($resultado, array(
            "descripcion" => "Mensualidad",
            "valor" => $tarifario["ME"] * $DESC,
            "total" => ($tarifario["ME"] * $DESC) * $mes
        ));
        array_push($resultado, array(
            "descripcion" => "Alcantarillado",
            "valor" => $tarifario["AL"],
            "total" => round((($tarifario["ME"] * $DESC) * $mes) * ( $tarifario["AL"] / 100 ), 2)
        ));
        if (!intval($estado)) {
            $subtotal = array_reduce($resultado, function($a, $b) {
                return $a + $b["total"];
            }, 0);
            //sum = dtTableFP.reduce((a, b) => a + b.valor, 0);

            array_push($resultado, array(
                "descripcion" => "Mora",
                "valor" => $tarifario["MO"],
                "total" => round(($subtotal) * ( $tarifario["MO"] / 100 ), 2)
            ));

            array_push($resultado, array(
                "descripcion" => "Cobranza",
                "valor" => $tarifario["CO"],
                "total" => round(($subtotal) * ( $tarifario["CO"] / 100 ), 2)
            ));
        }
        return $resultado;
    }

    public static function _totales($tarifario, $mes, $estado) {
//        $resultado = array();
        $DESC = $tarifario["DESC"] = 0 ? 1 : 1 - ($tarifario["DESC"] / 100);
        $resultado = array(
            "EM" => $tarifario["EM"] * $mes,
            "ME" => ($tarifario["ME"] * $DESC) * $mes,
            "AL" => round((($tarifario["ME"] * $DESC) * $mes) * ( $tarifario["AL"] / 100 ), 2)
        );

        if (!intval($estado)) {
            $subtotal = $resultado["EM"] + $resultado["ME"] + $resultado["AL"];
            $resultado["MO"] = round(($subtotal) * ( $tarifario["MO"] / 100 ), 2);
            $resultado["CO"] = round(($subtotal) * ( $tarifario["CO"] / 100 ), 2);
        }
        return $resultado;
    }

    public static function _obtenerPeriodo($tarifario, $mes) {
        $impuesto = $valores = [];
        $DESC = $tarifario["DESC"] = 0 ? 1 : 1 - ($tarifario["DESC"] / 100);

        $valores["EM"] = $tarifario["EM"] * $mes;
        $valores["ME"] = ($tarifario["ME"] * $DESC) * $mes;
        $valores["AL"] = round((($tarifario["ME"] * $DESC) * $mes) * ( $tarifario["AL"] / 100 ), 2);


        $subtotal = $valores["EM"] + $valores["ME"] + $valores["AL"];
        //sum = dtTableFP.reduce((a, b) => a + b.valor, 0);


        $valores["MO"] = round(($subtotal) * ( $tarifario["MO"] / 100 ), 2);
        $valores["CO"] = round(($subtotal) * ( $tarifario["CO"] / 100 ), 2);

        return $valores;
    }

//    public static function _obtenerPeriodo($tarifario, $mes) {
//        $impuesto = $valores = [];
//        $DESC = $tarifario["DESC"] = 0 ? 1 : 1 - ($tarifario["DESC"] / 100);
//
//        array_push($valores, array(
//            "descripcion" => "Emisión",
//            "valor" => $tarifario["EM"],
//            "total" => $tarifario["EM"] * $mes
//        ));
//        array_push($valores, array(
//            "descripcion" => "Mensualidad",
//            "valor" => $tarifario["ME"] * $DESC,
//            "total" => ($tarifario["ME"] * $DESC) * $mes
//        ));
//        array_push($valores, array(
//            "descripcion" => "Alcantarillado",
//            "valor" => $tarifario["AL"],
//            "total" => round((($tarifario["ME"] * $DESC) * $mes) * ( $tarifario["AL"] / 100 ), 2)
//        ));
//        $subtotal = array_reduce($valores, function($a, $b) {
//            return $a + $b["total"];
//        }, 0);
//        //sum = dtTableFP.reduce((a, b) => a + b.valor, 0);
//
//        array_push($impuesto, array(
//            "descripcion" => "Mora",
//            "valor" => $tarifario["MO"],
//            "total" => round(($subtotal) * ( $tarifario["MO"] / 100 ), 2)
//        ));
//
//        array_push($impuesto, array(
//            "descripcion" => "Cobranza",
//            "valor" => $tarifario["CO"],
//            "total" => round(($subtotal) * ( $tarifario["CO"] / 100 ), 2)
//        ));
//        return array(
//            "valores" => $valores,
//            "impuesto" => $impuesto
//        );
//    }
}
