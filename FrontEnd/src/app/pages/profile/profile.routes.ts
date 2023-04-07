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
              import('../statistics/statistics.page').then((m) => m.StatisticsPage),
          },
      {
        path: 'Achievements',
        loadComponent: () =>
          import('../achievements/achievements.page').then((m) => m.AchievementsPage),
      },
      {
        path: 'Trainings',
        loadComponent: () =>
          import('../trainings/trainings.page').then((m) => m.TrainingsPage),
      },
      {
        path: 'My-Posts',
        loadComponent: () =>
          import('../my-posts/my-posts.page').then((m) => m.MyPostsPage),
      },
      {
        path: '',
        redirectTo: 'Statistics',
        pathMatch: 'full',
      },
    ],
  },
  {
    path: '',
    redirectTo: 'Statistics',
    pathMatch: 'full',
  },
];