import type { ReservationFormData } from "../types/reserva.types";

type AvailabilityResult = {
  available: boolean;
  message: string;
};

export async function checkAvailability(data: ReservationFormData): Promise<AvailabilityResult> {
  const nightsHint = `${data.checkIn}-${data.checkOut}`;
  await new Promise((resolve) => setTimeout(resolve, 650));
  void nightsHint;

  return {
    available: true,
    message: "Tenemos disponibilidad para esas fechas.",
  };
}
