'use server';
/**
 * @fileOverview An AI service recommendation flow.
 *
 * - recommendServices - A function that recommends services based on a project description.
 * - RecommendServicesInput - The input type for the recommendServices function.
 * - RecommendServicesOutput - The return type for the recommendServices function.
 */

import {ai} from '@/ai/genkit';
import {z} from 'genkit';

const RecommendServicesInputSchema = z.object({
  projectDescription: z.string().describe('A description of the user\'s project.'),
});
export type RecommendServicesInput = z.infer<typeof RecommendServicesInputSchema>;

const RecommendServicesOutputSchema = z.object({
  recommendedServices: z
    .string()
    .describe('A list of recommended services based on the project description.'),
});
export type RecommendServicesOutput = z.infer<typeof RecommendServicesOutputSchema>;

export async function recommendServices(input: RecommendServicesInput): Promise<RecommendServicesOutput> {
  return recommendServicesFlow(input);
}

const prompt = ai.definePrompt({
  name: 'recommendServicesPrompt',
  input: {schema: RecommendServicesInputSchema},
  output: {schema: RecommendServicesOutputSchema},
  prompt: `You are an AI assistant helping users find the best services for their projects.

  Based on the project description provided, recommend a list of services that would be most suitable.

  Project Description: {{{projectDescription}}}
  `,
});

const recommendServicesFlow = ai.defineFlow(
  {
    name: 'recommendServicesFlow',
    inputSchema: RecommendServicesInputSchema,
    outputSchema: RecommendServicesOutputSchema,
  },
  async input => {
    const {output} = await prompt(input);
    return output!;
  }
);
