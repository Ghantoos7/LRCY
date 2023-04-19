import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule, AlertController } from '@ionic/angular';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.page.html',
  styleUrls: ['./sign-up.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SignUpPage implements OnInit {

  constructor(private authService: AuthService, private alertController: AlertController, private router: Router) { }

  organization_id='';

  ngOnInit() {

  }

  signUp(organization_id: string){
    this.authService.signUp(organization_id).subscribe((response) => {
      const parsedResponse = JSON.parse(JSON.stringify(response));
      const status = parsedResponse.status;
  
      if(status === 'Organization ID found, user already registered') {
        this.alertController.create({
          header: 'Error',
          message: status,
          buttons: ['OK']
        }).then((alert) => alert.present())
        .catch((err) => console.log(err));
      }
      else if(status === 'Organization ID found, user not registered') {
        this.router.navigateByUrl('/signup-details');
      }
      else {
        this.alertController.create({
          header: 'Error',
          message: status,
          buttons: ['OK']
        }).then((alert) => alert.present())
        .catch((err) => console.log(err));
      }
    });
  }
  
  

}
