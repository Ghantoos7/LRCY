import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Route, Router } from '@angular/router';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-yearly-goals',
  templateUrl: './yearly-goals.page.html',
  styleUrls: ['./yearly-goals.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class YearlyGoalsPage implements OnInit {

  constructor(private router:Router, private menuCtrl: MenuController) { }

  ngOnInit() {
  }

  ionViewWillLeave() {
    this.menuCtrl.enable(false, 'menuGoals');
  }

  ionViewDidEnter() {
    this.menuCtrl.enable(true, 'menuGoals');
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

