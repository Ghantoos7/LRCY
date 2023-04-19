import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.page.html',
  styleUrls: ['./sign-up.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SignUpPage implements OnInit {

  constructor(private authService: AuthService) { }

  organization_id='';

  ngOnInit() {

  }

  signUp(organization_id: string){
    this.authService.signUp(organization_id).subscribe({
      next:(data) => {
        console.log(data);
      },
      error:(error) => {
        console.log(error);
      }
    });
  }

}
