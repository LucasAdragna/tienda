const DEFAULT_BACKEND_URL = "http://127.0.0.1:8000";

export const BACKEND_URL =
  process.env.NEXT_PUBLIC_BACKEND_URL ??
  process.env.BACKEND_URL ??
  DEFAULT_BACKEND_URL;

type BackendGetOptions = {
  revalidate?: number;
  cache?: RequestCache;
  headers?: HeadersInit;
};

export async function backendGet<T>(
  path: string,
  options: BackendGetOptions = {},
): Promise<T | null> {
  const { revalidate, cache = "no-store", headers } = options;
  const endpoint = `${BACKEND_URL}${path.startsWith("/") ? path : `/${path}`}`;

  try {
    const response = await fetch(endpoint, {
      method: "GET",
      cache,
      headers: {
        Accept: "application/json",
        ...headers,
      },
      ...(typeof revalidate === "number" ? { next: { revalidate } } : {}),
    });

    if (!response.ok) {
      return null;
    }

    return (await response.json()) as T;
  } catch {
    return null;
  }
}
