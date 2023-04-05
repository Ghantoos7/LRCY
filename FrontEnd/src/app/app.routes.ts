import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: 'gallery',
    loadChildren: () => import('../app/pages/gallery/gallery.routes').then((m) => m.routes),
  },
 
];

