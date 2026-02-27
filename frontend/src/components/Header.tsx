"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useState } from "react";

export default function Header() {
  const pathname = usePathname();
  const [open, setOpen] = useState(false);

  const isActive = (href: string) =>
    pathname === href ? "active" : undefined;

  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
      <div className="container">
        <Link href="/" className="navbar-brand fw-semibold">
          Mi Tienda
        </Link>

        <button
          className="navbar-toggler"
          type="button"
          aria-label="Toggle navigation"
          onClick={() => setOpen(!open)}
        >
          <span className="navbar-toggler-icon" />
        </button>

        <div className={`collapse navbar-collapse ${open ? "show" : ""}`}>
          <ul className="navbar-nav ms-auto">
            <li className="nav-item">
              <Link href="/productos" className={`nav-link ${isActive("/productos")}`}>
                Productos
              </Link>
            </li>
            <li className="nav-item">
              <Link href="/login" className={`nav-link ${isActive("/login")}`}>
                Login
              </Link>
            </li>
            <li className="nav-item">
              <Link href="/contacto" className={`nav-link ${isActive("/contacto")}`}>
                Contacto
              </Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
}
