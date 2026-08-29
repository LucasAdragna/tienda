import Image from "next/image";
import { getAboutUs } from "@/services/home-content.service";

export default async function AboutUsSection() {
  const aboutUs = await getAboutUs();

  if (!aboutUs) {
    return null;
  }

  return (
    <section className="about-us-section py-5">
      <div className="container">
        <div className="row align-items-center g-4 g-lg-5">
          <div className="col-lg-6">
            <div className="about-us-image">
              <Image src={aboutUs.image} alt={aboutUs.title} fill sizes="(max-width: 991px) 100vw, 50vw" />
            </div>
          </div>
          <div className="col-lg-6">
            <p className="about-us-kicker">Sobre nosotros</p>
            <h2 className="mb-3">{aboutUs.title}</h2>
            <p className="about-us-text mb-4">{aboutUs.text}</p>
            <a className="btn btn-outline-primary" href={aboutUs.pdf} target="_blank" rel="noreferrer">
              Conocé nuestra historia
            </a>
          </div>
        </div>
      </div>
    </section>
  );
}
