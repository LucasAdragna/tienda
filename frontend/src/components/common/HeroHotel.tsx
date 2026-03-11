import HeroHotelClient from "./HeroHotelClient";
import { getHeroSlides } from "@/services/sliders.service";

export default async function HeroHotel() {
  const slides = await getHeroSlides();

  return <HeroHotelClient slides={slides} />;
}
