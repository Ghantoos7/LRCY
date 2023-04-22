import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { AlertController } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-yearly-goals',
  templateUrl: './yearly-goals.page.html',
  styleUrls: ['./yearly-goals.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class YearlyGoalsPage implements OnInit {

  constructor(private alertController: AlertController, private router:Router, private menuController: MenuController) { }

  ngOnInit() {
  }

  async confirm() {
    const alert = await this.alertController.create({
      header: 'Delete Goal',
      message: 'Are you sure you want to delete this goal?',
      cssClass: 'my-custom-class',
      buttons: [
        {
          text: 'Yes',
        },
        {
          text: 'Cancel',
          role: 'cancel',
        }
      ]
    });
    await alert.present();
  }

  goToAddGoal(){
    this.router.navigate(['/add-goal']);
  }

  goToEditGoal(){
    this.router.navigate(['/edit-goal']);
  }

  closeMenu() {
    this.menuController.close();
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/home']);
  }

}
