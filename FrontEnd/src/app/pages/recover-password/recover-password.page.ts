import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule, AlertController } from '@ionic/angular';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-recover-password',
  templateUrl: './recover-password.page.html',
  styleUrls: ['./recover-password.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class RecoverPasswordPage implements OnInit {

  organization_id='';
  message: string = '';

  constructor(private authService:AuthService, private alertController: AlertController, private router:Router) { }

  

  ngOnInit() {
  }

  recoverRequest(organization_id: string){
    this.authService.recoverRequest(organization_id).subscribe({
      next:(data) => {
        const response = JSON.parse(JSON.stringify(data));
        this.message = response.status;
        if (response.status == 'Recovery request sent successfully!'){
          //navigate to pending-request page
          this.router.navigate(['/pending-request']);
        }
        const alert = this.alertController.create({
          header: 'Recovery Request',
          message: this.message,
          buttons: ['OK']
        }).then(alert => alert.present());
      },
      error:(error) => {
        console.log(error);
      }
    });
  }


}
