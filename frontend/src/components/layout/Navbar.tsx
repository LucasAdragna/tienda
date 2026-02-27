import Link from "next/link";

export default function Navbar() {
  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
      <div className="container">
        <Link href="/" className="navbar-brand">Mi Tienda</Link>
        <div className="collapse navbar-collapse">
          <ul className="navbar-nav ms-auto">
            <li className="nav-item"><Link href="/productos" className="nav-link">Productos</Link></li>
            <li className="nav-item"><Link href="/login" className="nav-link">Login</Link></li>
            <li className="nav-item"><Link href="/admin" className="nav-link">Admin</Link></li>
          </ul>
        </div>
      </div>
    </nav>
  );
}
