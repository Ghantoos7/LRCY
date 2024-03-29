import { Routes } from '@angular/router';
import { AuthGuard } from './guards/auth.guard';

export const routes: Routes = [
  {
    path: 'home',
    loadComponent: () => import('./pages/home/home.page').then((m) => m.HomePage),
  },
  {
    path: '',
    redirectTo: 'home',
    pathMatch: 'full',
  },
  {
    path: 'admin-login',
    loadComponent: () => import('./pages/admin-login/admin-login.page').then( m => m.AdminLoginPage)
  },
  {
    path: 'panel',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/panel/panel.page').then( m => m.PanelPage)
  },
  {
    path: 'manage-profiles',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/manage-profiles/manage-profiles.page').then( m => m.ManageProfilesPage)
  },
  {
    path: 'add-member',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/add-member/add-member.page').then( m => m.AddMemberPage)
  },
  {
    path: 'member-profile',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/member-profile/member-profile.page').then( m => m.MemberProfilePage)
  },
  {
    path: 'manage-gallery',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/manage-gallery/manage-gallery.page').then( m => m.ManageGalleryPage)
  },
  {
    path: 'edit-gallery',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/edit-gallery/edit-gallery.page').then( m => m.EditGalleryPage)
  },
  {
    path: 'requests',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/requests/requests.page').then( m => m.RequestsPage)
  },
  {
    path: 'add-gallery',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/add-gallery/add-gallery.page').then( m => m.AddGalleryPage)
  },
  {
    path: 'add-training',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/add-training/add-training.page').then( m => m.AddTrainingPage)
  },
  {
    path: 'delete-training',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/delete-training/delete-training.page').then( m => m.DeleteTrainingPage)
  },
  {
    path: 'yearly-goals',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/yearly-goals/yearly-goals.page').then( m => m.YearlyGoalsPage)
  },
  {
    path: 'add-goal',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/add-goal/add-goal.page').then( m => m.AddGoalPage)
  },
  {
    path: 'edit-goal',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/edit-goal/edit-goal.page').then( m => m.EditGoalPage)
  },
  {
    path: 'send-announcement',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/send-announcement/send-announcement.page').then( m => m.SendAnnouncementPage)
  },
  {
    path: 'announcements',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/announcements/announcements.page').then( m => m.AnnouncementsPage)
  },
  {
    path: 'edit-announcement',
    canActivate: [AuthGuard],
    loadComponent: () => import('./pages/edit-announcement/edit-announcement.page').then( m => m.EditAnnouncementPage)
  },


];
