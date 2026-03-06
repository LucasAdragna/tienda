export type HotelRoom = {
  id: string;
  name: string;
  description: string;
  capacity: number;
  pricePerNight: number;
  image: string;
  amenities: string[];
};

export type HotelAmenity = {
  title: string;
  description: string;
};

export type GalleryImage = {
  src: string;
  alt: string;
};
