import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { AlertController } from '@ionic/angular';


@Component({
  selector: 'app-requests',
  templateUrl: './requests.page.html',
  styleUrls: ['./requests.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class RequestsPage implements OnInit {

  constructor(private alertController: AlertController) { }

  ngOnInit() {
  }

  async confirm() {
    const alert = await this.alertController.create({
      header: 'Are you sure you want to proceed?',
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
  

}
