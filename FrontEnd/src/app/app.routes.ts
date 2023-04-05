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
 
];

