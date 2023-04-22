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


  constructor(private router:Router, private service:UserService, private sharedService:SharedService) { }

  ngOnInit() {

    this.selectedUser = this.sharedService.getSelectedUser();
    this.user_id = this.selectedUser['id'];
    if (!this.user_id) {
      // If user ID is not passed through URL, use logged-in user's ID
      this.user_id = localStorage.getItem('userId') as string;
    }

    this.service.get_events_organized(this.user_id).subscribe(response => {
      this.events_organized = response;

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