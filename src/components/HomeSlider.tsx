// src/components/HomeSlider.tsx
"use client";

import Image from "next/image";
import { useId } from "react";

const slides = [
  {
    src: "/images/slider/slide-1.jpg",
    titulo: "Novedades de temporada",
    texto: "Descubrí los últimos lanzamientos con envíos en 48h.",
    cta: { label: "Comprar ahora", href: "/productos" },
  },
  {
    src: "/images/slider/slide-2.jpg",
    titulo: "Ofertas imperdibles",
    texto: "Ahorros hasta 30% en productos seleccionados.",
    cta: { label: "Ver ofertas", href: "/productos?promo=true" },
  },
  {
    src: "/images/slider/slide-3.jpg",
    titulo: "Calidad garantizada",
    texto: "Soporte local y 30 días para cambios.",
    cta: { label: "Conocer más", href: "/login" },
  },
];

export default function HomeSlider() {
  const carouselId = useId().replace(/:/g, "");
  return (
    <div id={`carousel-${carouselId}`} className="carousel slide" data-bs-ride="carousel">
      {/* Indicadores */}
      <div className="carousel-indicators">
        {slides.map((_, i) => (
          <button
            key={i}
            type="button"
            data-bs-target={`#carousel-${carouselId}`}
            data-bs-slide-to={i}
            className={i === 0 ? "active" : ""}
            aria-label={`Slide ${i + 1}`}
          />
        ))}
      </div>

      {/* Slides */}
      <div className="carousel-inner">
        {slides.map((s, i) => (
          <div className={`carousel-item ${i === 0 ? "active" : ""}`} key={s.src}>
            <div className="position-relative" style={{ minHeight: 420 }}>
              <Image
                src={s.src}
                alt={s.titulo}
                fill
                priority={i === 0}
                className="object-fit-cover"
              />
              <div className="carousel-caption text-start">
                <h2 className="fw-bold">{s.titulo}</h2>
                <p className="mb-3">{s.texto}</p>
                <a href={s.cta.href} className="btn btn-primary btn-lg">
                  {s.cta.label}
                </a>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Controles */}
      <button className="carousel-control-prev" type="button" data-bs-target={`#carousel-${carouselId}`} data-bs-slide="prev">
        <span className="carousel-control-prev-icon" aria-hidden="true" />
        <span className="visually-hidden">Anterior</span>
      </button>
      <button className="carousel-control-next" type="button" data-bs-target={`#carousel-${carouselId}`} data-bs-slide="next">
        <span className="carousel-control-next-icon" aria-hidden="true" />
        <span className="visually-hidden">Siguiente</span>
      </button>
    </div>
  );
}
