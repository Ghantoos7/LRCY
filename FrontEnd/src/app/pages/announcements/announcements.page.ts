import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-announcements',
  templateUrl: './announcements.page.html',
  styleUrls: ['./announcements.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AnnouncementsPage implements OnInit {
  showDescriptions: boolean[] = [];
  constructor(private router:Router, private menuCtrl: MenuController) { 
    this.showDescriptions = new Array(3).fill(false);
  }

  ngOnInit() {

  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuAnnouncements');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuAnnouncements');
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

  toggleDescription(index: number) {
    this.showDescriptions[index] = !this.showDescriptions[index];
  }
}
