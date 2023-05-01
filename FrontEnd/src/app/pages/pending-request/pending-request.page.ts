import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AlertController, IonicModule } from '@ionic/angular';
import { AuthService } from 'src/app/services/auth.service';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-pending-request',
  templateUrl: './pending-request.page.html',
  styleUrls: ['./pending-request.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class PendingRequestPage implements OnInit {

  constructor(private authService:AuthService, private alertController:AlertController, private router:Router, private navCtrl: NavController) { }

  ngOnInit() {
  }

  checkRequest() {
    const alert = this.alertController.create({
      header: 'Check Request',
      inputs: [
        {
          name: 'organization_id',
          type: 'number',
          placeholder: 'Organization ID'
        }
      ],
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel'
        },
        {
          text: 'OK',
          handler: (data) => {
            this.authService.checkRequestStatus(data.organization_id)
              .subscribe({
                next: (response: any) => {
                  const parsedResponse = JSON.parse(JSON.stringify(response));
                  if (parsedResponse.status === 'Request accepted') {
                    localStorage.removeItem('last_page');
                    this.router.navigate(['/new-password']);
                  } else {
                    this.alertController.create({
                      header: 'Error',
                      message: parsedResponse.status,
                      buttons: ['OK']
                    }).then(alert => alert.present());
                  }
                },
                error: (error) => {
                  console.log(error);
                }
              });
          }
        }
      ]
    }).then(alert => alert.present());
  }
  
  ionViewWillLeave() {
    this.navCtrl.setDirection('root');
    return false;
  }

  ionViewDidEnter() {
    localStorage.setItem('last_page', '/pending-request');
  }
  

}
