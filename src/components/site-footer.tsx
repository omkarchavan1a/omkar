import Link from 'next/link';

export function SiteFooter() {
  return (
    <footer className="bg-card border-t">
      <div className="container mx-auto flex flex-col items-center justify-between gap-4 px-4 py-8 md:flex-row md:px-6">
        <p className="text-sm text-muted-foreground">
          © {new Date().getFullYear()} microGT Services. All rights reserved.
        </p>
        <nav className="flex gap-4 sm:gap-6">
          <Link href="/contact" className="text-sm hover:underline underline-offset-4">
            Contact
          </Link>
          <Link href="#" className="text-sm hover:underline underline-offset-4">
            Privacy Policy
          </Link>
          <Link href="#" className="text-sm hover:underline underline-offset-4">
            Terms of Service
          </Link>
        </nav>
      </div>
    </footer>
  );
}
