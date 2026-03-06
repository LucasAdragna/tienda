"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useState } from "react";

const links = [
  { href: "/", label: "Inicio" },
  { href: "/habitaciones", label: "Habitaciones" },
  { href: "/servicios", label: "Servicios" },
  { href: "/galeria", label: "Galeria" },
  { href: "/contacto", label: "Contacto" },
  { href: "/reservas", label: "Reservar" },
];

export default function Header() {
  const pathname = usePathname();
  const [open, setOpen] = useState(false);

  return (
    <header className="border-bottom bg-white sticky-top">
      <nav className="navbar navbar-expand-lg navbar-light container py-3">
        <Link href="/" className="navbar-brand fw-bold">
          Hotel Costa Azul
        </Link>

        <button
          className="navbar-toggler"
          type="button"
          aria-label="Abrir menu"
          onClick={() => setOpen((value) => !value)}
        >
          <span className="navbar-toggler-icon" />
        </button>

        <div className={`collapse navbar-collapse ${open ? "show" : ""}`}>
          <ul className="navbar-nav ms-auto align-items-lg-center gap-lg-2">
            {links.map((link) => {
              const isActive = pathname === link.href;
              const linkClass = link.href === "/reservas"
                ? "btn btn-primary ms-lg-2"
                : `nav-link ${isActive ? "active fw-semibold" : ""}`;

              return (
                <li className="nav-item" key={link.href}>
                  <Link href={link.href} className={linkClass}>
                    {link.label}
                  </Link>
                </li>
              );
            })}
          </ul>
        </div>
      </nav>
    </header>
  );
}
