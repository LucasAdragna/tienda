import { hotelAmenities } from "@/constants/hotel";

export default function ServiciosPage() {
  return (
    <section className="py-5 min-vh-100 bg-white">
      <div className="container">
        <p className="text-uppercase small mb-1">Servicios</p>
        <h1 className="mb-4">Comodidad durante toda tu estadia</h1>

        <div className="row g-4">
          {hotelAmenities.map((service) => (
            <div className="col-md-6 col-lg-4" key={service.title}>
              <article className="p-4 rounded-3 border h-100 shadow-sm">
                <h5>{service.title}</h5>
                <p className="text-secondary mb-0">{service.description}</p>
              </article>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
