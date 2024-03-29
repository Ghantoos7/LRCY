import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { EventService } from 'src/app/services/event.service';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-yearly-goals',
  templateUrl: './yearly-goals.page.html',
  styleUrls: ['./yearly-goals.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class YearlyGoalsPage implements OnInit {

  yearlyGoals: any;
  username = localStorage.getItem('username') as string;
  user_profile_pic = localStorage.getItem('user_profile_pic') as string;
  branch_id = localStorage.getItem('branch_id') as string;
  errorMessage: string = '';
  constructor(private router:Router, private menuCtrl: MenuController, private service:EventService, private userservice: UserService) { }

  ngOnInit() {
    this.service.getYearlyGoals(this.branch_id).subscribe({
      next: response => {
        const parsedResponse = JSON.parse(JSON.stringify(response));
        const allGoals = [].concat.apply([], Object.values(parsedResponse['goals']));
        this.yearlyGoals = allGoals;
  
        // Check if yearlyGoals array is empty
        if (this.yearlyGoals.length === 0) {
          this.errorMessage = 'No goals found';
        }
      },
      error: error => {
        console.error('An error occurred while fetching events:', error);
        this.errorMessage = 'No goals found';
      }
    });
  }
  


  
  getProgramIcon(program_id: number,): string {
    // Replace the conditions with the appropriate ones for your use case
    if (program_id == 1) {
      return 'heart-half-outline';
    } 
    else if (program_id === 2) {
      return 'male-female-outline';
    } 
    else if (program_id === 3) {
      return 'leaf-outline';
    } 
    else if (program_id === 4) {
      return 'calendar-number-outline';
    }
    else {
      return 'help-circle-outline'; // Default icon
    }
  }

  getEventIcon(event_id: number,): string {
    // Replace the conditions with the appropriate ones for your use case
    if (event_id == 1) {
      return 'calendar-number-outline';
    } else if (event_id === 2) {
      return 'barbell-outline';
    } else if (event_id === 3) {
      return 'ellipsis-horizontal-outline';
    } else {
      return 'help-circle-outline'; // Default icon
    }
  }


  handleRefresh(event:any) {
    setTimeout(() => {
      this.ngOnInit();
      event.target.complete();
    }, 1000);
  };

  

  isGoalComplete(goal_status : boolean): string {
    if (goal_status == true) {
      return 'checkmark-circle-outline';
    } 
    else {
      return 'close-circle-outline';
    }
  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuGoals');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuGoals');
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

 
}

