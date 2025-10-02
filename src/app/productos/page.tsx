import CardProducto from "@/components/CardProducto";

const productos = [
  { id: 1, nombre: "Producto A", precio: 100 },
  { id: 2, nombre: "Producto B", precio: 200 },
];

export default function Productos() {
  return (
    <div className="container mt-5">
      <h2>Productos</h2>
      <div className="row">
        {productos.map((p) => (
          <div key={p.id} className="col-md-4">
            <CardProducto {...p} />
          </div>
        ))}
      </div>
    </div>
  );
}
