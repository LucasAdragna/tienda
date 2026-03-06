import type { GalleryImage, HotelAmenity, HotelRoom } from "@/types/hotel";

export const hotelRooms: HotelRoom[] = [
  {
    id: "suite-mar",
    name: "Suite Vista Mar",
    description: "Cama king, balcon privado y banera hidromasaje.",
    capacity: 2,
    pricePerNight: 210,
    image: "/images/hotel/instalaciones1.jpg",
    amenities: ["WiFi", "Balcon", "Desayuno"],
  },
  {
    id: "familiar-plus",
    name: "Habitacion Familiar Plus",
    description: "Dos ambientes amplios para familias o grupos.",
    capacity: 4,
    pricePerNight: 260,
    image: "/images/hotel/instalaciones2.jpg",
    amenities: ["WiFi", "Smart TV", "Mini bar"],
  },
  {
    id: "doble-confort",
    name: "Doble Confort",
    description: "Diseno moderno con excelente iluminacion natural.",
    capacity: 2,
    pricePerNight: 145,
    image: "/images/hotel/instalaciones3.jpg",
    amenities: ["WiFi", "Aire", "Caja de seguridad"],
  },
  {
    id: "junior-suite",
    name: "Junior Suite",
    description: "Mayor metraje, area de lectura y servicio premium.",
    capacity: 3,
    pricePerNight: 185,
    image: "/images/hotel/instalaciones4.jpg",
    amenities: ["WiFi", "Escritorio", "Room service"],
  },
];

export const hotelAmenities: HotelAmenity[] = [
  { title: "Piscina climatizada", description: "Disponible todo el ano con area de relax." },
  { title: "Spa & bienestar", description: "Masajes, sauna y tratamientos personalizados." },
  { title: "Restaurante", description: "Cocina local e internacional con menu diario." },
  { title: "Traslado aeropuerto", description: "Servicio programado segun tu reserva." },
  { title: "Sala de eventos", description: "Espacio para reuniones y celebraciones." },
  { title: "Recepcion 24hs", description: "Atencion continua para check-in y soporte." },
];

export const galleryImages: GalleryImage[] = [
  { src: "/images/hotel/gallery-img1.jpg", alt: "Lobby principal" },
  { src: "/images/hotel/gallery-img2.jpg", alt: "Piscina exterior" },
  { src: "/images/hotel/gallery-img3.jpg", alt: "Restaurante" },
  { src: "/images/hotel/gallery-img4.jpg", alt: "Terraza" },
  { src: "/images/hotel/instalaciones0.jpg", alt: "Entrada del hotel" },
  { src: "/images/hotel/instalaciones5.jpg", alt: "Zona de descanso" },
];
