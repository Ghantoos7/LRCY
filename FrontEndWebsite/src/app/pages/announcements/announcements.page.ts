import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { AlertController } from '@ionic/angular';

@Component({
  selector: 'app-announcements',
  templateUrl: './announcements.page.html',
  styleUrls: ['./announcements.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AnnouncementsPage implements OnInit {
  showDescriptions: boolean[] = [];

  constructor(private alertController: AlertController, private router:Router, private menuController: MenuController) { 
    this.showDescriptions = new Array(3).fill(false);
  }

  ngOnInit() {
  }

  async confirm() {
    const alert = await this.alertController.create({
      header: 'Delete Announcement',
      message: 'Are you sure you want to delete this announcement?',
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

  toggleDescription(index: number) {
    this.showDescriptions[index] = !this.showDescriptions[index];
  }

  goToSendAnnouncement(){
    this.router.navigate(['/send-announcement']);
  }

  goToEditAnnouncement(){
    this.router.navigate(['/edit-announcement']);
  }

  goToHome(){
    this.router.navigate(['/home']);
  }

  goToPanel(){
    this.router.navigate(['/panel']);
  }

  closeMenu() {
    this.menuController.close();
  }

}
