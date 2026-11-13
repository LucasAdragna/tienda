import { backendGet } from "@/lib/backend-client";
import PromotionBannerContent, { type PromotionBannerData } from "./PromotionBannerContent";

export default async function PromotionBanner() {
  const payload = await backendGet<{ data?: PromotionBannerData | null }>("/api/promotions");
  const promotion = payload?.data;

  if (!promotion || !promotion.title || !promotion.description ||
      !promotion.cta_label || !promotion.cta_url ||
      !Number.isFinite(Date.parse(promotion.expires_at)) ||
      Date.parse(promotion.expires_at) <= Date.now()) {
    return null;
  }

  return <PromotionBannerContent promotion={promotion} />;
}
