import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: '',
    loadChildren: () => import('../app/pages/gallery/gallery.routes').then((m) => m.routes),
  },
  {
    path: 'youth-gallery',
    loadComponent: () => import('./pages/youth-gallery/youth-gallery.page').then( m => m.YouthGalleryPage)
  },
];

