import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AlertController, IonicModule } from '@ionic/angular';
import { AuthService } from 'src/app/services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-new-password',
  templateUrl: './new-password.page.html',
  styleUrls: ['./new-password.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class NewPasswordPage implements OnInit {

  'organization_id': string = '';
  'password': string = '';
  'confirm_password': string = '';

  constructor(private authService:AuthService, private alertController:AlertController, private router:Router) { }

  ngOnInit() {
  }

  changePassword(organization_id: string, password: string, confirm_password: string) {
    this.authService.changePassword(organization_id, password, confirm_password).subscribe({
      next: (response) => {
        const parsedResponse = JSON.parse(JSON.stringify(response));
        const status = parsedResponse.status;
  
        switch (status) {
          case 'error':
            this.alertController.create({
              header: 'Error',
              message: parsedResponse.message,
              buttons: ['OK']
            }).then((alert) => alert.present())
              .catch((err) => console.log(err));
            break;
          case 'success':
            this.alertController.create({
              header: 'Success',
              message: parsedResponse.message,
              buttons: ['OK']
            }).then((alert) => alert.present())
              .catch((err) => console.log(err));
            this.router.navigate(['/sign-in']);
            break;
          default:
            this.alertController.create({
              header: 'Error',
              message: 'An unknown error occurred. Please try again later.',
              buttons: ['OK']
            }).then((alert) => alert.present())
              .catch((err) => console.log(err));
            break;
        }
      },
      error: (error) => {
        console.log(error);
        this.alertController.create({
          header: 'Error',
          message: 'An error occurred. Please try again later.',
          buttons: ['OK']
        }).then((alert) => alert.present())
          .catch((err) => console.log(err));
      }
    });
  }
  


}
