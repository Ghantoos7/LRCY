import { Routes } from '@angular/router';

export const routes: Routes = [
  {
    path: '',
    loadComponent: () => import('../app/pages/splash-screen/splash-screen.page').then(m => m.SplashScreenPage)
  },
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
    path: 'others-profile',
    loadChildren: () => import('./pages/others-profile/others-profile.routes').then((m) => m.routes)
  },
  
  {
    path: 'sign-in',
    loadComponent: () => import('../app/pages/sign-in/sign-in.page').then(m => m.SignInPage)
  },
  {
    path: 'yearly-goals',
    loadComponent: () => import('./pages/yearly-goals/yearly-goals.page').then( m => m.YearlyGoalsPage)
  },
  {
    path: 'announcements',
    loadComponent: () => import('./pages/announcements/announcements.page').then( m => m.AnnouncementsPage)
  },
  {
    path: 'sign-up',
    loadComponent: () => import('./pages/sign-up/sign-up.page').then( m => m.SignUpPage)
  },
  {
    path: 'splashScreen',
    loadComponent: () => import('./pages/splash-screen/splash-screen.page').then( m => m.SplashScreenPage)
  },
  {
    path: 'signup-details',
    loadComponent: () => import('./pages/signup-details/signup-details.page').then( m => m.SignupDetailsPage)
  },
  {
    path: 'recover-password',
    loadComponent: () => import('./pages/recover-password/recover-password.page').then( m => m.RecoverPasswordPage)
  },
  {
    path: 'new-password',
    loadComponent: () => import('./pages/new-password/new-password.page').then( m => m.NewPasswordPage)
  },
  {
    path: 'pending-request',
    loadComponent: () => import('./pages/pending-request/pending-request.page').then( m => m.PendingRequestPage)
  },
  {
    path: 'request-declined',
    loadComponent: () => import('./pages/request-declined/request-declined.page').then( m => m.RequestDeclinedPage)
  },
  {
    path: 'feed',
    loadComponent: () => import('./pages/feed/feed.page').then( m => m.FeedPage)
  },
  {
    path: 'comments',
    loadComponent: () => import('./pages/comments/comments.page').then( m => m.CommentsPage)
  },
  {
    path: 'edit-profile',
    loadComponent: () => import('./pages/edit-profile/edit-profile.page').then( m => m.EditProfilePage)
  },  {
    path: 'post',
    loadComponent: () => import('./pages/post/post.page').then( m => m.PostPage)
  },
  {
    path: 'edit-post',
    loadComponent: () => import('./pages/edit-post/edit-post.page').then( m => m.EditPostPage)
  },



];

