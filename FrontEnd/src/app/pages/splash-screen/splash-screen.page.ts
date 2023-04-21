import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';

@Component({
  selector: 'app-splash-screen',
  templateUrl: './splash-screen.page.html',
  styleUrls: ['./splash-screen.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class SplashScreenPage implements OnInit {

  constructor(private router:Router) { }

  ngOnInit() {
  }

  ionViewWillEnter() {
    // Check if "Remember Me" is selected
    const rememberMe = localStorage.getItem('rememberMe');
    if (rememberMe && rememberMe === 'true') {
      // Skip the login page and navigate to the feed page
      setTimeout(() => {
        this.router.navigate(['/feed']);
      }, 3000);
    } else {
      // Navigate to the login page after 3 seconds
      setTimeout(() => {
        this.router.navigate(['/sign-in']);
      }, 3000);
    }
  }

  ionViewDidEnter() {
    setTimeout(() => {
      // Do nothing in this hook
    }, 3000); 
  }

}
