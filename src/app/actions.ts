
'use server';

import { z } from 'zod';
import { recommendServices } from '@/ai/flows/ai-service-recommendation';

const inquirySchema = z.object({
  name: z.string().min(2, 'Name must be at least 2 characters.'),
  email: z.string().email('Please enter a valid email address.'),
  service: z.string().optional(),
  message: z.string().min(10, 'Message must be at least 10 characters.'),
});

export type InquiryState = {
  errors?: {
    name?: string[];
    email?: string[];
    service?: string[];
    message?: string[];
  };
  message?: string | null;
  success: boolean;
};

export async function submitInquiry(
  prevState: InquiryState,
  formData: FormData
): Promise<InquiryState> {
  const validatedFields = inquirySchema.safeParse({
    name: formData.get('name'),
    email: formData.get('email'),
    service: formData.get('service'),
    message: formData.get('message'),
  });

  if (!validatedFields.success) {
    return {
      errors: validatedFields.error.flatten().fieldErrors,
      message: 'Validation failed. Please check your input.',
      success: false,
    };
  }
  
  try {
    const response = await fetch('https://hooks.zapier.com/hooks/catch/25226128/usoq546/', {
        method: 'POST',
        body: JSON.stringify(validatedFields.data),
        headers: {
            'Content-Type': 'application/json'
        }
    });

    if (!response.ok) {
        throw new Error('Failed to submit inquiry to webhook.');
    }
    
    return { message: 'Thank you for your inquiry! We will get back to you shortly.', success: true, errors: {} };

  } catch (error) {
    return { message: 'An unexpected error occurred. Please try again later.', success: false };
  }
}

export async function getAiRecommendation(projectDescription: string) {
    if (!projectDescription || projectDescription.trim().length < 10) {
        return { error: 'Please provide a more detailed project description.' };
    }
    try {
        const result = await recommendServices({ projectDescription });
        return { recommendation: result.recommendedServices };
    } catch (e) {
        console.error(e);
        return { error: 'Failed to get AI recommendation. Please try again later.' };
    }
}
