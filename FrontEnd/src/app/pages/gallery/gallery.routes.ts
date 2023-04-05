import { Routes } from '@angular/router';
import { HomePage } from '../gallery/gallery.page';

export const routes: Routes = [
  {
    path: 'gallery',
    component: HomePage,
    children: [
        {
            path: 'youth-gallery',
            loadComponent: () =>
              import('../youth-gallery/youth-gallery.page').then((m) => m.YouthGalleryPage),
          },
      {
        path: 'env-gallery',
        loadComponent: () =>
          import('../env-gallery/env-gallery.page').then((m) => m.EnvGalleryPage),
      },
      {
        path: 'hvp-gallery',
        loadComponent: () =>
          import('../hvp-gallery/hvp-gallery.page').then((m) => m.HvpGalleryPage),
      },
      {
        path: 'other-gallery',
        loadComponent: () =>
          import('../other-gallery/other-gallery.page').then((m) => m.OtherGalleryPage),
      },
      {
        path: '',
        redirectTo: 'gallery/youth-gallery',
        pathMatch: 'full',
      },
    ],
  },
  {
    path: '',
    redirectTo: 'gallery/youth-gallery',
    pathMatch: 'full',
  },
];
