import { RoomCard } from "@/components/ui";
import { getRoomsPreview } from "@/services/home-content.service";

export default async function ProductosPage() {
  const rooms = await getRoomsPreview();

  return (
    <section className="py-5 bg-light min-vh-100">
      <div className="container">
        <h1 className="mb-3">Ruta antigua: productos</h1>
        <p className="text-secondary mb-4">Se conserva temporalmente como alias mientras migras enlaces a /habitaciones.</p>
        {rooms.length > 0 ? (
          <div className="row g-4">
            {rooms.slice(0, 2).map((room) => (
              <div key={room.id} className="col-md-6">
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
