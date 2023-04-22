import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-add-goal',
  templateUrl: './add-goal.page.html',
  styleUrls: ['./add-goal.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AddGoalPage implements OnInit {

  constructor(private router:Router, private menuController: MenuController) { }

  ngOnInit() {
  }

  pinFormatter(value: number) {
    return `${value}%`;
  }

  goToGoals(){
    this.router.navigate(['/yearly-goals']);
  }

  closeMenu() {
    this.menuController.close();
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

}
