import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AdminService } from 'src/app/services/admin.service';

interface CustomEvent extends Event {
  myBoolean: boolean;
}

@Component({
  selector: 'app-panel',
  templateUrl: './panel.page.html',
  styleUrls: ['./panel.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class PanelPage implements OnInit {
  myBoolean: boolean = false;

  constructor(private router:Router, private adminService : AdminService) { }

  OnToggleColorTheme(event: Event): void {
    const customEvent = event as CustomEvent;
    customEvent.myBoolean = this.myBoolean = !this.myBoolean;


    if(customEvent.myBoolean){
      document.body.setAttribute('color-theme','dark');
    }
    else{
      document.body.setAttribute('color-theme','light');
    }
  }

  ngOnInit() {
  }

  goToProfiles(){
    this.router.navigate(['/manage-profiles']);
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
