import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AdminService } from 'src/app/services/admin.service';

interface CustomEvent extends Event {
  darkMode: boolean;
}

@Component({
  selector: 'app-panel',
  templateUrl: './panel.page.html',
  styleUrls: ['./panel.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class PanelPage implements OnInit {

  darkMode: boolean;

  constructor(private router:Router, private adminService : AdminService) {
    this.darkMode = localStorage.getItem('darkModeEnabled') === 'true';
    if (this.darkMode) {
      document.body.setAttribute('color-theme', 'dark');
    }
  }
  
  OnToggleColorTheme(event: Event): void {
    const customEvent = event as CustomEvent;
    this.darkMode = !this.darkMode;
    customEvent.darkMode = this.darkMode;
    
    if(this.darkMode){
      document.body.setAttribute('color-theme','dark');
      localStorage.setItem('darkModeEnabled', 'true');
    }
    else{
      document.body.setAttribute('color-theme','light');
      localStorage.setItem('darkModeEnabled', 'false');
    }
  }

  ngOnInit() {
    console.log(localStorage.getItem('darkModeEnabled'));
  }

  goToProfiles(){
    this.router.navigate(['/manage-profiles'], { state: { data: this.darkMode } });
  }

  goToGallery(){
    this.router.navigate(['/manage-gallery']);
  }

  goToRequests(){
    this.router.navigate(['/requests']);
  }

  goToAnnouncements(){
    this.router.navigate(['/announcements']);
  }

  goToYearlyGoals(){
    this.router.navigate(['/yearly-goals']);
  }
  
  goToHome(){
    this.adminService.logout().subscribe((response: any) => {
      localStorage.clear();
      this.router.navigate(['/home']);
   });
  }
}
