import Image from "next/image";

type Props = {
  id: number;
  nombre: string;
  precio: number;
  imagen?: string; // opcional
};

export default function CardProducto({ id, nombre, precio, imagen }: Props) {
  return (
    <div className="card mb-4 h-100 shadow-sm">
      <Image
        src="/images/producto.webp"
        alt={nombre}
        className="card-img-top"
        width={320}
        height={250}
        style={{ objectFit: "cover", height: 250 }}
        priority={false}
      />

      <div className="card-body d-flex flex-column">
        <h5 className="card-title mb-2">{nombre}</h5>
        <p className="card-text text-muted mb-4">
          Precio: ${precio.toLocaleString()}
        </p>
        <div className="mt-auto d-flex gap-2">
          <button className="btn btn-primary btn-sm">Agregar</button>
          <a href={`/productos/${id}`} className="btn btn-outline-secondary btn-sm">
            Detalles
          </a>
        </div>
      </div>
    </div>
  );
}
