import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { UserService } from '../../services/user.service';
import { HttpClientModule } from '@angular/common/http';
import { SharedService } from 'src/app/services/shared.service';

@Component({
  selector: 'app-statistics',
  templateUrl: './statistics.page.html',
  styleUrls: ['./statistics.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule]
})
export class StatisticsPage implements OnInit {

  selectedUser: any;

  user_id: string= '';

  training_count: any = [];
  total_trainings_completed_count: string = '';

  event_count: any = [];
  total_events_organized_count: string = '';

  volunteering_time: any = [];
  total_volunteering_time: string = '';

  likes_received: any = [];
  total_likes_received: string = '';

  posts_posted: any = [];
  total_posts_posted: string = '';

  comments_posted: any = [];
  total_comments_posted: string = '';

  branch_info: any = [];
  branch_name: string = '';
  branch_location: string = '';

  constructor(
    private service: UserService,
    private sharedService:SharedService
  ) {}

  ngOnInit() {
    this.selectedUser = this.sharedService.getSelectedUser();
    this.user_id = this.selectedUser['id'];
    if (!this.user_id) {
      // If user ID is not passed through URL, use logged-in user's ID
      this.user_id = localStorage.getItem('userId') as string;
    }

    this.service.getCompletedTrainingsCount(this.user_id).subscribe((response) => {
      this.training_count = response;
      this.total_trainings_completed_count = this.training_count['total_trainings'];
    });

    this.service.getEventsOrganizedCount(this.user_id).subscribe((response) => {
      this.event_count = response;
      this.total_events_organized_count = this.event_count['total_events'];
    });

    this.service.getVolunteeringTime(this.user_id).subscribe((response) => {
      this.volunteering_time = response;
      this.total_volunteering_time = this.volunteering_time['total_time'];
    });

    this.service.getTotalLikesReceived(this.user_id).subscribe((response) => {
      this.likes_received = response;
      this.total_likes_received = this.likes_received['total_likes_received'];
    });

    this.service.getPostsCount(this.user_id).subscribe((response) => {
      this.posts_posted = response;
      this.total_posts_posted = this.posts_posted['total_posts'];
    });

    this.service.getCommentsCount(this.user_id).subscribe((response) => {
      this.comments_posted = response;
      this.total_comments_posted = this.comments_posted['total_comments'];
    });

    this.service.getBranchInfo(this.user_id).subscribe((response) => {
      this.branch_info = response;
      this.branch_name = this.branch_info['branch_name'];
      this.branch_location = this.branch_info['branch_location'];
    });
  }
}





