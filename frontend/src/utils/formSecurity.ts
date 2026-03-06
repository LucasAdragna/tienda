const CONTROL_CHARS = /[\u0000-\u001F\u007F]/g;
const MULTI_SPACES = /\s+/g;
const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
const PHONE_REGEX = /^[+\d()\-\s]{7,20}$/;

export function sanitizeText(input: string): string {
  return input
    .replace(CONTROL_CHARS, "")
    .replace(/[<>]/g, "")
    .replace(MULTI_SPACES, " ")
    .trim();
}

export function sanitizeEmail(input: string): string {
  return sanitizeText(input).toLowerCase();
}

export function sanitizePhone(input: string): string {
  return sanitizeText(input).replace(/[^+\d()\-\s]/g, "");
}

export function isValidEmail(input: string): boolean {
  return EMAIL_REGEX.test(input);
}

export function isValidPhone(input: string): boolean {
  return PHONE_REGEX.test(input);
}

export function isTooSoon(lastSubmitAt: number | null, cooldownMs: number): boolean {
  if (!lastSubmitAt) return false;
  return Date.now() - lastSubmitAt < cooldownMs;
}
