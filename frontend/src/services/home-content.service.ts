import { backendGet } from "@/lib/backend-client";
import type { GalleryImage, HotelAboutUs, HotelRoom } from "@/types/hotel";

const ROOM_PLACEHOLDER_IMAGE = "/images/hotel/instalaciones1.jpg";

type ApiResponse<T> = {
  data?: T[];
};

type RoomApiItem = {
  id: string;
  slug: string;
  name: string;
  description: string;
  capacity: number;
  pricePerNight: number;
  image: string | null;
  images?: GalleryApiItem[];
  amenities: string[];
};

function mapRoom(room: RoomApiItem): HotelRoom {
  const images = Array.isArray(room.images)
    ? room.images.map((image) => ({
        src: String(image.src ?? ""),
        alt: String(image.alt ?? room.name ?? "Habitacion"),
      })).filter((image) => image.src.trim() !== "")
    : [];
  const image = room.image && room.image.trim() !== "" ? room.image : images[0]?.src ?? ROOM_PLACEHOLDER_IMAGE;

  return {
    id: String(room.id),
    slug: String(room.slug ?? room.id),
    name: String(room.name ?? ""),
    description: String(room.description ?? ""),
    capacity: Number(room.capacity ?? 1),
    pricePerNight: Number(room.pricePerNight ?? 0),
    image,
    images: images.length > 0 ? images : [{ src: image, alt: String(room.name ?? "Habitacion") }],
    amenities: Array.isArray(room.amenities) ? room.amenities : [],
  };
}

export async function getRoomsPreview(): Promise<HotelRoom[]> {
  const payload = await backendGet<ApiResponse<RoomApiItem>>("/api/rooms");

  if (!payload?.data || !Array.isArray(payload.data) || payload.data.length === 0) {
    return [];
  }

  return payload.data.map(mapRoom);
}

export async function getRoomBySlug(slug: string): Promise<HotelRoom | null> {
  const payload = await backendGet<{ data?: RoomApiItem }>(`/api/rooms/${slug}`);

  if (!payload?.data) {
    return null;
  }

  return mapRoom(payload.data);
}

type AboutUsApiItem = {
  title: string;
  text: string;
  image: string;
  pdf: string;
};

export async function getAboutUs(): Promise<HotelAboutUs | null> {
  const payload = await backendGet<{ data?: AboutUsApiItem | null }>("/api/sobre-nosotros");

  if (!payload?.data) {
    return null;
  }

  return {
    title: String(payload.data.title ?? ""),
    text: String(payload.data.text ?? ""),
    image: String(payload.data.image ?? ""),
    pdf: String(payload.data.pdf ?? ""),
  };
}

type GalleryApiItem = {
  src: string;
  alt: string;
};

export async function getGalleryPreview(): Promise<GalleryImage[]> {
  const payload = await backendGet<ApiResponse<GalleryApiItem>>("/api/gallery");

  if (!payload?.data || !Array.isArray(payload.data) || payload.data.length === 0) {
    return [];
  }

  return payload.data.map((image) => ({
    src: String(image.src ?? ""),
    alt: String(image.alt ?? "Imagen del hotel"),
  }));
}
