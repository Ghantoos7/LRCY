import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { EventService } from '../../services/event.service';
import { SharedService } from '../../services/shared.service';
import { UserService } from 'src/app/services/user.service';


@Component({
  selector: 'app-other-gallery',
  templateUrl: './other-gallery.page.html',
  styleUrls: ['./other-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class OtherGalleryPage implements OnInit {

  username = localStorage.getItem('username') as string;
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  other_events: any = [];
  events: any = [];
  showActivities: boolean = true;
  showTrainings: boolean = true;
  showOthersEvents: boolean = true;
  branch_id = localStorage.getItem('branchId') as string;

  constructor(private sharedService: SharedService, private event_service:EventService, private router:Router, private menuCtrl: MenuController, private userservice: UserService) { }

  ngOnInit() {
    this.event_service.getEvents(this.branch_id).subscribe(response => {
      this.events = response;
      this.other_events = Array.from(this.events['events']['Others']);
     
    });

  }

  seeDetails(event_id: string) {
    this.sharedService.setVariableValue(event_id);
      this.router.navigate(['/event-details']);
    }
      

  reset(){
    this.showActivities= true;
  this.showTrainings = true;
  this.showOthersEvents = true;
  }

  showActivity() {
    this.showActivities = true;
    this.showTrainings = false;
    this.showOthersEvents = false;
  }
  
  showTraining() {
    this.showActivities = false;
    this.showTrainings = true;
    this.showOthersEvents = false;
  }
  
  showOthers() {
    this.showActivities = false;
    this.showTrainings = false;
    this.showOthersEvents = true;
  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuOtherGall');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuOtherGall');
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
