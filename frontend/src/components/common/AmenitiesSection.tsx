import { hotelAmenities } from "@/constants/hotel";

export default function AmenitiesSection() {
  return (
    <section className="py-5 bg-light">
      <div className="container">
        <div className="row align-items-center g-4">
          <div className="col-lg-5">
            <p className="text-uppercase small mb-1">Servicios</p>
            <h2 className="mb-3">Todo lo que necesitas en un solo lugar</h2>
            <p className="mb-0 text-secondary">
              Basado en los bloques de servicios/proceso de `maqueta/index.html` y secciones de instalaciones de `maqueta/nosotros.html`.
            </p>
          </div>
          <div className="col-lg-7">
            <div className="row g-3">
              {hotelAmenities.map((item) => (
                <div className="col-sm-6" key={item.title}>
                  <article className="p-3 border rounded-3 h-100 bg-white">
                    <h5 className="mb-2">{item.title}</h5>
                    <p className="mb-0 text-secondary">{item.description}</p>
                  </article>
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
