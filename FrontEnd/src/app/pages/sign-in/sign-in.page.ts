import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-sign-in',
  templateUrl: './sign-in.page.html',
  styleUrls: ['./sign-in.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SignInPage implements OnInit {

  organization_id='';
  password='';

  constructor(private router:Router,private authService:AuthService) { }

  ngOnInit() {
  }

  login(organization_id: string, password: string){
    this.authService.login(organization_id, password).subscribe({
      next:(data) => {
        console.log(data);
      },
      error:(error) => {
        console.log(error);
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
