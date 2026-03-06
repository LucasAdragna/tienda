import { hotelRooms } from "@/constants/hotel";
import { RoomCard } from "@/components/ui";

export default function RoomsPreview() {
  return (
    <section className="py-5 bg-white">
      <div className="container">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <div>
            <p className="text-uppercase small mb-1">Habitaciones</p>
            <h2 className="mb-0">Opciones para cada tipo de viaje</h2>
          </div>
          <a href="/habitaciones" className="btn btn-outline-secondary">Ver todas</a>
        </div>
        <div className="row g-4">
          {hotelRooms.slice(0, 3).map((room) => (
            <div className="col-md-6 col-lg-4" key={room.id}>
              <RoomCard room={room} />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
