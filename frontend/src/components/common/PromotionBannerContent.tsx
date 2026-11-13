"use client";

import Link from "next/link";
import { useEffect, useState } from "react";
import styles from "./PromotionBanner.module.css";

export type PromotionBannerData = {
  id: number;
  title: string;
  description: string;
  cta_label: string;
  cta_url: string;
  starts_on: string;
  ends_on: string;
  expires_at: string;
};

export default function PromotionBannerContent({ promotion }: { promotion: PromotionBannerData }) {
  const [expired, setExpired] = useState(false);
  const deadline = Date.parse(promotion.expires_at);

  useEffect(() => {
    const updateExpiry = () => setExpired(Date.now() >= deadline);
    updateExpiry();
    // Recheck after background-tab suspension as well as while the page stays open.
    const interval = window.setInterval(updateExpiry, 1000);
    document.addEventListener("visibilitychange", updateExpiry);
    return () => {
      window.clearInterval(interval);
      document.removeEventListener("visibilitychange", updateExpiry);
    };
  }, [deadline]);

  const safeTarget = !/[\\\u0000-\u0020\u007f]/.test(promotion.cta_url) &&
    (/^\/(?!\/)/.test(promotion.cta_url) || /^https?:\/\//i.test(promotion.cta_url));

  if (expired || !safeTarget) return null;

  const displayEndDate = promotion.ends_on.split("-").reverse().join("/");

  return (
    <section className={styles.banner} aria-labelledby={`promotion-${promotion.id}`}>
      <div className={`container ${styles.content}`}>
        <div className={styles.copy}>
          <p className={styles.eyebrow}>Promoción del hotel</p>
          <h2 id={`promotion-${promotion.id}`} className={styles.title}>{promotion.title}</h2>
          <p className={styles.description}>{promotion.description}</p>
          <p className={styles.validity}>
            Consultá esta oferta hasta el <time dateTime={promotion.ends_on}>{displayEndDate}</time>.
            {" "}Sujeta a disponibilidad y a las condiciones indicadas.
          </p>
        </div>
        <Link href={promotion.cta_url} className={`btn btn-light ${styles.cta}`}>
          {promotion.cta_label}<span aria-hidden="true"> →</span>
        </Link>
      </div>
    </section>
  );
}
