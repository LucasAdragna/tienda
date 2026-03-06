import Link from "next/link";

export default function Footer() {
  return (
    <footer className="footer-hotel mt-5 py-5">
      <div className="container">
        <div className="row g-4">
          <div className="col-md-4">
            <h5>Hotel Costa Azul</h5>
            <p className="mb-0 text-light-emphasis">
              Una experiencia frente al mar con confort, gastronomia y descanso.
            </p>
          </div>
          <div className="col-md-4">
            <h6>Secciones</h6>
            <ul className="list-unstyled mb-0 d-grid gap-1">
              <li><Link href="/habitaciones">Habitaciones</Link></li>
              <li><Link href="/servicios">Servicios</Link></li>
              <li><Link href="/galeria">Galeria</Link></li>
            </ul>
          </div>
          <div className="col-md-4">
            <h6>Contacto</h6>
            <ul className="list-unstyled mb-0 d-grid gap-1">
              <li>+54 264 555 1234</li>
              <li>reservas@hotelcostaazul.com</li>
              <li>Av. del Mar 1200, San Juan</li>
            </ul>
          </div>
        </div>

        <div className="border-top border-secondary-subtle mt-4 pt-3 small text-light-emphasis">
          © {new Date().getFullYear()} Hotel Costa Azul.
        </div>
      </div>
    </footer>
  );
}
