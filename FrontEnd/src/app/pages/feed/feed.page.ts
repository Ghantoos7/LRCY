import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AlertController } from '@ionic/angular';

@Component({
  selector: 'app-feed',
  templateUrl: './feed.page.html',
  styleUrls: ['./feed.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule],
  encapsulation: ViewEncapsulation.None
})

export class FeedPage implements OnInit {

  constructor(private router:Router, private alertController: AlertController) { }

  async showProfile() {
    const alert = await this.alertController.create({
      header: 'Profile',
      message: '<img src="assets/img/profile-picture.jpg" alt="Image description">',
      cssClass: 'my-custom-class',
      buttons: ['View Profile'],
    });
  
    await alert.present();
  }

  ngOnInit() {
  }

  goProfile(){
    this.router.navigate(['/profile']);
  }
    
  goFeed(){
    this.router.navigate(['/feed']);
  }
  
  goGoals(){
    this.router.navigate(['/yearly-goals']);
  }

  goGallery(){
    this.router.navigate(['/gallery']);
  }

  goAnnouncements(){
    this.router.navigate(['/announcements']);
  }

  toggleDarkMode(){

  }
  logout(){
  
  }
}
