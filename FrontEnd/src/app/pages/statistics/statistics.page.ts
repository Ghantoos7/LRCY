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


    }
    
  }




