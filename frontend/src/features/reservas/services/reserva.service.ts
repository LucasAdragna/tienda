import { BACKEND_URL } from "@/lib/backend-client";
import type { ReservationFormData, ReservationValidationErrors } from "../types/reserva.types";

type AvailabilityResult = {
  available: boolean;
  message: string;
  errors?: ReservationValidationErrors;
};

export async function checkAvailability(data: ReservationFormData): Promise<AvailabilityResult> {
  const response = await fetch(`${BACKEND_URL}/api/reservations`, {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  });

  const payload = await response.json().catch(() => null) as {
    message?: string;
    errors?: Record<string, string[]>;
  } | null;

  if (!response.ok) {
    return {
      available: false,
      message: payload?.message ?? "No pudimos registrar la reserva. Intenta nuevamente.",
      errors: normalizeErrors(payload?.errors),
    };
  }

  return {
    available: true,
    message: payload?.message ?? "Recibimos tu solicitud de reserva.",
  };
}

function normalizeErrors(errors?: Record<string, string[]>): ReservationValidationErrors | undefined {
  if (!errors) return undefined;

  return Object.entries(errors).reduce<ReservationValidationErrors>((accumulator, [field, messages]) => {
    accumulator[field as keyof ReservationFormData] = messages[0];
    return accumulator;
  }, {});
}
