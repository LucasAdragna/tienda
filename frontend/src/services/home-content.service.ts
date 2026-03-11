import { backendGet } from "@/lib/backend-client";
import type { GalleryImage, HotelAmenity, HotelRoom } from "@/types/hotel";

const ROOM_PLACEHOLDER_IMAGE = "/images/hotel/instalaciones1.jpg";

type ApiResponse<T> = {
  data?: T[];
};

type RoomApiItem = {
  id: string;
  name: string;
  description: string;
  capacity: number;
  pricePerNight: number;
  image: string | null;
  amenities: string[];
};

export async function getRoomsPreview(): Promise<HotelRoom[]> {
  const payload = await backendGet<ApiResponse<RoomApiItem>>("/api/rooms");

  if (!payload?.data || !Array.isArray(payload.data) || payload.data.length === 0) {
    return [];
  }

  return payload.data.map((room) => ({
    id: String(room.id),
    name: String(room.name ?? ""),
    description: String(room.description ?? ""),
    capacity: Number(room.capacity ?? 1),
    pricePerNight: Number(room.pricePerNight ?? 0),
    image: room.image && room.image.trim() !== "" ? room.image : ROOM_PLACEHOLDER_IMAGE,
    amenities: Array.isArray(room.amenities) ? room.amenities : [],
  }));
}

type AmenityApiItem = {
  title: string;
  description: string;
};

export async function getAmenities(): Promise<HotelAmenity[]> {
  const payload = await backendGet<ApiResponse<AmenityApiItem>>("/api/amenities");

  if (!payload?.data || !Array.isArray(payload.data) || payload.data.length === 0) {
    return [];
  }

  return payload.data.map((amenity) => ({
    title: String(amenity.title ?? ""),
    description: String(amenity.description ?? ""),
  }));
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
