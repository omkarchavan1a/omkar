'use client';

import { useState } from 'react';
import { Textarea } from '@/components/ui/textarea';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Lightbulb, Loader2, AlertCircle } from 'lucide-react';
import { getAiRecommendation } from '@/app/actions';

export default function AiMatcher() {
  const [isLoading, setIsLoading] = useState(false);
  const [recommendation, setRecommendation] = useState<string | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [description, setDescription] = useState('');

  const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    setIsLoading(true);
    setError(null);
    setRecommendation(null);

    const result = await getAiRecommendation(description);

    if (result.error) {
      setError(result.error);
    } else if (result.recommendation) {
      setRecommendation(result.recommendation);
    }
    
    setIsLoading(false);
  };

  return (
    <Card>
      <CardContent className="pt-6">
        <form onSubmit={handleSubmit} className="space-y-4">
          <Textarea
            placeholder="e.g., 'I need a 2-minute promotional video for my new mobile app to post on social media.'"
            className="min-h-[100px]"
            value={description}
            onChange={(e) => setDescription(e.target.value)}
            required
            aria-label="Project Description"
          />
          <Button type="submit" disabled={isLoading} className="w-full">
            {isLoading ? <Loader2 className="mr-2 h-4 w-4 animate-spin" /> : null}
            Get Recommendations
          </Button>
        </form>
        
        {error && (
          <Alert variant="destructive" className="mt-4">
            <AlertCircle className="h-4 w-4" />
            <AlertTitle>Error</AlertTitle>
            <AlertDescription>{error}</AlertDescription>
          </Alert>
        )}
        
        {recommendation && (
          <Alert className="mt-4 border-primary/50">
            <Lightbulb className="h-4 w-4 text-primary" />
            <AlertTitle className="text-primary">Our Recommendation</AlertTitle>
            <AlertDescription>
              <p className="whitespace-pre-wrap">{recommendation}</p>
            </AlertDescription>
          </Alert>
        )}
      </CardContent>
    </Card>
  );
}
