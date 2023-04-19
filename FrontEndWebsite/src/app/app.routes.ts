import { Routes } from '@angular/router';

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
  },  {
    path: 'panel',
    loadComponent: () => import('./pages/panel/panel.page').then( m => m.PanelPage)
  },
  {
    path: 'manage-profiles',
    loadComponent: () => import('./pages/manage-profiles/manage-profiles.page').then( m => m.ManageProfilesPage)
  },
  {
    path: 'add-member',
    loadComponent: () => import('./pages/add-member/add-member.page').then( m => m.AddMemberPage)
  },
  {
    path: 'member-profile',
    loadComponent: () => import('./pages/member-profile/member-profile.page').then( m => m.MemberProfilePage)
  },
  {
    path: 'manage-gallery',
    loadComponent: () => import('./pages/manage-gallery/manage-gallery.page').then( m => m.ManageGalleryPage)
  },
  {
    path: 'edit-gallery',
    loadComponent: () => import('./pages/edit-gallery/edit-gallery.page').then( m => m.EditGalleryPage)
  },


];
