<?php

include 'ConectionDb.php';
include 'Util.php';

/**
 * Clase que contiene todas las operaciones utilizadas sobre la base de datos
 */
class ControllerInstitution {

    private $conexion, $CDB, $op, $id, $euid, $sdid;
    private $UTILITY;
    private $response;

    function __construct() {
        $this->CDB = new ConectionDb();
        $this->UTILITY = new Util();
        $this->conexion = $this->CDB->openConect();
        $rqst = $_REQUEST;
        $this->op = isset($rqst['op']) ? $rqst['op'] : '';
        $this->id = isset($rqst['id']) ? intval($rqst['id']) : 0;
        $this->ke = isset($rqst['ke']) ? $rqst['ke'] : '';
        $this->lu = isset($rqst['lu']) ? $rqst['lu'] : '';
        $this->ti = isset($rqst['ti']) ? $rqst['ti'] : '';
        if (!$this->UTILITY->validate_key($this->ke, $this->ti, $this->lu)) {
            $this->op = 'noautorizado';
        }
        if ($this->op == 'inssave') {
            $this->nombre = isset($rqst['nombre']) ? $rqst['nombre'] : '';
            $this->estado = isset($rqst['estado']) ? $rqst['estado'] : '';
            $this->email = isset($rqst['email']) ? $rqst['email'] : '';
            $this->url = isset($rqst['url']) ? $rqst['url'] : '';
            $this->fechainicio = isset($rqst['fechainicio']) ? $rqst['fechainicio'] : '';
            $this->fechafin = isset($rqst['fechafin']) ? $rqst['fechafin'] : '';
            $this->nit = isset($rqst['nit']) ? $rqst['nit'] : '';
            $this->telefono = isset($rqst['telefono']) ? $rqst['telefono'] : '';
            $this->pais = isset($rqst['pais']) ? $rqst['pais'] : '';
            $this->departamento = isset($rqst['departamento']) ? $rqst['departamento'] : '';
            $this->ciudad = isset($rqst['ciudad']) ? $rqst['ciudad'] : '';
            $this->direccion = isset($rqst['direccion']) ? $rqst['direccion'] : '';
            $this->inssave();
        } else if ($this->op == 'insget') {
            $this->insget();
        } else if ($this->op == 'insdelete') {
            $this->insdelete();
        } else if ($this->op == 'noautorizado') {
            $this->response = $this->UTILITY->error_invalid_authorization();
        } else {
            $this->response = $this->UTILITY->error_invalid_method_called();
        }
        //$this->CDB->closeConect();
    }

    /**
     * Metodo para guardar y actualizar
     */
    private function inssave() {
        $id = 0;
        if ($this->id > 0) {
            //actualiza la informacion
            $q = "SELECT ins_id FROM dhc_institucion WHERE ins_id = " . $this->id;
            $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
            while ($obj = mysql_fetch_object($con)) {
                $id = $obj->ins_id;
                $table = "dhc_institucion";
                $arrfieldscomma = array(
                    'ins_nombre' => $this->nombre,
                    'ins_estado' => $this->estado,
                    'ins_email' => $this->email,
                    'ins_url' => $this->url,
                    'ins_fecha_inicio' => $this->fechainicio,
                    'ins_fecha_fin' => $this->fechafin,
                    'ins_nit' => $this->nit,
                    'ins_telefono' => $this->telefono,
                    'ins_pais' => $this->pais,
                    'ins_departamento' => $this->departamento,
                    'ins_ciudad' => $this->ciudad,
                    'ins_direccion' => $this->direccion);
                $arrfieldsnocomma = array('ins_dtcreate' => $this->UTILITY->date_now_server());
                $q = $this->UTILITY->make_query_update($table, "ins_id = '$id'", $arrfieldscomma, $arrfieldsnocomma);
                mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
                $arrjson = array('output' => array('valid' => true, 'id' => $id));
            }
        } else {
            $q = "INSERT INTO dhc_institucion (ins_dtcreate, ins_nombre, ins_estado, ins_email, ins_url, ins_fecha_inicio, ins_fecha_fin, ins_nit, ins_telefono, ins_pais, ins_departamento, ins_ciudad, ins_direccion) VALUES (" . $this->UTILITY->date_now_server() . ", '$this->nombre', '$this->estado', '$this->email', '$this->url', '$this->fechainicio', '$this->fechafin', '$this->nit', '$this->telefono', '$this->pais', '$this->departamento', '$this->ciudad', '$this->direccion')";
            mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
            $id = mysql_insert_id();
            $arrjson = array('output' => array('valid' => true, 'id' => $id));
        }
        $this->response = ($arrjson);
    }

    public function insget() {
        $q = "SELECT * FROM dhc_institucion ORDER BY ins_nombre ASC";
        if ($this->id > 0) {
            $q = "SELECT * FROM dhc_institucion WHERE ins_id = " . $this->id;
        }
        $con = mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
        $resultado = mysql_num_rows($con);
        $arr = array();
        while ($obj = mysql_fetch_object($con)) {
            $arr[] = array(
                'id' => $obj->ins_id,
                'nombre' => ($obj->ins_nombre),
                'estado' => ($obj->ins_estado),
                'email' => ($obj->ins_email),
                'url' => ($obj->ins_url),
                'fechainicio' => ($obj->ins_fecha_inicio),
                'fechafin' => ($obj->ins_fecha_fin),
                'nit' => ($obj->ins_nit),
                'telefono' => ($obj->ins_telefono),
                'pais' => ($obj->ins_pais),
                'departamento' => ($obj->ins_departamento),
                'ciudad' => ($obj->ins_ciudad),
                'direccion' => ($obj->ins_direccion),
                'dtcreate' => ($obj->ins_dtcreate));
        }
        if ($resultado > 0) {
            $arrjson = array('output' => array('valid' => true, 'response' => $arr));
        } else {
            $arrjson = $this->UTILITY->error_no_result();
        }
        $this->response = ($arrjson);
    }

    private function insdelete() {
        if ($this->id > 0) {
            $q = "DELETE FROM dhc_institucion WHERE ins_id = " . $this->id;
            mysql_query($q, $this->conexion) or die(mysql_error() . "***ERROR: " . $q);
            $arrjson = array('output' => array('valid' => true, 'id' => $this->id));
        } else {
            $arrjson = $this->UTILITY->error_missing_data();
        }
        $this->response = ($arrjson);
    }

    public function getResponse() {
        $this->CDB->closeConect();
        return $this->response;
    }

    public function getResponseJSON() {
        $this->CDB->closeConect();
        return json_encode($this->response);
    }

    public function setId($_id) {
        $this->id = $_id;
    }

}

?>