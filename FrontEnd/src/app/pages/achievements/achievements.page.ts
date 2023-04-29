import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { UserService } from '../../services/user.service';
import { HttpClientModule } from '@angular/common/http';
import { SharedService } from 'src/app/services/shared.service';

@Component({
  selector: 'app-achievements',
  templateUrl: './achievements.page.html',
  styleUrls: ['./achievements.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule]
})

export class AchievementsPage implements OnInit {

  selectedUser: any;
  user_id: string= '';
  events_organized:any = [];
  errorMessage: string = '';

  constructor(private router:Router, private service:UserService, private sharedService:SharedService) { }

  ngOnInit() {

    this.selectedUser = this.sharedService.getSelectedUser();
    this.user_id = this.selectedUser['id'];
    if (!this.user_id) {
      // If user ID is not passed through URL, use logged-in user's ID
      this.user_id = localStorage.getItem('user_id') as string;
    }

    this.service.getEventsOrganized(this.user_id).subscribe({
      next: response => {
        if (response && response.hasOwnProperty('events')) {
          const parsedResponse = JSON.parse(JSON.stringify(response));
          const allEventsOrganized = [].concat.apply([], Object.values(parsedResponse['events']));
          this.events_organized = allEventsOrganized;

          if (this.events_organized.length === 0) {
            this.errorMessage = 'No achievements found';
          }
        } else {
          this.errorMessage = 'No achievements found';
        }
      },
      error: error => {
        console.error('An error occurred while fetching events organized:', error);
        this.errorMessage = 'No achievements found';
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
}