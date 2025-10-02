import 'bootstrap/dist/css/bootstrap.min.css';
import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";


// Si usas alias "@", ajusta tsconfig.json
import Header from "@/components/Header";
import Footer from "@/components/Footer";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: {
    default: "Mi Tienda",
    template: "%s · Mi Tienda",
  },
  description: "Ecommerce moderno con Next.js",
  metadataBase: new URL("https://example.com"), // cambia tu dominio
  icons: { icon: "/favicon.ico" },
  openGraph: {
    title: "Mi Tienda",
    description: "Catálogo de productos y panel admin",
    url: "https://example.com",
    siteName: "Mi Tienda",
    images: ["/og.png"], // opcional: coloca /public/og.png
    locale: "es_ES",
    type: "website",
  },
  alternates: {
    canonical: "/",
  },
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="es">
      <body className={inter.className}>
        {/* Header y Footer globales */}
        <Header />
        <main className="min-h-screen">{children}</main>
        <Footer />
      </body>
    </html>
  );
}
