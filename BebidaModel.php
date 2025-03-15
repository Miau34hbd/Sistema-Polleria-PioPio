<?php
            // models/BebidaModel.php
           

            class BebidaModel {
                private $conexion;

                public function __construct($conexion) {
                    $this->conexion = $conexion;
                }

                public function obtenerBebida($tipo_bebida = '') {
                    if ($tipo_bebida != '') {
                        $sql = "SELECT id_bebida, tipo_bebida,  Nombre,  precio, imagen FROM bebida WHERE tipo_bebida = '$tipo_bebida'";
                    } else {
                        $sql = "SELECT id_bebida, tipo_bebida, Nombre, precio, imagen FROM bebida";
                    }

                    $resultado = $this->conexion->query($sql);

                    // Verificar si la consulta fue exitosa
                    if ($resultado === false) {
                        return false; // Devuelve false si hay un error
                    }

                    return $resultado;
                }

                public function getConexion() {
                    return $this->conexion;
                }
            }
            ?>
