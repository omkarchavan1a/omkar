import { serviceCategories, services } from '@/lib/data';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import Link from 'next/link';
import Image from 'next/image';
import { Button } from '@/components/ui/button';
import { ArrowRight } from 'lucide-react';
import AiMatcher from '@/components/ai-matcher';
import { PlaceHolderImages } from '@/lib/placeholder-images';

export default function Home() {
  const heroImage = PlaceHolderImages.find(img => img.id === '11') || PlaceHolderImages[0];

  return (
    <div className="flex flex-col min-h-[100dvh]">
      <section className="w-full py-12 md:py-24 lg:py-32 xl:py-48 bg-card">
        <div className="container px-4 md:px-6">
          <div className="grid gap-6 lg:grid-cols-[1fr_400px] lg:gap-12 xl:grid-cols-[1fr_600px]">
            <div className="flex flex-col justify-center space-y-4">
              <div className="space-y-2">
                <h1 className="text-3xl font-bold tracking-tighter sm:text-5xl xl:text-6xl/none font-headline text-primary">
                  Data-Driven Digital Services
                </h1>
                <p className="max-w-[600px] text-muted-foreground md:text-xl">
                  microGT delivers professional data, video, and presentation services to elevate your brand.
                </p>
              </div>
              <div className="flex flex-col gap-2 min-[400px]:flex-row">
                <Link
                  href="/#services"
                  className="inline-flex h-10 items-center justify-center rounded-md bg-primary px-8 text-sm font-medium text-primary-foreground shadow transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50"
                >
                  Explore Services
                </Link>
                <Link
                  href="/contact"
                  className="inline-flex h-10 items-center justify-center rounded-md border border-input bg-background px-8 text-sm font-medium shadow-sm transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50"
                >
                  Contact Us
                </Link>
              </div>
            </div>
            {heroImage && (
              <Image
                src={heroImage.imageUrl}
                width={600}
                height={400}
                alt="Hero image"
                data-ai-hint={heroImage.imageHint}
                className="mx-auto aspect-video overflow-hidden rounded-xl object-cover sm:w-full lg:order-last"
              />
            )}
          </div>
        </div>
      </section>

      <section id="ai-matcher" className="w-full py-12 md:py-24 lg:py-32">
        <div className="container px-4 md:px-6">
          <div className="flex flex-col items-center justify-center space-y-4 text-center">
            <div className="space-y-2">
              <div className="inline-block rounded-lg bg-secondary px-3 py-1 text-sm">AI-Powered Recommendations</div>
              <h2 className="text-3xl font-bold tracking-tighter sm:text-5xl font-headline">Not Sure Where to Start?</h2>
              <p className="max-w-[900px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                Describe your project, and our AI will suggest the best services to meet your needs.
              </p>
            </div>
          </div>
          <div className="mx-auto max-w-3xl mt-8">
            <AiMatcher />
          </div>
        </div>
      </section>

      <section id="services" className="w-full py-12 md:py-24 lg:py-32 bg-card">
        <div className="container px-4 md:px-6">
          <div className="flex flex-col items-center justify-center space-y-4 text-center">
            <div className="space-y-2">
              <h2 className="text-3xl font-bold tracking-tighter sm:text-5xl font-headline">Our Services</h2>
              <p className="max-w-[900px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                Browse our range of services designed to help your business succeed.
              </p>
            </div>
          </div>
          <div className="mx-auto grid grid-cols-1 gap-6 py-12 sm:grid-cols-2 lg:grid-cols-3">
            {serviceCategories.map((category) => (
              <Link href={`/services/${category.id}`} key={category.id} className="group">
                <Card className="h-full flex flex-col hover:shadow-lg transition-shadow duration-300">
                  <CardHeader className="flex flex-row items-center gap-4">
                    <category.icon className="w-10 h-10 text-primary" />
                    <CardTitle>{category.name}</CardTitle>
                  </CardHeader>
                  <CardContent className="flex-grow">
                    <p className="text-muted-foreground">{category.description}</p>
                  </CardContent>
                  <div className="p-6 pt-0">
                      <p className="text-sm font-medium text-primary group-hover:underline flex items-center gap-1">
                          View Services <ArrowRight className="w-4 h-4 transition-transform group-hover:translate-x-1" />
                      </p>
                  </div>
                </Card>
              </Link>
            ))}
          </div>
        </div>
      </section>
      
      <section className="w-full py-12 md:py-24 lg:py-32">
        <div className="container grid items-center justify-center gap-4 px-4 text-center md:px-6">
          <div className="space-y-3">
            <h2 className="text-3xl font-bold tracking-tighter md:text-4xl/tight font-headline">Featured Work</h2>
            <p className="mx-auto max-w-[600px] text-muted-foreground md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
              Check out some examples of our successful projects.
            </p>
          </div>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            {services.slice(0, 3).map(service => {
              const image = PlaceHolderImages.find(img => img.id === service.examples[0].imageId);
              return image ? (
                <Link href={`/service/${service.slug}`} key={service.id} className="group">
                  <Card className="overflow-hidden">
                    <Image
                      src={image.imageUrl}
                      alt={service.examples[0].title}
                      data-ai-hint={image.imageHint}
                      width={600}
                      height={400}
                      className="aspect-video w-full object-cover transition-transform group-hover:scale-105"
                    />
                    <CardContent className="p-4">
                      <h3 className="font-semibold text-lg">{service.name}</h3>
                      <p className="text-sm text-muted-foreground">{service.shortDescription}</p>
                    </CardContent>
                  </Card>
                </Link>
              ) : null;
            })}
          </div>
        </div>
      </section>
    </div>
  );
}
