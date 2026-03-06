import Image from "next/image";
import { galleryImages } from "@/constants/hotel";

export default function GaleriaPage() {
  return (
    <section className="py-5 bg-light min-vh-100">
      <div className="container">
        <p className="text-uppercase small mb-1">Galeria</p>
        <h1 className="mb-4">Espacios y experiencias</h1>

        <div className="row g-3">
          {galleryImages.map((image) => (
            <div className="col-6 col-lg-4" key={image.src}>
              <div className="rounded-3 overflow-hidden bg-white h-100 shadow-sm">
                <Image src={image.src} alt={image.alt} width={800} height={600} className="w-100 h-100 object-fit-cover" />
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
