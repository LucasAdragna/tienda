import { hotelRooms } from "@/constants/hotel";
import { RoomCard } from "@/components/ui";

export default function ProductosPage() {
  return (
    <section className="py-5 bg-light min-vh-100">
      <div className="container">
        <h1 className="mb-3">Ruta antigua: productos</h1>
        <p className="text-secondary mb-4">Se conserva temporalmente como alias mientras migras enlaces a /habitaciones.</p>
        <div className="row g-4">
          {hotelRooms.slice(0, 2).map((room) => (
            <div key={room.id} className="col-md-6">
              <RoomCard room={room} />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
