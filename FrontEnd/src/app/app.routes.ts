import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: 'gallery',
    loadChildren: () => import('../app/pages/gallery/gallery.routes').then((m) => m.routes),
  },
  {
    path: 'event-details',
    loadChildren: () => import('../app/pages/event-details/event-details.routes').then((m) => m.routes),
  },
  {
    path: 'profile',
    loadChildren: () => import('../app/pages/profile/profile.routes').then((m) => m.routes)
  },
  
  {
    path: 'sign-in',
    loadComponent: () => import('../app/pages/sign-in/sign-in.page').then(m => m.SignInPage)
  },
  {
    path: 'yearly-goals',
    loadComponent: () => import('./pages/yearly-goals/yearly-goals.page').then( m => m.YearlyGoalsPage)
  },
  {
    path: 'announcements',
    loadComponent: () => import('./pages/announcements/announcements.page').then( m => m.AnnouncementsPage)
  },
  {
  
    path: 'sign-up',
    loadComponent: () => import('./pages/sign-up/sign-up.page').then( m => m.SignUpPage)
  },
  {
    path: 'signup-details',
    loadComponent: () => import('./pages/signup-details/signup-details.page').then( m => m.SignupDetailsPage)
  },

 
];

