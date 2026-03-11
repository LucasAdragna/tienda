import { RoomCard } from "@/components/ui";
import { getRoomsPreview } from "@/services/home-content.service";

export default async function HabitacionesPage() {
  const rooms = await getRoomsPreview();

  return (
    <section className="py-5 bg-light min-vh-100">
      <div className="container">
        <p className="text-uppercase small mb-1">Habitaciones</p>
        <h1 className="mb-3">Encuentra tu opcion ideal</h1>
        <p className="text-secondary mb-4">
          Estructura inspirada en listado de tarjetas tipo catalogo de `maqueta/shop.html`, adaptada al contexto hotelero.
        </p>

        {rooms.length > 0 ? (
          <div className="row g-4">
            {rooms.map((room) => (
              <div className="col-md-6 col-lg-4" key={room.id}>
                <RoomCard room={room} />
              </div>
            ))}
          </div>
        ) : (
          <p className="text-secondary mb-0">No hay habitaciones activas para mostrar.</p>
        )}
      </div>
    </section>
  );
}
