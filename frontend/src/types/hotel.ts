export type HotelRoom = {
  id: string;
  slug: string;
  name: string;
  description: string;
  capacity: number;
  pricePerNight: number;
  image: string;
  images: GalleryImage[];
  amenities: string[];
};

export type HotelAboutUs = {
  title: string;
  text: string;
  image: string;
  pdf: string;
};

export type GalleryImage = {
  src: string;
  alt: string;
};
