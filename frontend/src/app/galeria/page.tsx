import Image from "next/image";
import { getGalleryPreview } from "@/services/home-content.service";

export default async function GaleriaPage() {
  const images = await getGalleryPreview();

  return (
    <section className="py-5 bg-light min-vh-100">
      <div className="container">
        <p className="text-uppercase small mb-1">Galeria</p>
        <h1 className="mb-4">Espacios y experiencias</h1>

        {images.length > 0 ? (
          <div className="row g-3">
            {images.map((image, index) => (
              <div className="col-6 col-lg-4" key={`${image.src}-${index}`}>
                <div className="rounded-3 overflow-hidden bg-white h-100 shadow-sm">
                  <Image src={image.src} alt={image.alt} width={800} height={600} className="w-100 h-100 object-fit-cover" />
                </div>
              </div>
            ))}
          </div>
        ) : (
          <p className="text-secondary mb-0">No hay imagenes visibles para mostrar.</p>
        )}
      </div>
    </section>
  );
}
