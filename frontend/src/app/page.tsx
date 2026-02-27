// src/app/page.tsx
import HomeSlider from "@/components/HomeSlider";
import FeaturedProducts from "@/components/ProductosDestacados";
import LatestNews from "@/components/NoticiasRecientes";

export default function HomePage() {
  return (
    <>
      {/* Slider a todo el ancho */}
      <div className="container-fluid px-0">
        <HomeSlider />
      </div>

      {/* Sección: Quiénes somos */}
      <section className="py-5 bg-light">
        <div className="container">
          <div className="row align-items-center g-4">
            <div className="col-md-6">
              <h2 className="mb-3">¿Quiénes somos?</h2>
              <p className="lead">
                Somos una tienda enfocada en ofrecer productos de calidad, con
                soporte cercano y envíos rápidos. Trabajamos con las mejores
                marcas y curamos cada selección pensando en vos.
              </p>
              <p className="text-muted">
                Nuestro equipo tiene +10 años de experiencia en ecommerce y
                tecnología. Confiá en nosotros para tu próxima compra.
              </p>
              <a href="/productos" className="btn btn-primary">
                Conocer el catálogo
              </a>
            </div>
            <div className="col-md-6">
              <div className="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm">
                {/* Reemplaza por una imagen/iframe de video si querés */}
                <img src="/images/about.jpg" className="w-100 h-100 object-fit-cover" alt="Nuestro equipo" />
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Productos destacados */}
      <FeaturedProducts />

      {/* Noticias recientes */}
      <LatestNews />
    </>
  );
}
