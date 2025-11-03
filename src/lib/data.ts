import { BarChart3, Film, Presentation } from 'lucide-react';
import type { Service, ServiceCategory } from './types';

export const serviceCategories: ServiceCategory[] = [
  {
    id: 'data',
    name: 'Data Services',
    description: 'Transforming raw data into actionable insights and compelling visualizations.',
    icon: BarChart3,
  },
  {
    id: 'video-editing',
    name: 'Video Editing',
    description: 'Crafting engaging video content from your raw footage for any platform.',
    icon: Film,
  },
  {
    id: 'presentations',
    name: 'Presentations',
    description: 'Designing professional and impactful presentations that captivate your audience.',
    icon: Presentation,
  },
];

export const services: Service[] = [
  {
    id: 'data-analysis',
    slug: 'data-analysis',
    name: 'Data Analysis & Reporting',
    category: 'data',
    shortDescription: 'In-depth analysis of your data to uncover trends and create detailed reports.',
    longDescription: 'Our data analysis service dives deep into your datasets to identify key trends, patterns, and insights. We provide comprehensive reports with clear visualizations to help you make data-driven decisions. This service is ideal for businesses looking to understand customer behavior, optimize operations, or track performance.',
    examples: [
      { id: 'ex1', title: 'Quarterly Sales Dashboard', description: 'A BI dashboard showing sales performance.', imageId: '1' },
      { id: 'ex2', title: 'Customer Segmentation Analysis', description: 'Analysis report on customer demographics.', imageId: '2' },
    ],
  },
  {
    id: 'custom-dashboards',
    slug: 'custom-dashboards',
    name: 'Custom Dashboard Creation',
    category: 'data',
    shortDescription: 'Interactive dashboards tailored to your specific business needs and KPIs.',
    longDescription: 'We build custom, interactive dashboards using tools like Tableau or Power BI. These dashboards provide a real-time view of your key performance indicators (KPIs), allowing you to monitor your business at a glance. Each dashboard is designed to be intuitive and tailored to your unique requirements.',
    examples: [
        { id: 'ex3', title: 'Real-time Analytics Dashboard', description: 'A web-based dashboard for live metrics.', imageId: '3' },
        { id: 'ex4', title: 'Marketing Campaign Tracker', description: 'Dashboard tracking marketing ROI.', imageId: '4' },
    ],
  },
  {
    id: 'promo-video',
    slug: 'promo-video',
    name: 'Promotional Video Production',
    category: 'video-editing',
    shortDescription: 'Engaging promotional videos to showcase your product or service.',
    longDescription: 'From short social media clips to full-fledged promotional videos, we edit your raw footage into a polished and compelling story. Our service includes color correction, sound design, motion graphics, and titling to make your brand stand out.',
    examples: [
        { id: 'ex5', title: 'Product Launch Video', description: 'A high-energy promo video for a new product.', imageId: '5' },
        { id: 'ex6', title: 'Brand Story Video', description: 'An emotional video telling the story of a brand.', imageId: '6' },
    ],
  },
  {
    id: 'corporate-video',
    slug: 'corporate-video',
    name: 'Corporate & Event Videos',
    category: 'video-editing',
    shortDescription: 'Professional editing for corporate communications and event highlights.',
    longDescription: 'We provide professional video editing for corporate needs, including training videos, internal communications, and event highlight reels. We ensure a consistent brand message and a high-quality final product that meets your corporate standards.',
    examples: [
        { id: 'ex7', title: 'Annual Conference Highlights', description: 'A fast-paced reel of a corporate event.', imageId: '7' },
        { id: 'ex8', title: 'Employee Training Module', description: 'An informative and engaging training video.', imageId: '8' },
    ],
  },
  {
    id: 'pitch-decks',
    slug: 'pitch-decks',
    name: 'Pitch Deck Design',
    category: 'presentations',
    shortDescription: 'Visually stunning pitch decks that help you secure funding and partnerships.',
    longDescription: 'A great idea needs a great presentation. We design persuasive and visually appealing pitch decks that clearly communicate your vision. Our designs focus on storytelling, data visualization, and brand consistency to leave a lasting impression on investors.',
    examples: [
        { id: 'ex9', title: 'Startup Pitch Deck', description: 'A modern and clean deck for a tech startup.', imageId: '9' },
        { id: 'ex10', title: 'Investor Update Presentation', description: 'A data-rich presentation for stakeholders.', imageId: '10' },
    ],
  },
  {
    id: 'keynote-design',
    slug: 'keynote-design',
    name: 'Keynote & Conference Slides',
    category: 'presentations',
    shortDescription: 'Dynamic and professional slides for your next big talk.',
    longDescription: 'Elevate your public speaking with professionally designed keynote or conference slides. We create dynamic, engaging, and easy-to-read slides that complement your speech and keep your audience focused. We can work with PowerPoint, Keynote, or Google Slides.',
    examples: [
        { id: 'ex11', title: 'Tech Conference Keynote', description: 'Bold and visual slides for a large audience.', imageId: '11' },
        { id: 'ex12', title: 'Webinar Slide Deck', description: 'Informative slides for an online presentation.', imageId: '12' },
    ],
  },
];
