// src/components/Footer.tsx
export default function Footer() {
  return (
    <footer className="border-top bg-light py-4 mt-5">
      <div className="container d-flex flex-column flex-md-row justify-content-between small text-muted">
        <span>© {new Date().getFullYear()} Mi Tienda</span>
        <nav className="d-flex gap-3">
          <a href="#" className="text-decoration-none">Términos</a>
          <a href="#" className="text-decoration-none">Privacidad</a>
          <a href="#" className="text-decoration-none">Contacto</a>
        </nav>
      </div>
    </footer>
  );
}
