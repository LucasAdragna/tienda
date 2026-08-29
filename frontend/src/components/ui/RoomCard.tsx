import Image from "next/image";
import Link from "next/link";
import type { HotelRoom } from "@/types/hotel";

type RoomCardProps = {
  room: HotelRoom;
  descriptionLines?: 2;
};

export default function RoomCard({ room, descriptionLines }: RoomCardProps) {
  const coverImage = room.images[0]?.src ?? room.image;

  return (
    <article className="card h-100 shadow-sm border-0">
      <Image src={coverImage} alt={room.name} width={600} height={400} className="card-img-top" />
      <div className="card-body d-flex flex-column">
        <h5 className="card-title">{room.name}</h5>
        <p className="text-secondary small mb-2">Capacidad: {room.capacity} huespedes</p>
        <p className={`card-text text-secondary${descriptionLines === 2 ? " text-clamp-2" : ""}`}>
          {room.description}
        </p>
        <div className="mt-auto d-flex justify-content-between align-items-center">
          <strong className="text-primary">USD {room.pricePerNight}/noche</strong>
          <Link href={`/habitaciones/${room.slug}`} className="btn btn-sm btn-outline-primary">Ver detalle</Link>
        </div>
      </div>
    </article>
  );
}
