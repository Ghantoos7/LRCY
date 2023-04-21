import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { AuthService } from '../../services/auth.service';
import { AlertController } from '@ionic/angular';
import { profile } from 'console';

@Component({
  selector: 'app-sign-in',
  templateUrl: './sign-in.page.html',
  styleUrls: ['./sign-in.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SignInPage implements OnInit {
  private alertCtrl: AlertController; // Declare alertCtrl as a private property of the class

  organization_id='';
  password='';
  message: string = '';
  rememberMe: boolean = false; // New variable to keep track of remember me checkbox

  constructor(private router:Router,private authService:AuthService, alertCtrl: AlertController) {
    this.alertCtrl = alertCtrl; // Assign the alertCtrl property to the alertCtrl parameter
   }

  ngOnInit() {
  }

  login(organization_id: string, password: string) {
    this.authService.login(organization_id, password,this.rememberMe).subscribe({
      next: (data) => {
        console.log(data);
        const response = JSON.parse(JSON.stringify(data));
        if (response.status === 'Login successful') {
          // Store the token in local storage for future use
          localStorage.setItem('authToken', response.token);
          localStorage.setItem('userId', response.user_id);
          localStorage.setItem('username', response.username);
          localStorage.setItem('user_profile_pic', response.user_porfile_pic);
          localStorage.setItem('rememberMe', this.rememberMe.toString());
          // Redirect the user to the dashboard or any other page
          this.router.navigate(['/feed']);
        } else {
          // Display an error message to the user
          let message: string;
          switch (response.status) {
            case 'Invalid credentials':
              message = 'The organization ID or password you entered is incorrect.';
              break;
            case 'Too many failed login attempts':
              message = 'Your account has been temporarily locked due to too many failed login attempts. Please try again later or reset your password.';
              break;
            default:
              message = 'An unknown error occurred. Please try again later.';
          }
          this.alertCtrl.create({
            message: message,
            buttons: ['OK']
          }).then(alert => alert.present());
        }
      },
      error: (error) => {
        console.log(error);
        this.alertCtrl.create({
          message: 'An error occurred. Please try again later.',
          buttons: ['OK']
        }).then(alert => alert.present());
      }
    });
  }
  
  
  

  goToSignUp(){
    this.router.navigate(['/sign-up']);
  }

  goToRequest(){
    this.router.navigate(['/recover-password']);
  }

}
