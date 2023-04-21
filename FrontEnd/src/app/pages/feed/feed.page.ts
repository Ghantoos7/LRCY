import { Component, OnInit, ViewEncapsulation } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AlertController } from '@ionic/angular';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-feed',
  templateUrl: './feed.page.html',
  styleUrls: ['./feed.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule],
  encapsulation: ViewEncapsulation.None
})

export class FeedPage implements OnInit {

  username: string = localStorage.getItem('username') as string;
  user_profile_pic: string = localStorage.getItem('user_profile_pic') as string;

  constructor(private router:Router, private alertController: AlertController, private menuCtrl: MenuController) { 
  }


  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuFeed');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuFeed');
  }

  async showProfile() {
    const alert = await this.alertController.create({
      header: 'Nay Abi Saad | General Assembly',
      message: 'This is my bio',
      cssClass: 'my-custom-class',
      buttons: [{
        text: 'View Profile',
        cssClass: 'custom-alert-button',
        handler: () => {
          this.router.navigate(['/others-profile']); 
        }
      }]
    });
  

    await alert.present();
  }

  ngOnInit() {
  }

  goToComments(){
    this.router.navigate(['/comments']);
  }

  goToPostForm(){
    this.router.navigate(['/post'])
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
