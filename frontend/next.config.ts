import type { NextConfig } from "next";

const backendUrl = process.env.NEXT_PUBLIC_BACKEND_URL ?? process.env.BACKEND_URL;

const dynamicRemotePattern = (() => {
  if (!backendUrl) {
    return null;
  }

  try {
    const parsed = new URL(backendUrl);
    return {
      protocol: parsed.protocol.replace(":", "") as "http" | "https",
      hostname: parsed.hostname,
      port: parsed.port || "",
      pathname: "/**",
    };
  } catch {
    return null;
  }
})();

const nextConfig: NextConfig = {
  images: {
    remotePatterns: [
      {
        protocol: "http",
        hostname: "127.0.0.1",
        port: "8000",
        pathname: "/**",
      },
      {
        protocol: "http",
        hostname: "localhost",
        port: "8000",
        pathname: "/**",
      },
      ...(dynamicRemotePattern ? [dynamicRemotePattern] : []),
    ],
  },
};

export default nextConfig;
