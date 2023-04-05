import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: 'gallery',
    loadComponent: () => import('./pages/gallery.page').then((m) => m.HomePage),
  },
  {
    path: '',
    redirectTo: 'home',
    pathMatch: 'full',
  },
];
