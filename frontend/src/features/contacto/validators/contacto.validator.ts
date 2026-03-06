import { isValidEmail, isValidPhone } from "@/utils/formSecurity";
import type { ContactFormData, ContactValidationErrors } from "../types/contacto.types";

export function validateContactForm(data: ContactFormData): ContactValidationErrors {
  const errors: ContactValidationErrors = {};

  if (data.website.trim()) errors.website = "Solicitud rechazada.";
  if (data.name.length < 3 || data.name.length > 80) errors.name = "Nombre: 3 a 80 caracteres.";
  if (!isValidEmail(data.email)) errors.email = "Email invalido.";
  if (!isValidPhone(data.phone)) errors.phone = "Telefono invalido.";
  if (data.subject.length < 4 || data.subject.length > 120) errors.subject = "Asunto: 4 a 120 caracteres.";
  if (data.message.length < 10 || data.message.length > 1200) errors.message = "Mensaje: 10 a 1200 caracteres.";

  return errors;
}
