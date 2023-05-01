import { Routes } from '@angular/router';
import { ProfilePage } from './others-profile.page';

export const routes: Routes = [
  {
    path: '',
    component: ProfilePage,
    children: [
        {
            path: 'others-statistics',
            loadComponent: () =>
              import('../statistics/statistics.page').then((m) => m.StatisticsPage),
          },
      {
        path: 'others-achievements',
        loadComponent: () =>
          import('../achievements/achievements.page').then((m) => m.AchievementsPage),
      },
      {
        path: 'others-trainings',
        loadComponent: () =>
          import('../trainings/trainings.page').then((m) => m.TrainingsPage),
      },
      {
        path: 'others-posts',
        loadComponent: () =>
          import('../my-posts/my-posts.page').then((m) => m.MyPostsPage),
      },
      {
        path: '',
        redirectTo: 'others-statistics',
        pathMatch: 'full',
      },
    ],
  },
  {
    path: '',
    redirectTo: 'others-statistics',
    pathMatch: 'full',
  },
];