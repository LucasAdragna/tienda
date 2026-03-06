import Image from "next/image";
import type { HotelRoom } from "@/types/hotel";

type RoomCardProps = {
  room: HotelRoom;
};

export default function RoomCard({ room }: RoomCardProps) {
  return (
    <article className="card h-100 shadow-sm border-0">
      <Image src={room.image} alt={room.name} width={600} height={400} className="card-img-top" />
      <div className="card-body d-flex flex-column">
        <h5 className="card-title">{room.name}</h5>
        <p className="text-secondary small mb-2">Capacidad: {room.capacity} huespedes</p>
        <p className="card-text text-secondary">{room.description}</p>
        <div className="mt-auto d-flex justify-content-between align-items-center">
          <strong className="text-primary">USD {room.pricePerNight}/noche</strong>
          <a href="/reservas" className="btn btn-sm btn-outline-primary">Reservar</a>
        </div>
      </div>
    </article>
  );
}
