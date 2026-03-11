"use client";

import Link from "next/link";
import { useEffect, useMemo, useState } from "react";
import type { HeroSlide } from "@/types/slider";

type HeroHotelClientProps = {
  slides: HeroSlide[];
};

export default function HeroHotelClient({ slides }: HeroHotelClientProps) {
  const normalizedSlides = useMemo(() => [...slides].sort((a, b) => a.order - b.order), [slides]);
  const [currentSlideIndex, setCurrentSlideIndex] = useState(0);

  useEffect(() => {
    setCurrentSlideIndex(0);
  }, [normalizedSlides.length]);

  useEffect(() => {
    if (normalizedSlides.length <= 1) {
      return;
    }

    const interval = window.setInterval(() => {
      setCurrentSlideIndex((prev) => (prev + 1) % normalizedSlides.length);
    }, 6000);

    return () => window.clearInterval(interval);
  }, [normalizedSlides.length]);

  if (normalizedSlides.length === 0) {
    return (
      <section className="hero-hotel">
        <div className="hero-overlay" />
        <div className="container position-relative py-5">
          <div className="hero-content text-white py-5">
            <p className="text-uppercase small mb-2">Hotel Costa Azul</p>
            <h1 className="display-5 fw-bold mb-3">No hay slides activos</h1>
            <p className="lead mb-0">Crea y activa slides desde el panel de administracion para mostrarlos aqui.</p>
          </div>
        </div>
      </section>
    );
  }

  const currentSlide = normalizedSlides[currentSlideIndex];
  const isExternalLink = /^https?:\/\//i.test(currentSlide.link);

  return (
    <section className="hero-hotel">
      <div
        className="hero-image"
        style={{ backgroundImage: `url("${currentSlide.image}")` }}
        aria-hidden="true"
      />
      <div className="hero-overlay" />
      <div className="container position-relative py-5">
        <div className="hero-content text-white py-5">
          <p className="text-uppercase small mb-2">Hotel Costa Azul</p>
          <h1 className="display-4 fw-bold mb-3">{currentSlide.title}</h1>
          <p className="lead mb-4">{currentSlide.text}</p>
          <div className="d-flex flex-wrap gap-2">
            {isExternalLink ? (
              <a href={currentSlide.link} target="_blank" rel="noreferrer" className="btn btn-primary btn-lg">
                Reservar ahora
              </a>
            ) : (
              <Link href={currentSlide.link || "/reservas"} className="btn btn-primary btn-lg">
                Reservar ahora
              </Link>
            )}
            <Link href="/habitaciones" className="btn btn-outline-light btn-lg">
              Ver habitaciones
            </Link>
          </div>

          {normalizedSlides.length > 1 ? (
            <div className="hero-indicators mt-4">
              {normalizedSlides.map((slide, index) => (
                <button
                  key={slide.id}
                  type="button"
                  onClick={() => setCurrentSlideIndex(index)}
                  className={`hero-indicator ${index === currentSlideIndex ? "active" : ""}`}
                  aria-label={`Ir al slide ${index + 1}`}
                />
              ))}
            </div>
          ) : null}
        </div>
      </div>
    </section>
  );
}
