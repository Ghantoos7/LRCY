import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
import { AdminService } from 'src/app/services/admin.service';


@Component({
  selector: 'app-panel',
  templateUrl: './panel.page.html',
  styleUrls: ['./panel.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class PanelPage implements OnInit {

  constructor(private router:Router, private adminService : AdminService) { }

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
