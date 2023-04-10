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

  ionViewDidEnter() {
    setTimeout(() => {
      this.router.navigateByUrl('/signin');
    }, 3000); 
  }
}
