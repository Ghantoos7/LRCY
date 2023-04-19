import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { UserService } from '../../services/user.service';
import { HttpClientModule } from '@angular/common/http';

@Component({
  selector: 'app-statistics',
  templateUrl: './statistics.page.html',
  styleUrls: ['./statistics.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule]
})

export class StatisticsPage implements OnInit {


  training_count:any = [];
  total_trainings_completed_count:string = '';
  
  event_count:any = [];
  total_events_organized_count:string = '';

  volunteering_time:any = [];
  total_volunteering_time:string = '';

  likes_received:any = [];
  total_likes_received:string = '';
  
  posts_posted:any = [];
  total_posts_posted:string = '';

  comments_posted:any = [];
  total_comments_posted:string = '';

  branch_info:any = [];
  branch_name:string = '';
  branch_location:string = '';
  
  constructor(private router:Router, private service:UserService) { }

  ngOnInit() {

    this.service.get_completed_trainings_count('1').subscribe(response => {
      this.training_count = response;
      this.total_trainings_completed_count = this.training_count['total_trainings'];
    });


    this.service.get_events_organized_count('1').subscribe(response => {
      this.event_count = response;
      this.total_events_organized_count = this.event_count['total_events'];
    });


    this.service.get_volunteering_time('1').subscribe(response => {
      this.volunteering_time = response;
      this.total_volunteering_time = this.volunteering_time['total_time'];
    }); 


    this.service.get_total_likes_received('1').subscribe(response => {
      this.likes_received = response;
      this.total_likes_received = this.likes_received['total_likes_received'];
   });

   this.service.get_posts_count('1').subscribe(response => {
    this.posts_posted = response;
    this.total_posts_posted = this.posts_posted['total_posts'];
  });

    
  this.service.get_comments_count('1').subscribe(response => {
    this.comments_posted = response;
    this.total_comments_posted = this.comments_posted['total_comments'];

  });

  this.service.get_branch_info('1').subscribe(response => {
    this.branch_info = response;
    this.branch_name = this.branch_info['branch_name'];
    this.branch_location = this.branch_info['branch_location'];
  


  });
    
  }
}




