import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import {Route, Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { SharedService } from 'src/app/services/shared.service';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-profile',
  templateUrl: './others-profile.page.html',
  styleUrls: ['./others-profile.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})

export class ProfilePage implements OnInit {
  selectedUser: any;

  username = localStorage.getItem('username') as string;
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;

  constructor(private router:Router, private menuCtrl: MenuController, private sharedService:SharedService, private service: UserService) { }

  ngOnInit() {
    this.selectedUser = this.sharedService.getSelectedUser();
    
  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuOtherProf');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuOtherProf');
  }

  goToEditForm(){
this.router.navigate(['edit-profile']);
  }

  goProfile(){
    this.router.navigate(['/profile']);
      }
    
      goFeed(){
        this.router.navigate(['/feed']);
      }
      
      goGoals(){
        this.router.navigate(['/yearly-goals']);
      }
    
      goGallery(){
        this.router.navigate(['/gallery']);
      }
    
      goAnnouncements(){
        this.router.navigate(['/announcements']);
      }
    
      toggleDarkMode(){
    
      }
      logout() {
        this.service.logout().subscribe((data: any) => {
          localStorage.removeItem('authToken');
localStorage.removeItem('userId');
localStorage.removeItem('username');
localStorage.removeItem('user_profile_pic');
localStorage.removeItem('branch_id');
localStorage.removeItem('rememberMe');
localStorage.removeItem('full_name');
          this.router.navigate(['/sign-in']);
        });
      }

}
