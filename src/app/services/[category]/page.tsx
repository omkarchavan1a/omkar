import { serviceCategories, services } from "@/lib/data";
import { notFound } from "next/navigation";
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from "@/components/ui/card";
import Link from "next/link";
import Image from "next/image";
import { PlaceHolderImages } from "@/lib/placeholder-images";
import { Button } from "@/components/ui/button";

export async function generateStaticParams() {
    return serviceCategories.map((category) => ({
        category: category.id,
    }));
}

export default function CategoryPage({ params }: { params: { category: string } }) {
    const category = serviceCategories.find(c => c.id === params.category);
    const categoryServices = services.filter(s => s.category === params.category);

    if (!category) {
        notFound();
    }

    const Icon = category.icon;

    return (
        <div className="container mx-auto max-w-6xl py-12 px-4 md:py-24 md:px-6">
            <div className="mb-12 flex flex-col items-center text-center">
                <Icon className="w-16 h-16 text-primary mb-4" />
                <h1 className="text-4xl font-bold tracking-tight font-headline">{category.name}</h1>
                <p className="text-muted-foreground text-lg max-w-2xl mx-auto mt-2">{category.description}</p>
            </div>

            <div className="grid gap-8">
                {categoryServices.map((service) => {
                    const image = PlaceHolderImages.find(img => img.id === service.examples[0].imageId);
                    return (
                        <Card key={service.id} className="grid md:grid-cols-2 overflow-hidden shadow-sm hover:shadow-lg transition-shadow">
                            {image && (
                                <div className="relative aspect-video">
                                    <Image
                                        src={image.imageUrl}
                                        alt={service.examples[0].title}
                                        data-ai-hint={image.imageHint}
                                        fill
                                        className="object-cover"
                                    />
                                </div>
                            )}
                            <div className="flex flex-col justify-between p-6">
                                <div>
                                    <CardTitle className="text-2xl mb-2">{service.name}</CardTitle>
                                    <CardDescription>{service.shortDescription}</CardDescription>
                                </div>
                                <div className="mt-4">
                                    <Button asChild>
                                        <Link href={`/service/${service.slug}`}>View Details & Inquire</Link>
                                    </Button>
                                </div>
                            </div>
                        </Card>
                    )
                })}
            </div>
        </div>
    );
}
