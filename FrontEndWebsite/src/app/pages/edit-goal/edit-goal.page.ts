import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-edit-goal',
  templateUrl: './edit-goal.page.html',
  styleUrls: ['./edit-goal.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EditGoalPage implements OnInit {

  goal_id: string = '';

  constructor(private router:Router,private route: ActivatedRoute) { }

  ngOnInit() {
    this.goal_id = this.route.snapshot.paramMap.get('goalId') as string;
    console.log(this.goal_id)
    console.log(localStorage.getItem('authToken'));
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

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

}
