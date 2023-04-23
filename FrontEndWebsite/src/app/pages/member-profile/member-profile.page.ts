import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AlertController } from '@ionic/angular';

@Component({
  selector: 'app-member-profile',
  templateUrl: './member-profile.page.html',
  styleUrls: ['./member-profile.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class MemberProfilePage implements OnInit {

  constructor(private router:Router, private menuCtrl: MenuController, private alertController: AlertController) { }

  ngOnInit() {
  }

  async confirm() {
    const alert = await this.alertController.create({
      header: 'Delete Profile',
      message: 'Are you sure you want to remove this member?',
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

  exitPage(){
    this.router.navigate(['/manage-profiles']);
  }

  goToAddTraining(){
    this.router.navigate(['/add-training'])
  }
  
  goToDeleteTraining(){
    this.router.navigate(['/delete-training']);
  }

  closeMenu() {
    this.menuCtrl.close();
  }

  goToManageProfiles(){
    this.router.navigate(['/manage-profiles']);
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

}
