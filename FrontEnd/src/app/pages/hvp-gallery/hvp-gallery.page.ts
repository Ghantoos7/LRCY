import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { MenuController } from '@ionic/angular';
import { EventService } from '../../services/event.service';

@Component({
  selector: 'app-hvp-gallery',
  templateUrl: './hvp-gallery.page.html',
  styleUrls: ['./hvp-gallery.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class HvpGalleryPage implements OnInit {

  constructor(private event_service:EventService, private router:Router, private menuCtrl: MenuController) { }
 hvp_events: any = [];
  events: any = [];
  ngOnInit() {
    this.event_service.get_events().subscribe(response => {
      this.events = response;
      this.hvp_events = Array.from(this.events['events']['2']);
     
    });

  }
  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuHvp');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuHvp');
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
