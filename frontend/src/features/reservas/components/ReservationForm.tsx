"use client";

import { useMemo, useState } from "react";
import { isTooSoon, sanitizeEmail, sanitizeText } from "@/utils/formSecurity";
import { checkAvailability } from "../services/reserva.service";
import type { ReservationFormData, ReservationValidationErrors } from "../types/reserva.types";
import { validateReservation } from "../validators/reserva.validator";

const COOLDOWN_MS = 10_000;

const initialData: ReservationFormData = {
  checkIn: "",
  checkOut: "",
  adults: 2,
  children: 0,
  roomType: "suite-mar",
  guestName: "",
  guestEmail: "",
  website: "",
};

export default function ReservationForm() {
  const [form, setForm] = useState<ReservationFormData>(initialData);
  const [errors, setErrors] = useState<ReservationValidationErrors>({});
  const [status, setStatus] = useState<string>("");
  const [loading, setLoading] = useState(false);
  const [lastSubmitAt, setLastSubmitAt] = useState<number | null>(null);

  const nights = useMemo(() => {
    if (!form.checkIn || !form.checkOut) return 0;
    const start = new Date(form.checkIn);
    const end = new Date(form.checkOut);
    const diff = Math.ceil((end.getTime() - start.getTime()) / (1000 * 60 * 60 * 24));
    return diff > 0 ? diff : 0;
  }, [form.checkIn, form.checkOut]);

  const minDate = useMemo(() => new Date().toISOString().split("T")[0], []);

  const onSubmit = async (event: React.FormEvent) => {
    event.preventDefault();

    if (isTooSoon(lastSubmitAt, COOLDOWN_MS)) {
      setStatus("Espera unos segundos antes de reenviar.");
      return;
    }

    const payload: ReservationFormData = {
      ...form,
      guestName: sanitizeText(form.guestName),
      guestEmail: sanitizeEmail(form.guestEmail),
      website: sanitizeText(form.website),
    };

    const validation = validateReservation(payload);
    setErrors(validation);

    if (Object.keys(validation).length > 0) {
      setStatus("Revisa los campos marcados antes de continuar.");
      return;
    }

    setLoading(true);
    setStatus("Verificando disponibilidad...");
    setLastSubmitAt(Date.now());

    const result = await checkAvailability(payload);
    setLoading(false);

    if (result.available) {
      setStatus(`OK: ${result.message} Siguiente paso: pago y confirmacion.`);
      setForm((prev) => ({ ...prev, guestName: payload.guestName, guestEmail: payload.guestEmail }));
    } else {
      setStatus(result.message);
    }
  };

  return (
    <form className="p-4 bg-white rounded-3 shadow-sm" onSubmit={onSubmit} noValidate>
      <input
        type="text"
        name="website"
        value={form.website}
        onChange={(event) => setForm({ ...form, website: event.target.value })}
        tabIndex={-1}
        autoComplete="off"
        aria-hidden="true"
        className="d-none"
      />

      <div className="row g-3">
        <div className="col-md-6">
          <label htmlFor="checkIn" className="form-label">Check-in</label>
          <input
            id="checkIn"
            type="date"
            className="form-control"
            min={minDate}
            value={form.checkIn}
            onChange={(event) => setForm({ ...form, checkIn: event.target.value })}
            required
          />
          {errors.checkIn && <div className="text-danger small mt-1">{errors.checkIn}</div>}
        </div>

        <div className="col-md-6">
          <label htmlFor="checkOut" className="form-label">Check-out</label>
          <input
            id="checkOut"
            type="date"
            className="form-control"
            min={form.checkIn || minDate}
            value={form.checkOut}
            onChange={(event) => setForm({ ...form, checkOut: event.target.value })}
            required
          />
          {errors.checkOut && <div className="text-danger small mt-1">{errors.checkOut}</div>}
        </div>

        <div className="col-md-4">
          <label htmlFor="adults" className="form-label">Adultos</label>
          <input
            id="adults"
            type="number"
            min={1}
            max={8}
            className="form-control"
            value={form.adults}
            onChange={(event) => setForm({ ...form, adults: Number(event.target.value) })}
            required
          />
          {errors.adults && <div className="text-danger small mt-1">{errors.adults}</div>}
        </div>

        <div className="col-md-4">
          <label htmlFor="children" className="form-label">Ninos</label>
          <input
            id="children"
            type="number"
            min={0}
            max={6}
            className="form-control"
            value={form.children}
            onChange={(event) => setForm({ ...form, children: Number(event.target.value) })}
            required
          />
          {errors.children && <div className="text-danger small mt-1">{errors.children}</div>}
        </div>

        <div className="col-md-4">
          <label htmlFor="roomType" className="form-label">Habitacion</label>
          <select
            id="roomType"
            className="form-select"
            value={form.roomType}
            onChange={(event) => setForm({ ...form, roomType: event.target.value })}
          >
            <option value="suite-mar">Suite Vista Mar</option>
            <option value="familiar-plus">Familiar Plus</option>
            <option value="doble-confort">Doble Confort</option>
            <option value="junior-suite">Junior Suite</option>
          </select>
        </div>

        <div className="col-md-6">
          <label htmlFor="guestName" className="form-label">Nombre y apellido</label>
          <input
            id="guestName"
            className="form-control"
            value={form.guestName}
            onChange={(event) => setForm({ ...form, guestName: event.target.value })}
            placeholder="Ej: Lucas Perez"
            autoComplete="name"
            minLength={3}
            maxLength={80}
            required
          />
          {errors.guestName && <div className="text-danger small mt-1">{errors.guestName}</div>}
        </div>

        <div className="col-md-6">
          <label htmlFor="guestEmail" className="form-label">Email</label>
          <input
            id="guestEmail"
            type="email"
            className="form-control"
            value={form.guestEmail}
            onChange={(event) => setForm({ ...form, guestEmail: event.target.value })}
            placeholder="huesped@email.com"
            autoComplete="email"
            maxLength={120}
            required
          />
          {errors.guestEmail && <div className="text-danger small mt-1">{errors.guestEmail}</div>}
        </div>
      </div>

      <div className="d-flex flex-wrap justify-content-between align-items-center mt-4 gap-3">
        <p className="mb-0 text-secondary">Noches: <strong>{nights}</strong></p>
        <button className="btn btn-primary" disabled={loading} type="submit">
          {loading ? "Consultando..." : "Validar disponibilidad"}
        </button>
      </div>

      {status && <div className="alert alert-info mt-3 mb-0">{status}</div>}
    </form>
  );
}
