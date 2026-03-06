"use client";

import { useState } from "react";
import { isTooSoon, sanitizeEmail, sanitizePhone, sanitizeText } from "@/utils/formSecurity";
import type { ContactFormData, ContactValidationErrors } from "../types/contacto.types";
import { validateContactForm } from "../validators/contacto.validator";

const COOLDOWN_MS = 10_000;

const initialData: ContactFormData = {
  name: "",
  email: "",
  phone: "",
  subject: "",
  message: "",
  website: "",
};

export default function ContactForm() {
  const [form, setForm] = useState<ContactFormData>(initialData);
  const [errors, setErrors] = useState<ContactValidationErrors>({});
  const [status, setStatus] = useState("");
  const [lastSubmitAt, setLastSubmitAt] = useState<number | null>(null);

  const onSubmit = (event: React.FormEvent) => {
    event.preventDefault();

    if (isTooSoon(lastSubmitAt, COOLDOWN_MS)) {
      setStatus("Espera unos segundos antes de reenviar.");
      return;
    }

    const payload: ContactFormData = {
      name: sanitizeText(form.name),
      email: sanitizeEmail(form.email),
      phone: sanitizePhone(form.phone),
      subject: sanitizeText(form.subject),
      message: sanitizeText(form.message),
      website: sanitizeText(form.website),
    };

    const validation = validateContactForm(payload);
    setErrors(validation);

    if (Object.keys(validation).length > 0) {
      setStatus("Revisa los campos marcados.");
      return;
    }

    setLastSubmitAt(Date.now());
    setStatus("Formulario validado. Siguiente paso: enviar al backend (API de contacto).");
    setForm((prev) => ({ ...prev, ...payload, website: "" }));
  };

  return (
    <form className="row g-3 p-4 border rounded-3 shadow-sm" onSubmit={onSubmit} noValidate>
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

      <div className="col-md-6">
        <label htmlFor="name" className="form-label">Nombre</label>
        <input
          id="name"
          className="form-control"
          placeholder="Tu nombre"
          value={form.name}
          autoComplete="name"
          minLength={3}
          maxLength={80}
          onChange={(event) => setForm({ ...form, name: event.target.value })}
          required
        />
        {errors.name && <div className="text-danger small mt-1">{errors.name}</div>}
      </div>

      <div className="col-md-6">
        <label htmlFor="email" className="form-label">Email</label>
        <input
          id="email"
          type="email"
          className="form-control"
          placeholder="tu@email.com"
          value={form.email}
          autoComplete="email"
          maxLength={120}
          onChange={(event) => setForm({ ...form, email: event.target.value })}
          required
        />
        {errors.email && <div className="text-danger small mt-1">{errors.email}</div>}
      </div>

      <div className="col-md-6">
        <label htmlFor="phone" className="form-label">Telefono</label>
        <input
          id="phone"
          className="form-control"
          placeholder="+54..."
          value={form.phone}
          autoComplete="tel"
          minLength={7}
          maxLength={20}
          onChange={(event) => setForm({ ...form, phone: event.target.value })}
          required
        />
        {errors.phone && <div className="text-danger small mt-1">{errors.phone}</div>}
      </div>

      <div className="col-md-6">
        <label htmlFor="subject" className="form-label">Asunto</label>
        <input
          id="subject"
          className="form-control"
          placeholder="Consulta de reservas"
          value={form.subject}
          minLength={4}
          maxLength={120}
          onChange={(event) => setForm({ ...form, subject: event.target.value })}
          required
        />
        {errors.subject && <div className="text-danger small mt-1">{errors.subject}</div>}
      </div>

      <div className="col-12">
        <label htmlFor="message" className="form-label">Mensaje</label>
        <textarea
          id="message"
          className="form-control"
          rows={5}
          placeholder="Te escribimos en breve..."
          value={form.message}
          minLength={10}
          maxLength={1200}
          onChange={(event) => setForm({ ...form, message: event.target.value })}
          required
        />
        {errors.message && <div className="text-danger small mt-1">{errors.message}</div>}
      </div>

      <div className="col-12 d-flex justify-content-between align-items-center gap-2 flex-wrap">
        <button className="btn btn-primary" type="submit">Enviar</button>
        {status && <span className="small text-secondary">{status}</span>}
      </div>
    </form>
  );
}
