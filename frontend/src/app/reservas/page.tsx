import { ReservationForm } from "@/features/reservas";

export default function ReservasPage() {
  return (
    <section className="py-5 bg-light min-vh-100">
      <div className="container">
        <p className="text-uppercase small mb-1">Reservas</p>
        <h1 className="mb-3">Reserva online en 3 pasos</h1>
        <p className="text-secondary mb-4">
          Paso 1: fechas y ocupacion. Paso 2: datos del huesped. Paso 3: confirmacion.
          En esta primera version implementamos el flujo base con validacion y chequeo mock de disponibilidad.
        </p>
        <ReservationForm />
      </div>
    </section>
  );
}
