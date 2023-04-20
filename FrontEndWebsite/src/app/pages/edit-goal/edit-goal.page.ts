import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';

@Component({
  selector: 'app-edit-goal',
  templateUrl: './edit-goal.page.html',
  styleUrls: ['./edit-goal.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditGoalPage implements OnInit {

  constructor(private router:Router) { }

  ngOnInit() {
  }

  pinFormatter(value: number) {
    return `${value}%`;
  }

  goToGoals(){
    this.router.navigate(['/yearly-goals']);
  }

  goToAddGoal(){
    this.router.navigate(['/add-goal']);

  }

}
