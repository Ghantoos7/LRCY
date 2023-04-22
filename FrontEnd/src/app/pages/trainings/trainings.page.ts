import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { UserService } from '../../services/user.service';
import { HttpClientModule } from '@angular/common/http';

@Component({
  selector: 'app-trainings',
  templateUrl: './trainings.page.html',
  styleUrls: ['./trainings.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule, HttpClientModule]
})

export class TrainingsPage implements OnInit {

  training_info: any = [];
  yah_count: string = '';
  hvp_count: string = '';
  env_count: string = '';
  other_count: string = '';
  left_count: string = '';
  taken_yah: any = [];
  not_taken_yah: any = [];
  taken_hvp: any = [];
  not_taken_hvp: any = [];
  taken_env: any = [];
  not_taken_env: any = [];
  taken_other: any = [];
  not_taken_other: any = [];
  user_id = localStorage.getItem('user_id') as string;

  constructor(private router:Router, private service:UserService) { }

  ngOnInit() {

    this.service.getTrainingsInfo(this.user_id).subscribe((response) => {
      this.training_info = response;
      this.yah_count = this.training_info['program_counts']["1"];
      this.hvp_count = this.training_info['program_counts']["2"];
      this.env_count = this.training_info['program_counts']["3"];
      this.other_count = this.training_info['program_counts']["4"];
      this.left_count = this.training_info['trainings not taken count'];
      this.taken_yah = this.training_info['trainings']['1'];
      this.taken_hvp = this.training_info['trainings']['2'];
      this.taken_env = this.training_info['trainings']['3'];
      this.taken_other = this.training_info['trainings']['4'];

      this.not_taken_yah = this.training_info['trainings_not_taken']['1'];
      this.not_taken_hvp = this.training_info['trainings_not_taken']['2'];
      this.not_taken_env = this.training_info['trainings_not_taken']['3'];
      this.not_taken_other = this.training_info['trainings_not_taken']['4'];
    });


  }

  


}
