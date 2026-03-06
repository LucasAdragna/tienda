import { hotelRooms } from "@/constants/hotel";
import { RoomCard } from "@/components/ui";

export default function HabitacionesPage() {
  return (
    <section className="py-5 bg-light min-vh-100">
      <div className="container">
        <p className="text-uppercase small mb-1">Habitaciones</p>
        <h1 className="mb-3">Encuentra tu opcion ideal</h1>
        <p className="text-secondary mb-4">
          Estructura inspirada en listado de tarjetas tipo catalogo de `maqueta/shop.html`, adaptada al contexto hotelero.
        </p>

        <div className="row g-4">
          {hotelRooms.map((room) => (
            <div className="col-md-6 col-lg-4" key={room.id}>
              <RoomCard room={room} />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
