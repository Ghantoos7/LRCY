import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { EventService } from 'src/app/services/event.service';

@Component({
  selector: 'app-announcements',
  templateUrl: './announcements.page.html',
  styleUrls: ['./announcements.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class AnnouncementsPage implements OnInit {
  showDescriptions: boolean[] = [];
  announcements: any = [];
  i: number = 0;
  constructor(private router:Router, private menuCtrl: MenuController, private service:EventService) { 
    this.showDescriptions = new Array(this.announcements.length).fill(false);
  }

  ngOnInit() {
    this.service.getAnnouncements().subscribe((response: any) => {
      this.announcements = response['announcements'];
    });
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
