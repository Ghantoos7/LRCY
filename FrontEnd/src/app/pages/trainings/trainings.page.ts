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

  constructor(private router:Router, private service:UserService) { }

  ngOnInit() {

    this.service.get_trainings_info("1").subscribe((response) => {
      this.training_info = response;
      this.yah_count = this.training_info['program_counts']["1"];
      this.hvp_count = this.training_info['program_counts']["2"];
      this.env_count = this.training_info['program_counts']["3"];
      this.other_count = this.training_info['program_counts']["4"];
      this.left_count = this.training_info['trainings not taken count'];

    });


  }

  


}
