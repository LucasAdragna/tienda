import { ContactForm } from "@/features/contacto";

export default function ContactoPage() {
  return (
    <section className="py-5 bg-white min-vh-100">
      <div className="container">
        <p className="text-uppercase small mb-1">Contacto</p>
        <h1 className="mb-4">Hablemos sobre tu proxima estadia</h1>

        <div className="row g-4">
          <div className="col-lg-7">
            <ContactForm />
          </div>

          <div className="col-lg-5">
            <aside className="p-4 border rounded-3 bg-light h-100">
              <h5>Datos del hotel</h5>
              <p className="mb-2"><strong>Direccion:</strong> Av. del Mar 1200, San Juan</p>
              <p className="mb-2"><strong>Telefono:</strong> +54 264 555 1234</p>
              <p className="mb-2"><strong>Email:</strong> reservas@hotelcostaazul.com</p>
              <p className="mb-0 text-secondary">Estructura inspirada en `maqueta/contact.html`.</p>
            </aside>
          </div>
        </div>
      </div>
    </section>
  );
}
