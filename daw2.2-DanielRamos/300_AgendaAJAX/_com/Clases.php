<?php

abstract class Dato
{
}

trait Identificable
{
    protected  $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

class Categoria extends Dato implements JsonSerializable
{
    use Identificable;

    private   $nombre;
    private   $personasPertenecientes;

    public function __construct(int $id, string $nombre)
    {
        $this->$id=$id;
        $this->setNombre($nombre);
    }

    public function jsonSerialize()
    {
        return [
            "nombre" => $this->nombre,
            "id" => $this->id,
        ];

    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function obtenerPersonasPertenecientes(): array
    {
        if ($this->personasPertenecientes == null) $personasPertenecientes = DAO::personaObtenerPorCategoria($this->id);

        return $personasPertenecientes;
    }
}

class Persona extends Dato implements JsonSerializable
{
    use Identificable;

    private   $nombre;
    private   $apellidos;
    private   $telefono;
    private   $categoriaId;
    private   $categoria;
    private   $estrella;

    public function __construct(int $id, string $nombre, ?string $apellidos, string $telefono, int $categoriaId, bool $estrella)
    {
        $this->id = ($id);
        $this->nombre=($nombre);
        $this->apellidos=($apellidos);
        $this->telefono=($telefono);
        $this->categoriaId=($categoriaId);
        $this->estrella=($estrella);
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "apellidos" => $this->apellidos,
            "telefono" => $this->telefono,
            "categoriaId" => $this->categoriaId,
            "estrella" => $this->estrella,
        ];
        // Esto sería lo mismo:
        //$array["nombre"] = $this->nombre;
        //$array["id"] = $this->id;
        //return $array;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
    public function getApellidos(): string
    {
        return $this->apellidos;
    }
    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function getTelefono(): int
    {
        return $this->telefono;
    }
    public function setTelefono(int $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function isEstrella(): bool
    {
        return $this->estrella;
    }
    public function setEstrella(bool $estrella): void
    {
        $this->estrella = $estrella;
    }

    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }
    public function setCategoriaId(int $categoriaId): void
    {
        $this->categoria = $categoriaId;
    }

    public function obtenerCategoria(): Categoria
    {
        if ($this->categoria == null) $categoria = DAO::categoriaObtenerPorId($this->categoriaId);

        return $categoria;
    }

}