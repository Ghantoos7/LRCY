import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { EventService } from '../../services/event.service';

@Component({
  selector: 'app-env-gallery',
  templateUrl: './env-gallery.page.html',
  styleUrls: ['./env-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class EnvGalleryPage implements OnInit {

  constructor(private event_service:EventService, private router:Router, private menuCtrl: MenuController) { }
  env_events: any = [];
  events: any = [];
  ngOnInit() {
    this.event_service.get_events().subscribe(response => {
      this.events = response;
      this.env_events = Array.from(this.events['events']['3']);
     
    });

  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuEnvGallery');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuEnvGallery');
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
