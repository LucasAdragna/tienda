export type ContactFormData = {
  name: string;
  email: string;
  phone: string;
  subject: string;
  message: string;
  website: string;
};

export type ContactValidationErrors = Partial<Record<keyof ContactFormData, string>>;
