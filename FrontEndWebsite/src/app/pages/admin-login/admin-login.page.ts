import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AlertController, IonicModule } from '@ionic/angular';
import { AuthService } from 'src/app/services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-admin-login',
  templateUrl: './admin-login.page.html',
  styleUrls: ['./admin-login.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AdminLoginPage implements OnInit {

  organization_id: string='';
  password: string='';

  constructor(private authService:AuthService, private alertCtrl:AlertController, private router:Router) { }

  ngOnInit() {
  }

  adminLogin(organization_id: string, password: string) {
    this.authService.adminLogin(organization_id, password).subscribe({
      next: (data) => {
        const response = JSON.parse(JSON.stringify(data));
        if (response.status === 'Login successful') {
          // Store the token in local storage for future use
          localStorage.setItem('authToken', response.token);
          localStorage.setItem('adminId', response['user'].id);
          localStorage.setItem('username', response['user'].username);
          localStorage.setItem('userProfilePic', response['user'].user_profile_pic);
          localStorage.setItem('branchId', response['user'].branch_id);
          localStorage.setItem('fullName', response['user'].first_name+' '+response['user'].last_name);
          localStorage.setItem('permission', response['user'].user_type_id);
          // Redirect the user to the dashboard or any other page
          this.router.navigate(['/panel']);
          this.organization_id = '';
          this.password = '';
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
            case 'Permission denied':
              message = 'You do not have permission to access the admin panel.';
              break;
            case 'User not found':
              message = 'The organization ID or password you entered is incorrect.';
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

}
