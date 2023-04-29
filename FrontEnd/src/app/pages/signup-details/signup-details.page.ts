import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule, AlertController } from '@ionic/angular';
import { IonContent } from '@ionic/angular';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-signup-details',
  templateUrl: './signup-details.page.html',
  styleUrls: ['./signup-details.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SignupDetailsPage implements OnInit {
  isInputFocused: boolean = false;

  organization_id: string = '';
  username: string = '';
  password: string = '';
  confirm_password: string = '';
  alertController: AlertController;
  match: boolean = false;

  constructor(private router:Router,private authService:AuthService, alertController: AlertController) { 
    this.alertController = alertController;
  }

  ngOnInit() {
  }

  register(username: string, password: string, confirm_password: string) {
    this.authService.register(username, password, confirm_password).subscribe(
        (response) => {
            const parsedResponse = JSON.parse(JSON.stringify(response));
            const status = parsedResponse.status;

            switch (status) {
                case 'Invalid input':
                    const errorList = [];
                    for (let [key, value] of Object.entries(parsedResponse.errors)) {
                        errorList.push(key + ': ' + value);
                    }
                    const errorMessage = errorList.join('\n');
                    this.alertController.create({
                        header: 'Error',
                        message: errorMessage,
                        buttons: ['OK']
                    }).then((alert) => alert.present())
                    .catch((err) => console.log(err));
                    break;
                case 'Invalid password':
                    this.alertController.create({
                        header: 'Error',
                        message: 'Invalid password: ' + parsedResponse.errors,
                        buttons: ['OK']
                    }).then((alert) => alert.present())
                    .catch((err) => console.log(err));
                    break;
                case 'Organization ID found, user registered successfully':
                    // Store the token in local storage for future use
                    localStorage.setItem('auth_token', parsedResponse.token);
                    // Redirect the user to the dashboard or any other page
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
        (error) => {
            console.log(error);
        }
    );
}


  onInputFocus() {
    this.isInputFocused = true;
  }

  onInputBlur() {
    this.isInputFocused = false;
  }
}
