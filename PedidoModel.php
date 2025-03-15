<?php
// models/PedidoModel.php

class PedidoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPedidos() {
        $sql = "SELECT p.id_pedido, m.numero_mesa, p.estado
                FROM pedido p
                LEFT JOIN mesa m ON p.id_mesa = m.id_mesa";
        $result = $this->conexion->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPedido($idPedido) {
        $sql = "SELECT id_pedido, id_mesa, estado FROM pedido WHERE id_pedido = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idPedido);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function obtenerDetallesPedido($idPedido) {
        $sql = "SELECT id_detalle, id_producto, nombre_producto, cantidad, precio_unitario, precio_total 
                FROM detalle_pedido WHERE id_pedido = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idPedido);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizarPedido($data) {
        $idPedido = $data['idPedido'];
        $detalles = $data['idDetalle'];
        $cantidades = $data['cantidad'];
    
        // Iniciar transacción
        $this->conexion->begin_transaction();
    
        try {
            // Actualizar detalles del pedido
            foreach ($detalles as $index => $idDetalle) {
                $cantidad = $cantidades[$index];
                $sqlDetalle = "UPDATE detalle_pedido SET cantidad = ?, precio_total = precio_unitario * ? WHERE id_detalle = ?";
                $stmtDetalle = $this->conexion->prepare($sqlDetalle);
                $stmtDetalle->bind_param("iii", $cantidad, $cantidad, $idDetalle);
                $stmtDetalle->execute();
            }
    
            // Confirmar transacción
            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $this->conexion->rollback();
            return false;
        }
    }

    public function guardarPedido($mesa, $platos, $bebidas) {
        // Iniciar transacción
        $this->conexion->begin_transaction();

        try {
            // Insertar pedido
            $sqlPedido = "INSERT INTO pedido (id_mesa, estado) VALUES (?, 'En cola')";
            $stmtPedido = $this->conexion->prepare($sqlPedido);
            $stmtPedido->bind_param("i", $mesa);
            $stmtPedido->execute();
            $idPedido = $stmtPedido->insert_id;

            // Depuración: Verificar que el pedido se insertó correctamente
            error_log("Pedido insertado con ID: $idPedido");

            // Insertar detalles de platos
            foreach ($platos as $plato) {
                $sqlDetalle = "INSERT INTO detalle_pedido (id_pedido, tipo_producto, id_producto, nombre_producto, cantidad, precio_unitario, precio_total) VALUES (?, 'plato', ?, ?, ?, ?, ?)";
                $stmtDetalle = $this->conexion->prepare($sqlDetalle);
                $precioTotal = $plato['precio'] * $plato['cantidad'];
                $stmtDetalle->bind_param("iisidd", $idPedido, $plato['id'], $plato['nombre'], $plato['cantidad'], $plato['precio'], $precioTotal);
                $stmtDetalle->execute();

                // Depuración: Verificar que el detalle del plato se insertó correctamente
                error_log("Detalle de plato insertado: " . print_r($plato, true));
            }

            // Insertar detalles de bebidas
            foreach ($bebidas as $bebida) {
                $sqlDetalle = "INSERT INTO detalle_pedido (id_pedido, tipo_producto, id_producto, nombre_producto, cantidad, precio_unitario, precio_total) VALUES (?, 'bebida', ?, ?, ?, ?, ?)";
                $stmtDetalle = $this->conexion->prepare($sqlDetalle);
                $precioTotal = $bebida['precio'] * $bebida['cantidad'];
                $stmtDetalle->bind_param("iisidd", $idPedido, $bebida['id'], $bebida['nombre'], $bebida['cantidad'], $bebida['precio'], $precioTotal);
                $stmtDetalle->execute();

                // Depuración: Verificar que el detalle de la bebida se insertó correctamente
                error_log("Detalle de bebida insertado: " . print_r($bebida, true));
            }

            // Confirmar transacción
            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            error_log("Error al guardar el pedido: " . $e->getMessage());
            $this->conexion->rollback();
            return false;
        }
    }

    public function anularPedido($idPedido) {
        // Verificar que el pedido esté en "En cola"
        $sqlVerificar = "SELECT estado FROM pedido WHERE id_pedido = ? AND estado = 'En cola'";
        $stmtVerificar = $this->conexion->prepare($sqlVerificar);
        $stmtVerificar->bind_param("i", $idPedido);
        $stmtVerificar->execute();
        $resultado = $stmtVerificar->get_result();

        if ($resultado->num_rows > 0) {
            $sqlAnular = "UPDATE pedido SET estado = 'Anulado' WHERE id_pedido = ?";
            $stmtAnular = $this->conexion->prepare($sqlAnular);
            $stmtAnular->bind_param("i", $idPedido);
            return $stmtAnular->execute();
        } else {
            return false;
        }
    }
}
?>