// src/components/FeaturedProducts.tsx
import Image from "next/image";

const destacados = [
  { id: 1, nombre: "Producto A", precio: 999, img: "/images/products/a.jpg", slug: "producto-a" },
  { id: 2, nombre: "Producto B", precio: 350, img: "/images/products/b.jpg", slug: "producto-b" },
  { id: 3, nombre: "Producto C", precio: 125, img: "/images/products/c.jpg", slug: "producto-c" },
  { id: 4, nombre: "Producto D", precio: 79,  img: "/images/products/d.jpg", slug: "producto-d" },
];

export default function ProductosDestacados() {
  return (
    <section className="py-5">
      <div className="container">
        <div className="d-flex align-items-center justify-content-between mb-3">
          <h2 className="mb-0">Productos destacados</h2>
          <a className="btn btn-outline-secondary btn-sm" href="/productos">Ver todos</a>
        </div>

        <div className="row g-4">
          {destacados.map(p => (
            <div key={p.id} className="col-12 col-sm-6 col-lg-3">
              <article className="card h-100 shadow-sm">
                <div className="ratio ratio-16x9">
                  <Image src={p.img} alt={p.nombre} fill className="object-fit-cover rounded-top" />
                </div>
                <div className="card-body d-flex flex-column">
                  <h6 className="card-title">{p.nombre}</h6>
                  <div className="text-warning fw-bold mb-3">USD {p.precio.toFixed(2)}</div>
                  <div className="mt-auto d-flex gap-2">
                    <a href={`/productos/${p.slug}`} className="btn btn-outline-secondary btn-sm">Ver</a>
                    <button className="btn btn-primary btn-sm">Agregar</button>
                  </div>
                </div>
              </article>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
