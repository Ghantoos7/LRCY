import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { Router } from '@angular/router';
@Component({
  selector: 'app-panel',
  templateUrl: './panel.page.html',
  styleUrls: ['./panel.page.scss'],
  standalone: true,
  imports: [IonicModule, CommonModule, FormsModule]
})
export class PanelPage implements OnInit {

  constructor(private router:Router) { }

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
    this.router.navigate(['/home']);
  }

}
