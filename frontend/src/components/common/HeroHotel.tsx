import Image from "next/image";
import Link from "next/link";

export default function HeroHotel() {
  return (
    <section className="hero-hotel">
      <Image
        src="/images/hotel/main-banner1.jpg"
        alt="Vista principal del hotel"
        fill
        priority
        className="hero-image"
      />
      <div className="hero-overlay" />
      <div className="container position-relative py-5">
        <div className="hero-content text-white py-5">
          <p className="text-uppercase small mb-2">Hotel Costa Azul</p>
          <h1 className="display-4 fw-bold mb-3">Descansa donde tus vacaciones empiezan</h1>
          <p className="lead mb-4">
            Inspirado en la estructura de `hotel 5 estrellas`: hero principal, mensaje corto y llamada a reserva.
          </p>
          <div className="d-flex flex-wrap gap-2">
            <Link href="/reservas" className="btn btn-primary btn-lg">Reservar ahora</Link>
            <Link href="/habitaciones" className="btn btn-outline-light btn-lg">Ver habitaciones</Link>
          </div>
        </div>
      </div>
    </section>
  );
}
