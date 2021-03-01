<?php

abstract class Dato
{
}

trait Identificable
{
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

class Categoria extends Dato {
    use Identificable;

    private  $nombre;

    public function __construct($id, $nombre)
    {
        $this->setId($id);
        $this->setNombre($nombre);
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

}

class Persona extends Dato
{
    use Identificable;

    private $nombre;

    function __construct(int $id=null, string $nombre)
    {
        if ($id != null && $nombre == null) { // Cargar de BD
            // TODO obtener info de la BD usando el id.
        } else if ($id == null && $nombre != null) { // Crear en BD
           DAO::agregarProducto($nombre,$descripcion,$precio);
        } else { // No hacemos nada con la BD (debe venir todo relleno)
            $this->id = $id;
            $this->nombre = $nombre;
        }
    }


    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

    public function generarPrecioFormateado(): string
    {
        return number_format ($this->getPrecio(), 2) . "€";
    }
}

abstract class ProtoPedido extends Dato
{

    protected $cliente_id;
    protected $lineas;

    public function __construct(int $cliente_id, $lineas)
    {
        $this->cliente_id = $cliente_id;
        $this->lineas = $lineas;
    }

    public function getClienteId(): int
    {
        return $this->cliente_id;
    }

    public function setClienteId(int $cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }

    public function getLineas(): array
    {
        return $this->lineas;
    }

    public function setLineas(array $lineas): void
    {
        $this->lineas = $lineas;
    }


}

class Carrito extends ProtoPedido {

    public function __construct(int $cliente_id, $lineas)
    {
        parent::__construct($cliente_id, $lineas);
    }
    //TODO VER ESTO A VER  SI FUNCIONA
    public function variarProducto($productoId, $variacionUnidades) {
        $nuevaCantidadUnidades = DAO::carritoVariarUnidadesProducto($productoId, $variacionUnidades);

        $lineas = $this->getLineas();
        $lineaNueva= new LineaCarrito($productoId, $nuevaCantidadUnidades);
        array_push($lineas, $lineaNueva);
        $this->setLineas($lineas);
    }
}

class Pedido extends ProtoPedido {
    use Identificable;

    private  $direccionEnvio;
    private  $fechaConfirmacion; // $now = date("Y-m-d H:i:s"); tendriamos en la variable 2020-09-01 11:48 y es compatible con datetime de mysql

    public function __constructPedido(int $id, int $cliente_id, string $direccionEnvio, object $fechaConfirmacion, array $lineas)
    {
        parent::__construct($cliente_id, $lineas);

        $this->setId($id);
        $this->setDireccionEnvio($direccionEnvio);
        $this->getFechaConfirmacion($fechaConfirmacion);
    }

    public function getDireccionEnvio()
    {
        return $this->direccionEnvio;
    }

    public function setDireccionEnvio($direccionEnvio)
    {
        $this->direccionEnvio = $direccionEnvio;
    }

    public function getFechaConfirmacion()
    {
        return $this->fechaConfirmacion;
    }

    public function setFechaConfirmacion($fechaConfirmacion)
    {
        $this->fechaConfirmacion = $fechaConfirmacion;
    }
}

abstract class ProtoLinea
{
    protected $producto_id;
    protected $unidades;

    public function __construct(int $producto_id, int $unidades)
    {
        $this->producto_id = $producto_id;
        $this->unidades = $unidades;
    }

    public function getProductoId()
    {
        return $this->producto_id;
    }

    public function setProductoId($producto_id)
    {
        $this->producto_id = $producto_id;
    }

    public function getUnidades()
    {
        return $this->unidades;
    }

    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }
}

class LineaCarrito extends ProtoLinea
{
    public function __construct(int $producto_id, int $unidades)
    {
        parent::__construct($producto_id, $unidades);
    }
}

class LineaPedido extends ProtoLinea
{
    private  $precioUnitario;

    public function __construct(int $producto_id, int $unidades, float $precioUnitario)
    {
        parent::__construct($producto_id, $unidades);

        $this->setPrecioUnitario($precioUnitario);
    }

    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;
    }
}