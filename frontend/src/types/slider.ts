export type HeroSlide = {
  id: number;
  title: string;
  text: string;
  image: string;
  link: string;
  order: number;
};

export type SliderApiResponse = {
  data?: HeroSlide[];
};
