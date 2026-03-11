import { backendGet } from "@/lib/backend-client";
import type { HeroSlide, SliderApiResponse } from "@/types/slider";

export async function getHeroSlides(): Promise<HeroSlide[]> {
  const payload = await backendGet<SliderApiResponse>("/api/sliders");

  if (!payload?.data || !Array.isArray(payload.data)) {
    return [];
  }

  return payload.data.map((slide) => ({
    id: Number(slide.id),
    title: String(slide.title ?? ""),
    text: String(slide.text ?? ""),
    image: String(slide.image ?? ""),
    link: String(slide.link ?? "/reservas"),
    order: Number(slide.order ?? 0),
  }));
}
