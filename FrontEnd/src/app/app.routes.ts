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
    path: 'signin',
    loadComponent: () => import('../app/pages/sign-in/sign-in.page').then(m => m.SignInPage)
  },
  
 
];

