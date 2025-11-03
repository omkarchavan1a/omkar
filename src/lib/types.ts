import type { LucideIcon } from 'lucide-react';

export type ServiceCategory = {
  id: string;
  name: string;
  description: string;
  icon: LucideIcon;
};

export type Service = {
  id: string;
  slug: string;
  name: string;
  category: string;
  shortDescription: string;
  longDescription: string;
  examples: {
    id: string;
    title: string;
    description: string;
    imageId: string;
  }[];
};
