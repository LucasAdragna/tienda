import Image from "next/image";
import Link from "next/link";
import { notFound } from "next/navigation";
import { getRoomBySlug } from "@/services/home-content.service";

type HabitacionDetallePageProps = {
  params: Promise<{
    slug: string;
  }>;
};

export default async function HabitacionDetallePage({ params }: HabitacionDetallePageProps) {
  const { slug } = await params;
  const room = await getRoomBySlug(slug);

  if (!room) {
    notFound();
  }

  return (
    <section className="py-5 bg-light min-vh-100">
      <div className="container">
        <Link href="/habitaciones" className="btn btn-link px-0 mb-3">
          Volver a habitaciones
        </Link>

        <div className="row g-4 align-items-start">
          <div className="col-lg-7">
            <div className="room-detail-gallery">
              {room.images.map((image, index) => (
                <div className="room-detail-image" key={`${image.src}-${index}`}>
                  <Image src={image.src} alt={image.alt} width={900} height={600} className="img-fluid rounded-3 shadow-sm" />
                </div>
              ))}
            </div>
          </div>

          <div className="col-lg-5">
            <div className="card border-0 shadow-sm p-4 sticky-lg-top room-detail-summary">
              <p className="text-uppercase small mb-1">Habitacion</p>
              <h1 className="mb-3">{room.name}</h1>
              <p className="text-secondary">{room.description}</p>

              <div className="d-flex flex-wrap gap-2 mb-3">
                <span className="badge text-bg-light">Capacidad: {room.capacity} huespedes</span>
                {room.amenities.map((amenity) => (
                  <span className="badge text-bg-light" key={amenity}>{amenity}</span>
                ))}
              </div>

              <div className="d-flex justify-content-between align-items-center border-top pt-3 mt-2">
                <strong className="fs-4 text-primary">USD {room.pricePerNight}/noche</strong>
                <Link href="/reservas" className="btn btn-primary">Reservar</Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
