import { getAmenities } from "@/services/home-content.service";

export default async function ServiciosPage() {
  const amenities = await getAmenities();

  return (
    <section className="py-5 min-vh-100 bg-white">
      <div className="container">
        <p className="text-uppercase small mb-1">Servicios</p>
        <h1 className="mb-4">Comodidad durante toda tu estadia</h1>

        {amenities.length > 0 ? (
          <div className="row g-4">
            {amenities.map((service) => (
              <div className="col-md-6 col-lg-4" key={service.title}>
                <article className="p-4 rounded-3 border h-100 shadow-sm">
                  <h5>{service.title}</h5>
                  <p className="text-secondary mb-0">{service.description}</p>
                </article>
              </div>
            ))}
          </div>
        ) : (
          <p className="text-secondary mb-0">No hay servicios activos para mostrar.</p>
        )}
      </div>
    </section>
  );
}
