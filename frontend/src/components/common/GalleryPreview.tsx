import Image from "next/image";
import Link from "next/link";
import { getGalleryPreview } from "@/services/home-content.service";

export default async function GalleryPreview() {
  const images = await getGalleryPreview();

  return (
    <section className="py-5 bg-white">
      <div className="container">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <div>
            <p className="text-uppercase small mb-1">Galeria</p>
            <h2 className="mb-0">Conoce nuestros espacios</h2>
          </div>
          <Link href="/galeria" className="btn btn-outline-secondary">
            Ver galeria completa
          </Link>
        </div>
        {images.length > 0 ? (
          <div className="row g-3">
            {images.slice(0, 6).map((image, index) => (
              <div className="col-6 col-md-4" key={`${image.src}-${index}`}>
                <div className="gallery-thumb position-relative rounded-3 overflow-hidden">
                  <Image
                    src={image.src}
                    alt={image.alt}
                    width={600}
                    height={400}
                    className="w-100 h-100 object-fit-cover"
                  />
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
