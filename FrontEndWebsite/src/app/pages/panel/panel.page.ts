import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AdminService } from 'src/app/services/admin.service';
import { NavController } from '@ionic/angular';

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
  darkMode: boolean = false;

  constructor(private router:Router, private adminService : AdminService) { }

  OnToggleColorTheme(event: Event): void {
    const customEvent = event as CustomEvent;
    customEvent.darkMode = this.darkMode = !this.darkMode;

    if(customEvent.darkMode){
      document.body.setAttribute('color-theme','dark');
    }
    else{
      document.body.setAttribute('color-theme','light');
    }
  }

  ngOnInit() {
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
