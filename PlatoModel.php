<?php
            // models/PlatoModel.php
           

            class PlatoModel {
                private $conexion;

                public function __construct($conexion) {
                    $this->conexion = $conexion;
                }

                public function obtenerPlatos($tipo_plato = '') {
                    if ($tipo_plato != '') {
                        $sql = "SELECT id_plato, tipo_plato,  Nombre,  precio, imagen FROM plato WHERE tipo_plato = '$tipo_plato'";
                    } else {
                        $sql = "SELECT id_plato, tipo_plato, Nombre, precio, imagen FROM plato";
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
