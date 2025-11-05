import { Card, CardContent, CardHeader, CardTitle, CardDescription } from "@/components/ui/card";
import { InquiryForm } from "@/components/inquiry-form";
import { Mail, Phone, MapPin } from "lucide-react";

export default function ContactPage() {
  return (
    <div className="container mx-auto max-w-5xl py-12 px-4 md:py-24 md:px-6">
      <div className="text-center space-y-4 mb-12">
        <h1 className="text-4xl font-bold tracking-tight font-headline">Get in Touch</h1>
        <p className="text-muted-foreground text-lg max-w-2xl mx-auto">
          We're here to help. Whether you have a question about our services or want to start a new project, we'd love to hear from you.
        </p>
      </div>

      <div className="grid md:grid-cols-2 gap-12">
        <div className="space-y-8">
          <h2 className="text-2xl font-semibold">Contact Information</h2>
          <div className="space-y-4">
            <div className="flex items-start gap-4">
              <Mail className="h-6 w-6 text-primary mt-1" />
              <div>
                <h3 className="font-semibold">Email</h3>
                <p className="text-muted-foreground">oomkarchavan@gmail.com</p>
              </div>
            </div>
            <div className="flex items-start gap-4">
              <Phone className="h-6 w-6 text-primary mt-1" />
              <div>
                <h3 className="font-semibold">Phone</h3>
                <p className="text-muted-foreground">(123) 456-7890</p>
              </div>
            </div>
            <div className="flex items-start gap-4">
              <MapPin className="h-6 w-6 text-primary mt-1" />
              <div>
                <h3 className="font-semibold">Location</h3>
                <p className="text-muted-foreground">Remote First | New York, NY</p>
              </div>
            </div>
          </div>
        </div>
        
        <Card>
          <CardHeader>
            <CardTitle>Send Us a Message</CardTitle>
            <CardDescription>Fill out the form below and we'll get back to you as soon as possible.</CardDescription>
          </CardHeader>
          <CardContent>
            <InquiryForm />
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
