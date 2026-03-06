export type ReservationFormData = {
  checkIn: string;
  checkOut: string;
  adults: number;
  children: number;
  roomType: string;
  guestName: string;
  guestEmail: string;
  website: string;
};

export type ReservationValidationErrors = Partial<Record<keyof ReservationFormData, string>>;
