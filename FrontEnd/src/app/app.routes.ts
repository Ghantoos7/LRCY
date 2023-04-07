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
    path: 'statistics',
    loadComponent: () => import('./pages/statistics/statistics.page').then( m => m.StatisticsPage)
  },
  {
    path: 'achievements',
    loadComponent: () => import('./pages/achievements/achievements.page').then( m => m.AchievementsPage)
  },
  {
    path: 'trainings',
    loadComponent: () => import('./pages/trainings/trainings.page').then( m => m.TrainingsPage)
  },
  {
    path: 'my-posts',
    loadComponent: () => import('./pages/my-posts/my-posts.page').then( m => m.MyPostsPage)
  },
  {
    path: 'sign-up',
    loadComponent: () => import('./pages/sign-up/sign-up.page').then( m => m.SignUpPage)
  },
  {
    path: 'sign-in',
    loadComponent: () => import('./pages/sign-in/sign-in.page').then( m => m.SignInPage)
  },
 
];

