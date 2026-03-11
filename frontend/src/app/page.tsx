import Link from "next/link";
import { AmenitiesSection, GalleryPreview, HeroHotel, RoomsPreview } from "@/components/common";

export default function HomePage() {
  return (
    <>
      <HeroHotel />
      <RoomsPreview />
      <AmenitiesSection />
      <GalleryPreview />

      <section className="py-5 cta-section">
        <div className="container">
          <div className="row align-items-center g-3">
            <div className="col-lg-8">
              <h2 className="mb-2">Listo para planificar tu estadia?</h2>
              <p className="mb-0 text-secondary">
                Empezamos con un flujo simple de reserva para validar disponibilidad y datos del huesped.
              </p>
            </div>
            <div className="col-lg-4 text-lg-end">
              <Link href="/reservas" className="btn btn-primary btn-lg">
                Ir a reservas
              </Link>
            </div>
          </div>
        </div>
      </section>
    </>
  );
}
