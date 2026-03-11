import { getAmenities } from "@/services/home-content.service";

export default async function AmenitiesSection() {
  const amenities = await getAmenities();

  return (
    <section className="py-5 bg-light">
      <div className="container">
        <div className="row align-items-center g-4">
          <div className="col-lg-5">
            <p className="text-uppercase small mb-1">Servicios</p>
            <h2 className="mb-3">Todo lo que necesitas en un solo lugar</h2>
            <p className="mb-0 text-secondary">
              Datos dinamicos administrados desde el panel del hotel.
            </p>
          </div>
          <div className="col-lg-7">
            {amenities.length > 0 ? (
              <div className="row g-3">
                {amenities.map((item) => (
                  <div className="col-sm-6" key={item.title}>
                    <article className="p-3 border rounded-3 h-100 bg-white">
                      <h5 className="mb-2">{item.title}</h5>
                      <p className="mb-0 text-secondary">{item.description}</p>
                    </article>
                  </div>
                ))}
              </div>
            ) : (
              <p className="text-secondary mb-0">No hay servicios activos para mostrar.</p>
            )}
          </div>
        </div>
      </div>
    </section>
  );
}
