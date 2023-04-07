import { Routes } from '@angular/router';
import { ProfilePage } from './profile.page';

export const routes: Routes = [
  {
    path: '',
    component: ProfilePage,
    children: [
        {
            path: 'Statistics',
            loadComponent: () =>
              import('../youth-gallery/youth-gallery.page').then((m) => m.YouthGalleryPage),
          },
      {
        path: 'Achievements',
        loadComponent: () =>
          import('../env-gallery/env-gallery.page').then((m) => m.EnvGalleryPage),
      },
      {
        path: 'Trainings',
        loadComponent: () =>
          import('../hvp-gallery/hvp-gallery.page').then((m) => m.HvpGalleryPage),
      },
      {
        path: 'My-Posts',
        loadComponent: () =>
          import('../other-gallery/other-gallery.page').then((m) => m.OtherGalleryPage),
      },
      {
        path: '',
        redirectTo: 'profile/Statistics',
        pathMatch: 'full',
      },
    ],
  },
  {
    path: '',
    redirectTo: 'profile/Statistics',
    pathMatch: 'full',
  },
];