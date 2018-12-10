<?php
	require "Conexion.php";

	class articulo{
	
		
		public function __construct(){
		}

		public function Registrar($idcategoria, $idunidad_medida, $nombre, $descripcion){
			global $conexion;
			$sql = "INSERT INTO articulo(idcategoria, idunidad_medida, nombre, descripcion, estado)
						VALUES($idcategoria, $idunidad_medida, '$nombre', '$descripcion', 'A')";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function Modificar($idarticulo, $idcategoria, $idunidad_medida, $nombre, $descripcion){
			global $conexion;
			$sql = "UPDATE articulo set idcategoria = $idcategoria, idunidad_medida = $idunidad_medida, nombre = '$nombre',
						descripcion = '$descripcion'
						WHERE idarticulo = $idarticulo";
			$query = $conexion->query($sql);
			return $query;
		}
		
		public function Eliminar($idarticulo){
			global $conexion;
			$sql = "UPDATE articulo set estado = 'N' WHERE idarticulo = $idarticulo";
			$query = $conexion->query($sql);
			return $query;
		}

		public function Listar(){
			global $conexion;
			$sql = "select a.*, c.nombre as categoria, um.nombre as unidadMedida, (SELECT SUM(det.stock_actual) FROM detalle_ingreso det WHERE a.idarticulo = det.idarticulo) as stock,
			(SELECT det.precio_compra FROM detalle_ingreso det WHERE a.idarticulo = det.idarticulo order by det.iddetalle_ingreso LIMIT 1) as precio_compra,
			(SELECT det.precio_ventapublico FROM detalle_ingreso det WHERE a.idarticulo = det.idarticulo order by det.iddetalle_ingreso LIMIT 1) as precio_venta
	from articulo a inner join categoria c on a.idcategoria = c.idcategoria
	inner join unidad_medida um on a.idunidad_medida = um.idunidad_medida where a.estado = 'A' order by idarticulo desc";
			$query = $conexion->query($sql);
			return $query;
		}


		public function Reporte(){
			global $conexion;
			$sql = "select a.*, c.nombre as categoria, um.nombre as unidadMedida 
	from articulo a inner join categoria c on a.idcategoria = c.idcategoria
	inner join unidad_medida um on a.idunidad_medida = um.idunidad_medida where a.estado = 'A' order by a.nombre asc";
			$query = $conexion->query($sql);
			return $query;
		}
	}
