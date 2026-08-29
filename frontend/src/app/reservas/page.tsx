import { ReservationForm } from "@/features/reservas";
import { getRoomsPreview } from "@/services/home-content.service";

export default async function ReservasPage() {
  const rooms = await getRoomsPreview();

  return (
    <section className="py-5 bg-light min-vh-100">
      <div className="container">
        <p className="text-uppercase small mb-1">Reservas</p>
        <h1 className="mb-3">Reserva online en 3 pasos</h1>
        <p className="text-secondary mb-4">
          Paso 1: fechas y ocupacion. Paso 2: datos del huesped. Paso 3: el hotel confirma la disponibilidad.
        </p>
        <ReservationForm rooms={rooms.map((room) => ({
          slug: room.slug,
          name: room.name,
          capacity: room.capacity,
        }))} />
      </div>
    </section>
  );
}
