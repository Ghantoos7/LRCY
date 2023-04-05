import { Routes } from '@angular/router';
import { EventDetailsPage } from './event-details.page';

export const routes: Routes = [
  {
    path: 'event-details',
    component: EventDetailsPage,
    children: [
        {
            path: 'information',
            loadComponent: () =>
              import('../event-information/event-information.page').then((m) => m.EventInformationPage),
          },
      {
        path: 'pictures',
        loadComponent: () =>
          import('../event-pictures/event-pictures.page').then((m) => m.EventPicturesPage),
      },
    ],
  },
  {
    path: '',
    redirectTo: 'event-details/information',
    pathMatch: 'full',
  },
];
