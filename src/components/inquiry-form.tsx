'use client';

import { useFormState, useFormStatus } from 'react-dom';
import { useEffect, useRef } from 'react';
import { useToast } from '@/hooks/use-toast';
import { submitInquiry, type InquiryState } from '@/app/actions';
import { Button } from './ui/button';
import { Input } from './ui/input';
import { Textarea } from './ui/textarea';
import { Label } from './ui/label';
import { Loader2 } from 'lucide-react';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"
import { services } from '@/lib/data';

function SubmitButton() {
  const { pending } = useFormStatus();
  return (
    <Button type="submit" disabled={pending} className="w-full">
      {pending && <Loader2 className="mr-2 h-4 w-4 animate-spin" />}
      Submit Inquiry
    </Button>
  );
}

interface InquiryFormProps {
  serviceId?: string;
}

export function InquiryForm({ serviceId }: InquiryFormProps) {
  const initialState: InquiryState = { message: null, errors: {}, success: false };
  const [state, dispatch] = useFormState(submitInquiry, initialState);
  const { toast } = useToast();
  const formRef = useRef<HTMLFormElement>(null);

  useEffect(() => {
    if (state.success) {
      if (state.message) {
        toast({
          title: "Success!",
          description: state.message,
        });
      }
      formRef.current?.reset();
    } else if (state.message && state.errors) { // Only show error toast if there are actual validation errors or a server error message
      toast({
        variant: 'destructive',
        title: "Error",
        description: state.message,
      });
    }
  }, [state, toast]);

  return (
    <form ref={formRef} action={dispatch} className="space-y-4">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div className="space-y-2">
          <Label htmlFor="name">Name</Label>
          <Input id="name" name="name" placeholder="John Doe" required />
          {state.errors?.name && <p className="text-sm text-destructive">{state.errors.name[0]}</p>}
        </div>
        <div className="space-y-2">
          <Label htmlFor="email">Email</Label>
          <Input id="email" name="email" type="email" placeholder="john@example.com" required />
          {state.errors?.email && <p className="text-sm text-destructive">{state.errors.email[0]}</p>}
        </div>
      </div>
      <div className="space-y-2">
        <Label htmlFor="service">Service of Interest</Label>
        <Select name="service" defaultValue={serviceId}>
          <SelectTrigger id="service">
            <SelectValue placeholder="Select a service" />
          </SelectTrigger>
          <SelectContent>
            {services.map((service) => (
              <SelectItem key={service.id} value={service.id}>{service.name}</SelectItem>
            ))}
          </SelectContent>
        </Select>
        {state.errors?.service && <p className="text-sm text-destructive">{state.errors.service[0]}</p>}
      </div>
      <div className="space-y-2">
        <Label htmlFor="message">Project Description</Label>
        <Textarea id="message" name="message" placeholder="Tell us about your project..." className="min-h-[120px]" required />
        {state.errors?.message && <p className="text-sm text-destructive">{state.errors.message[0]}</p>}
      </div>
      <SubmitButton />
    </form>
  );
}
