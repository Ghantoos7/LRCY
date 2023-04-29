import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { EventService } from 'src/app/services/event.service';
import { UserService } from 'src/app/services/user.service';


@Component({
  selector: 'app-announcements',
  templateUrl: './announcements.page.html',
  styleUrls: ['./announcements.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AnnouncementsPage implements OnInit {
  showDescriptions: boolean[] = [];
  announcements: any = [];
  i: number = 0;
  username = localStorage.getItem('username') as string;
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  branch_id = localStorage.getItem('branch_id') as string;
  announcer_profile_pic: string ="";
  errorMessage: string = '';
  constructor(private router:Router, private menuCtrl: MenuController, private service:EventService, private userservice:UserService) { 
    this.showDescriptions = new Array(this.announcements.length).fill(false);
  }

  ngOnInit() {
    this.service.getAnnouncements(this.branch_id).subscribe({
      next: response => {
        if (response && response.hasOwnProperty('announcements')) {
          const parsedResponse = JSON.parse(JSON.stringify(response));
          const allAnnouncements = [].concat.apply([], Object.values(parsedResponse['announcements']));
          this.announcements = allAnnouncements;
  
          if (this.announcements.length === 0) {
            this.errorMessage = 'No announcements found';
          }
        } else {
          this.errorMessage = 'No announcements found';
        }
      },
      error: error => {
        console.error('An error occurred while fetching events:', error);
        this.errorMessage = 'No announcements found';
      }
    });
  }
  

  public getAnnouncerProfilePic(index: number) {
    let currentAnnouncement = this.announcements[index];
    if (currentAnnouncement.announcer_profile_picture == null) {
      return "https://ionicframework.com/docs/img/demos/avatar.svg";
    } else {
      return currentAnnouncement.announcer_profile_picture;
    }
  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuAnnouncements');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuAnnouncements');
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
        this.userservice.logout().subscribe((data: any) => {
          localStorage.removeItem('auth_token');
          localStorage.removeItem('user_id');
          localStorage.removeItem('username');
          localStorage.removeItem('user_profile_pic');
          localStorage.removeItem('branch_id');
          localStorage.removeItem('remember_me');
          localStorage.removeItem('full_name');
          this.router.navigate(['/sign-in']);
        });
      }
    

  
  toggleDescription(index: number) {
      this.showDescriptions[index] = !this.showDescriptions[index];
  }
      
}
