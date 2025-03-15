<?php
class BaseDatos {
    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $baseDatos = "polleria";
    private $conexion;

    public function conectar() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->baseDatos);
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function desconectar() {
        $this->conexion->close();
    }
}
?>