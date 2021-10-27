<?php

require "Conexion.php";

//$login = array("cedula"=>"108756315","password"=>"");

class Consultar extends ConexionBD
{

    public function __construct(){
        parent::__construct();
        
    }

    public function getDates($consulta){
        
        $resultados=$this->conexion->query($consulta);
        
        if($resultados=$this->conexion->query($consulta)) {
            $info=$resultados->fetch_all(MYSQLI_ASSOC);
            return $info;
        }else{
            $info=false;
            return $info;
        }

    }
    
}


class Insertar extends ConexionBD
{
    private $table;
    private $campos = "";
    private $info="";
    //private $condiccion = array("atributo" => "","valor" => "");

    public function __construct($tabla){
        parent::__construct();
        $this->table=$tabla;
        /*$this->condiccion['atributo']=$atributo;
        $this->condiccion['valor']=$valor;*/
    }

    public function add($campo,$valor){
        if ($this->campos!="") {
            $this->campos.=",";
            $this->info.=",";
        }

        $valor = $this->conexion->real_escape_string($valor);

        $this->campos.=$campo;
        $this->info.="'".$valor."'";
    }

    public function ready($directo=""){
        $ejecutar;

        if ($this->campos!="" and $directo=="") {

            $insertar="INSERT INTO $this->table ($this->campos) values 
            ($this->info)";

            //$ejecutar = mysqli_query($conexion,$insertar);
            $ejecutar = $this->conexion->prepare($insertar);

            if ($ejecutar) {
                echo "Datos registrados ";
                $ejecutar->execute();
            }else{
                echo "ERROR: No se pudo hacer la insercion debido a inconsistensias en los datos<br>";
               // echo "ERROR: ".$this->conexion->error." : ".$insertar;
            }

        }else{
            $ejecutar = $this->conexion->prepare($directo);

            if ($ejecutar) {
                echo "Datos registrados ";
                $ejecutar->execute();
            }else{
                echo "ERROR: No se pudo hacer la insercion debido a inconsistensias en los datos<br>";
                //echo "ERROR: ".$this->conexion->error." : ".$directo;
            }

        }

    }
}


class Update extends ConexionBD
{
    private $table;
    private $instruccion = "";
    private $condiccion = "";

    public function __construct($tabla,$atributo,$valor){
        parent::__construct();
        $this->table=$tabla;
        $this->condiccion.=$atributo;
        $valor = $this->conexion->real_escape_string($valor);
        $this->condiccion.="='".$valor."'";
    }

    public function addVal($llave,$valor){
        if ($this->instruccion!="") {
            $this->instruccion.=",";
        }

        $valor = $this->conexion->real_escape_string($valor);

        $this->instruccion.=$llave."="."'".$valor."'";
    }

    public function addCon($atributo,$valor,$tipo){

        if ($this->condiccion!="") {
            if ($tipo==1) {
                $this->condiccion.=" AND ";
            }elseif ($tipo==2) {
                $this->condiccion.=" OR ";
            }
        }

        $valor = $this->conexion->real_escape_string($valor);

        $this->condiccion.=$atributo."='".$valor."'";
    }

    public function ready(){
        $ejecutar;

        if ($this->instruccion!="") {

            $actualizar="UPDATE $this->table SET $this->instruccion WHERE 
            $this->condiccion";

            //echo $actualizar;
            
            $ejecutar = $this->conexion->prepare($actualizar);

            if ($ejecutar) {
                $ejecutar->execute();
                //echo "La instruccion es ".$actualizar;
            }else{
                echo "ERROR: No se pudo concretar los cambios debido a inconsistensias en los datos";
            }

        }

    }

    public function eliminar(){
        $ejecutar;

        if ($this->instruccion!="") {

            $actualizar="DELETE $this->table SET $this->instruccion WHERE 
            $this->condiccion";

            echo $actualizar;
            
            $ejecutar = $this->conexion->prepare($actualizar);

            if ($ejecutar) {
                $ejecutar->execute();
            }else{
                echo "ERROR: No se pudo concretar los cambios debido a inconsistensias en los datos";
            }

        }

    }
}

/*$muestra = new Consultar();

$array = $muestra->getDates("SELECT * FROM ".TABLAS['user']." WHERE cedula='".$login['cedula']."'");

foreach ($array as $elemento) {
    echo $elemento['cedula']."---";
}

if (!$array) {
    echo "no hay datos que mostrar";
}*/


?>