import { services, serviceCategories } from "@/lib/data";
import { notFound } from "next/navigation";
import Image from "next/image";
import { PlaceHolderImages } from "@/lib/placeholder-images";
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from "@/components/ui/card";
import { InquiryForm } from "@/components/inquiry-form";
import { Badge } from "@/components/ui/badge";
import Link from "next/link";
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from "@/components/ui/carousel";


export async function generateStaticParams() {
    return services.map((service) => ({
        slug: service.slug,
    }));
}

export default function ServiceDetailPage({ params }: { params: { slug: string } }) {
    const service = services.find(s => s.slug === params.slug);
    
    if (!service) {
        notFound();
    }

    const category = serviceCategories.find(c => c.id === service.category);

    return (
        <div className="container mx-auto max-w-6xl py-12 px-4 md:py-24 md:px-6">
            <div className="grid md:grid-cols-2 gap-12">
                <div>
                    {category && (
                         <Link href={`/services/${category.id}`} className="mb-4 inline-block">
                             <Badge variant="secondary">{category.name}</Badge>
                         </Link>
                    )}
                    <h1 className="text-4xl font-bold tracking-tight font-headline mb-4">{service.name}</h1>
                    <p className="text-muted-foreground text-lg mb-6">{service.longDescription}</p>
                    
                    <h2 className="text-2xl font-semibold tracking-tight font-headline mt-12 mb-6">Project Examples</h2>
                    <Carousel className="w-full max-w-xl mx-auto">
                        <CarouselContent>
                            {service.examples.map(example => {
                                const image = PlaceHolderImages.find(img => img.id === example.imageId);
                                return image ? (
                                    <CarouselItem key={example.id}>
                                        <Card className="overflow-hidden">
                                            <Image
                                                src={image.imageUrl}
                                                alt={example.title}
                                                data-ai-hint={image.imageHint}
                                                width={600}
                                                height={400}
                                                className="aspect-video w-full object-cover"
                                            />
                                            <CardContent className="p-4">
                                                <h3 className="font-semibold">{example.title}</h3>
                                                <p className="text-sm text-muted-foreground">{example.description}</p>
                                            </CardContent>
                                        </Card>
                                    </CarouselItem>
                                ) : null;
                            })}
                        </CarouselContent>
                        <CarouselPrevious />
                        <CarouselNext />
                    </Carousel>
                </div>
                
                <div className="sticky top-24 self-start">
                    <Card>
                        <CardHeader>
                            <CardTitle>Start Your Project</CardTitle>
                            <CardDescription>Let's build something great together. Fill out the form to get started.</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <InquiryForm serviceId={service.id} />
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>
    );
}
