
'use server';
/**
 * @fileOverview A text-to-video generation flow using Veo.
 *
 * - generateVideo - A function that generates a video based on a text prompt.
 * - GenerateVideoInput - The input type for the generateVideo function.
 * - GenerateVideoOutput - The return type for the generateVideo function.
 */

import { ai } from '@/ai/genkit';
import { googleAI } from '@genkit-ai/google-genai';
import { z } from 'genkit';
import { MediaPart } from 'genkit/media';

const GenerateVideoInputSchema = z.object({
  prompt: z.string().describe('The text prompt to generate the video from.'),
});
export type GenerateVideoInput = z.infer<typeof GenerateVideoInputSchema>;

const GenerateVideoOutputSchema = z.object({
  video: z.string().describe('The generated video as a base64 data URI.'),
});
export type GenerateVideoOutput = z.infer<typeof GenerateVideoOutputSchema>;

export async function generateVideo(input: GenerateVideoInput): Promise<GenerateVideoOutput> {
  return generateVideoFlow(input);
}

const generateVideoFlow = ai.defineFlow(
  {
    name: 'generateVideoFlow',
    inputSchema: GenerateVideoInputSchema,
    outputSchema: GenerateVideoOutputSchema,
  },
  async ({ prompt }) => {
    let { operation } = await ai.generate({
      model: googleAI.model('veo-2.0-generate-001'),
      prompt,
      config: {
        durationSeconds: 5,
        aspectRatio: '16:9',
      },
    });

    if (!operation) {
      throw new Error('Expected the model to return an operation');
    }

    // Poll for completion
    while (!operation.done) {
      // Wait for 5 seconds before checking the status again.
      await new Promise(resolve => setTimeout(resolve, 5000));
      operation = await ai.checkOperation(operation);
    }

    if (operation.error) {
      throw new Error(`Video generation failed: ${operation.error.message}`);
    }

    const videoPart = operation.output?.message?.content.find(p => !!p.media);
    if (!videoPart || !videoPart.media) {
      throw new Error('Failed to find the generated video in the operation result');
    }
    
    // The URL from Veo is temporary and needs to be fetched.
    // We add the API key to authenticate the download request.
    const apiKey = process.env.GEMINI_API_KEY;
    if (!apiKey) {
      throw new Error('GEMINI_API_KEY environment variable not set.');
    }
    const fetch = (await import('node-fetch')).default;
    const videoDownloadResponse = await fetch(
      `${videoPart.media.url}&key=${apiKey}`
    );
    
    if (!videoDownloadResponse.ok || !videoDownloadResponse.body) {
        throw new Error(`Failed to download video file. Status: ${videoDownloadResponse.status}`);
    }

    const videoBuffer = await videoDownloadResponse.buffer();
    const videoBase64 = videoBuffer.toString('base64');
    const contentType = videoPart.media.contentType || 'video/mp4';

    return {
      video: `data:${contentType};base64,${videoBase64}`,
    };
  }
);
