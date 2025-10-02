// src/components/LatestNews.tsx
const posts = [
  { id: 1, titulo: "Lanzamos nueva colección", fecha: "12 Sep 2025", tag: "Producto" },
  { id: 2, titulo: "Consejos para elegir tu equipo", fecha: "05 Sep 2025", tag: "Tips" },
  { id: 3, titulo: "Envíos mejorados a todo el país", fecha: "29 Ago 2025", tag: "Logística" },
];

export default function NoticiasRecientes() {
  return (
    <section className="py-5 bg-light">
      <div className="container">
        <div className="d-flex align-items-center justify-content-between mb-3">
          <h2 className="mb-0">Noticias recientes</h2>
          <a className="btn btn-outline-secondary btn-sm" href="/noticias">Ver noticias</a>
        </div>

        <div className="row g-4">
          {posts.map(p => (
            <div key={p.id} className="col-12 col-md-4">
              <article className="card h-100">
                <div className="card-body">
                  <span className="badge bg-secondary mb-2">{p.tag}</span>
                  <h5 className="card-title">{p.titulo}</h5>
                  <p className="card-text text-muted small">{p.fecha}</p>
                  <a href={`/noticias/${p.id}`} className="btn btn-sm btn-primary">Leer más</a>
                </div>
              </article>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
