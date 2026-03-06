import { isValidEmail } from "@/utils/formSecurity";
import type { ReservationFormData, ReservationValidationErrors } from "../types/reserva.types";

export function validateReservation(data: ReservationFormData): ReservationValidationErrors {
  const errors: ReservationValidationErrors = {};

  if (data.website.trim()) errors.website = "Solicitud rechazada.";
  if (!data.checkIn) errors.checkIn = "Selecciona fecha de entrada.";
  if (!data.checkOut) errors.checkOut = "Selecciona fecha de salida.";
  if (!data.guestName.trim()) errors.guestName = "Ingresa nombre del huesped.";
  if (data.guestName.length < 3 || data.guestName.length > 80) {
    errors.guestName = "El nombre debe tener entre 3 y 80 caracteres.";
  }
  if (!isValidEmail(data.guestEmail)) errors.guestEmail = "Ingresa un email valido.";
  if (!Number.isInteger(data.adults) || data.adults < 1 || data.adults > 8) {
    errors.adults = "Adultos permitidos: 1 a 8.";
  }
  if (!Number.isInteger(data.children) || data.children < 0 || data.children > 6) {
    errors.children = "Ninos permitidos: 0 a 6.";
  }
  if (data.adults + data.children > 8) {
    errors.children = "La ocupacion maxima por reserva es de 8 personas.";
  }

  if (data.checkIn && data.checkOut) {
    const inDate = new Date(data.checkIn);
    const outDate = new Date(data.checkOut);
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    if (inDate < today) {
      errors.checkIn = "La entrada no puede ser en el pasado.";
    }

    if (outDate <= inDate) {
      errors.checkOut = "La salida debe ser posterior al check-in.";
    }
  }

  return errors;
}
